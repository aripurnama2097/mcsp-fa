@extends('layouts.main')

@section('section')

	<div class="">	
		<div class="container">
            <div class="row">
                <br>
                <div class="col-md-12">
                    <a href="{{url('./sorting')}}" class="btn btn-warning btn-sm"><i class="notika-icon notika-back"></i>Back</a>
                </div>        
            </div>
            <br>

           
        {{-- <div class="col">
                <div class="accordion" id="accordionExample">
                    <div class="card  mb-5 shadow-lg "> --}}
                        <div class="card-body mb-3"> 
                            @foreach($data as $key => $value)                              
                            <div class="breadcomb-list shadow-lg rounded col-12">  
                                <div class="d-flex justify-content-end">
                                    {{-- <button type="button" class="btn btn-warning" onclick="closeForm()"><i class="notika-icon notika-refresh"></i>RESET</button> --}}
                                    <br>
                                    <br>
                                     

                                </div> 
                                <p class="mb-2 ">PART  NUMBER</p>
                                    <input class="font-weight-bold rounded border border-primary" type="text" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled>                                                                                        
                                    <h3 class="font-size:30px text-center">SPLIT LABEL</h4>
                                    {{-- <input class="text-center" type="hidden" name="rog_number" value="{{$value->id}}"  id="id"  disabled> --}}
                                    <input class="text-center" type="hidden" name="rog_number" value="{{$value->rog_number}}"  id="rog_number"  disabled>
                                    {{-- <input class="text-center" type="hidden" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled> --}}
                                    <input type="hidden" name="status" value="{{$value->status}}"  id="status"  disabled>
                                    <input type="hidden" name="part_sorting_id" value="{{$value->id}}"  id="part_sorting_id"  disabled>
                                   
                                    <input class="form-control form-control-lg mb-3 text-center border border-secondary col-10" type="text" name="sorting_by" value="" id="sorting_by" maxlength="8" placeholder="SCAN NIK HERE" >                                
                                    <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="text" name="label_original"  id="label_original" placeholder="SCAN LABEL PART HERE"> 
                                    <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="text" name="label_picking"  value="{{$value->scan_label}}" id="label_picking" hidden> 
                                    <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="text" name="qty_actual"   id="qty_actual" hidden> 
                                    <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="text" name="remark"   id="remark" hidden> 
                                    {{-- <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="text" name="qty_original"  value="{{$value->scan_label}}" id="qty_original" readonly>  --}}
                                    
                                    <div class="d-flex justify-content-end mt-2"> 
                                        <button type="button" class="btn btn-success btn-sm"   id="editBtn">QTY ACTUAL</button> 
                                    </div>
                                    <br>
                                   
                                    <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="number" name="qty_split"  value="{{$value->qty_request}}" id="qty_split" placeholder="QTY" disabled readonly>      
                                    {{-- onkeypress="getqty(event)" --}}
                                    <div class="d-flex justify-content-center">
                                        <a type="submit" id="split" onclick="splitLabel()" class="btn btn-success rounded btn-sm text-center">SPLIT LABEL</a>
                                    </div>
                                    <h5 id="msg" class="card-text text-success"></h5>                        
                                    <audio id="audio">
                                        <source id="audioSource" src="{{asset('')}}storage/sound/OK.mp3" type="audio"> 
                                    </audio>                                 
                                       <div class="d-flex justify-content-center">
                                            <label class="text-center font-weight-bold text-success" id="result_OK"  style="font-size:50px;"> 
                                            </label>
                                            <label class="text-center font-weight-bold text-danger" id="result_NG" style="font-size:50px;"> 
                                            </label>  
                                      </div>
                                </div>
                                @endforeach                 
                            </div>                                               
                         
                </div>
            </div>
		</div>
	</div>    
</div> 



  <!-- Modal -->
  <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CHANGE ACTUAL QTY</h5>
              
                {{-- <span aria-hidden="true">&times;</span> --}}
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label for="edit_qty_actual">Qty Actual</label>
                    <input type="number" class="form-control" id="edit_qty_actual" value="{{intval(substr($value->scan_label,24,5))}}" required>
                </div>     
                <div class="form-group mb-2">
                    <label for="remark">Remark</label>
                    <input type="textarea" class="form-control" id="edit_remark" placeholder="REMARK" required>
                </div>     
                <div class="row g-3">
                    <button type="button" class="btn btn-primary btn-sm col-6" id="saveBtn">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-sm col-6" data-bs-dismiss="modal">Close</button>  
                </div>
            </div>    
        </div>
    </div>
 </div>


                                              




<script type="text/javascript">

$('#sorting_by').focus();
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});  

$(document).ready( function () {     
    $('#sorting_by').on('keypress', function(e){
        if(e.which == 13) {
        var val_sorting = $('#sorting_by').val();
            if (val_sorting != '') {
                $('#label_original').attr('disabled', false);
                $('#qty_split').attr('disabled', false);
                $('#label_original').focus();
            }                       
        } 
    })
        
    // Set focus on input Label Part after scan
    $('#label_original').on('keypress', function(e){
        if(e.which == 13) {
            let val_LabelOriginal = $('#label_original').val();
            let qty_labelOriginal = parseInt(val_LabelOriginal.substr(24, 5));

            if (val_LabelOriginal != '') {
                $("#qty_actual").val(qty_labelOriginal);
                $('#qty_split').attr('disabled', false);
                $('#qty_split').focus();
            }
        }
    });


    $("#editBtn").click(function() { 

        let label_original  = $('#label_original').val();
        let label_picking   = $('#label_picking').val();
        label_original      = label_original.replace("+","#");
        label_picking       = label_picking.replace("+","#");
        
        if(label_original == ""){
            alert("Scan Label Sorting !");
            return;
        }
        
        if(label_original !== label_picking){
            alert("Scan label tidak sama dengan Label Picking !");
            return;
        }

        let maxQtyScan = $("#label_original").val();
        maxQtyScan = parseInt(maxQtyScan.substr(24, 5));

        $("#editModal").modal("show");
        $("#edit_qty_actual").attr({"max":maxQtyScan,"min":1});
        $('#edit_qty_actual').focus();
     });



    $("#saveBtn").click(function() {
        let maxQtyScan = $("#label_original").val();
        let edit_remark = $("#edit_remark").val();
        maxQtyScan = parseInt(maxQtyScan.substr(24, 5));

        let edit_qty_actual   = $("#edit_qty_actual").val();

        if(edit_qty_actual > maxQtyScan){
            alert("Quantity Over !");
            return;
        }

        if( edit_remark == ""){
            alert("Remark Harus diisi !");
            return;
        }

        $("#qty_actual").val(edit_qty_actual);
        $("#remark").val(edit_remark);
        $('#editModal').modal('toggle');
    });




});




// INSERT DATA TO RECORD_SORTING
function splitLabel(){
    // $('#qty').on('keypress', function(e){
    var rog_number          = $('#rog_number').val();
    var part_number         = $('#part_number').val();  
    var sorting_by          = $('#sorting_by').val();
    var label_original      = $('#label_original').val();
    var label_picking       = $('#label_picking').val();
    var status              = $('#status').val();
    var qty_split           = $('#qty_split').val();
    var id                  = $('#part_sorting_id').val();
    var qty_actual          = $('#qty_actual').val();
    var remark              = $('#remark').val();
    
    part_number = part_number.replace("+","#");
    label_original = label_original.replace("+","#");
    label_picking = label_picking.replace("+","#");

    if(label_original !== label_picking){
        alert("Scan Label Sorting tidak sama dengan Label Picking !");
        return;
    }
        console.log('rog_number => ', rog_number);
        console.log('part_number => ', part_number);
        console.log('sorting_by => ', sorting_by);
        console.log('label_original => ', label_original);
        console.log('label_picking => ', label_picking);
        console.log('status => ', status);
        console.log('qty_split => ', qty_split);
        console.log('id => ', id);
        console.log('qty_actual => ', qty_actual);
        console.log('remark => ', remark);

    if(label_original.search(part_number)>= 0){

        part_number = part_number.replace("#","+");
        label_original = label_original.replace("#","+");
        label_picking = label_picking.replace("+","#");

        $.ajax({
        type    :"POST",
        dataType:"json",
        data    :{sorting_by,rog_number,part_number,label_original,status,qty_split,id,qty_actual,remark},
        url     :"{{url('/sorting/view/split')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success : function(response){
            // window.location.replace(response.redirect);
            console.log(response);

            var audio   = document.getElementById('audio');
            var source  = document.getElementById('audioSource');
            var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
            document.getElementById("result_OK").innerHTML = "OKE";
            document.getElementById("result_OK").style.display = "block";
            document.getElementById("result_NG").style.display = "none";
                            audio.load()
           
            audio.load();
            audio.play();

    
            let label_balance   = response.param.label_balance;
            let label_original  = response.param.label_original;
            let label_sorting   = response.param.label_sorting;
            let lokasi          = response.param.lokasi;
            let part_number     = response.param.part_number;
            let part_sorting_id = response.param.part_sorting_id;
            let po              = response.param.po;
            let qty_split       = response.param.qty_split;
            let raw_nik         = response.param.raw_nik;
            let rog_number      = response.param.rog_number;
            let status          = response.param.status;
            let supplierName    = response.param.supplierName;
            let type            = response.param.type;
            let qty_actual      = response.param.qty_actual;
        
            

            // part_number = part_number.replace("+","#");
            // label_balance =  label_balance.replace("+","#");
            // label_sorting =  label_sorting.replace("+","#");

            window.open("../../printLabel.php"+"?label_balance="+label_balance+"&label_sorting="+label_sorting+"&lokasi="+lokasi
            +"&part_number="+part_number+"&po="+po+"&supplierName="+supplierName+"&type="+type+"&qty_actual"+qty_actual); 
           
           
            document.getElementById("split").style.display = "none";
          
        },

    

        failure: function(form, action) {
                Ext.Msg.show({
                    title: 'OOPS, AN ERROR JUST HAPPEN !',
                    icons: Ext.Msg.ERROR,
                    msg: action.result.msg,
                    buttons: Ext.Msg.OK
                });
            }
        }) 
    }
    else{
        $.ajax({
            success : function(data){
                var audio = document.getElementById('audio');
                var source = document.getElementById('audioSource');
                var audio = new Audio("{{asset('')}}storage/sound/WRONG.mp3");
                document.getElementById("result_NG").innerHTML = "NG";
                document.getElementById("result_NG").style.display = "block";
                document.getElementById("result_OK").style.display = "none";
                audio.load()
                audio.play();                         
            }                      
        })
    }
}

function closeForm() {
    document.getElementById("result_NG").style.display = "none";
    document.getElementById("result_OK").style.display = "none";            
    $('#label_original').val('');
    
    $('#label_original').focus();
    document.getElementById("label_original").value = "";
    
    $('#label_original').focus();
}







</script>

@endsection
