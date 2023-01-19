@extends('layouts.main')

@section('section')

	<div class="">	
		<div class="container">
            <div class="row">
                <br>
                <div class="col-md-12">
                    <a href="{{url('./sorting')}}" class="btn btn-warning accent-cyanbi bi-back mt-3"><i class="notika-icon notika-back"></i>Back</a>
                </div>        
            </div>
            <br>

           
        {{-- <div class="col">
                <div class="accordion" id="accordionExample">
                    <div class="card  mb-5 shadow-lg "> --}}
                        <div class="card-body mb-3"> 
                            @foreach($data as $key => $value)                              
                            <div class="breadcomb-list shadow-lg rounded">   
                                <p class="mb-2 ">PART  NUMBER</p>
                                    <input class="font-weight-bold rounded border border-primary" type="text" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled>
                                    <br>        
                                    <br>                                                               
                                    <h4 class="font-size:25px text-center text-primary">SPLIT LABEL</h4>
                                    {{-- <input class="text-center" type="hidden" name="rog_number" value="{{$value->id}}"  id="id"  disabled> --}}
                                    <input class="text-center" type="hidden" name="rog_number" value="{{$value->rog_number}}"  id="rog_number"  disabled>
                                    {{-- <input class="text-center" type="hidden" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled> --}}
                                    <input type="hidden" name="status" value="{{$value->status}}"  id="status"  disabled>
                                    <input type="hidden" name="part_sorting_id" value="{{$value->id}}"  id="part_sorting_id"  disabled>
                                   
                                    <input class="form-control form-control-lg mb-3 text-center border border-secondary" type="text" name="sorting_by" value="" id="sorting_by" maxlength="8" placeholder="SCAN NIK HERE" >                                
                                    <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="text" name="label_original"  value="" id="label_original" placeholder="SCAN LABEL PART HERE" disabled> 
                                    <input class="form-control form-control-lg mb-4  text-center border border-secondary" type="number" name="qty_split"  value="1" id="qty_split" placeholder="QTY" disabled>      
                                    {{-- onkeypress="getqty(event)"                                                                                          --}}
                                    <div class="d-flex justify-content-center">
                                        <a type="submit" onclick="splitLabel()" class="btn btn-primary rounded btn-sm text-center">SPLIT LABEL</a>
                                    </div>
                                    <h5 id="msg" class="card-text text-success"></h5>                        
                                    <audio id="audio">
                                        <source id="audioSource" src="{{asset('')}}storage/sound/OK.mp3" type="audio"> 
                                    </audio>
                                       <label class="text-center font-weight-bold text-success" id="result_OK"  style="font-size:50px;"> 
                                       </label>
                                       <label class="text-center font-weight-bold text-danger" id="result_NG" style="font-size:50px;"> 
                                       </label>  

                                </div>
                                @endforeach                 
                            </div>                                               
                         
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
            var val_LabelOriginal = $('#label_original').val();
            if (val_LabelOriginal != '') {
                $('#qty_split').attr('disabled', false);
                $('#qty_split').focus();
            }
        }
    });



});




// INSERT DATA TO RECORD_SORTING
function splitLabel(){
    // $('#qty').on('keypress', function(e){
    var rog_number          = $('#rog_number').val();
    var part_number         = $('#part_number').val();  
    var sorting_by          = $('#sorting_by').val();
    var label_original      = $('#label_original').val();
    var status              = $('#status').val();
    var qty_split           = $('#qty_split').val();
    var id                  = $('#part_sorting_id').val();
    
    
    if(label_original.search(part_number)>= 0){
        $.ajax({
        type    :"POST",
        dataType:"json",
        data    :{sorting_by,rog_number,part_number,label_original,status,qty_split,id},
        url     :"{{url('/sorting/view/split')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success : function(response){
            // window.location.replace(response.redirect);
            console.log(response);

            var audio   = document.getElementById('audio');
            var source  = document.getElementById('audioSource');
            var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
            document.getElementById("result_OK").innerHTML = "OKE";
           
            audio.load();
            audio.play();

        //    label_balance="A2B-0002-00     1234567 29    I10827 A2B-0002-00    202301170948225548000002"
        //     label_original="A2B-0002-00     1234567 30    I10827 A2B-0002-00    202211161618210132000002"
        //     label_sorting="A2B-0002-00     1234567 1     I10827 A2B-0002-00    202301170948225548000001"
        //     lokasi="*M-050    "
        //     part_number="A2B-0002-00"
        //     part_sorting_id="1"
        //     po="1234567"
        //     qty_split="1"
        //     raw_nik="37299"
        //     rog_number="ROG120123"
        //     status="SORTING"
        //     supplierName="WANG SARI"
        //     type="INSPECTION"
            
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
        
            
            window.open("../../printLabel.php"+"?label_balance="+label_balance+"&label_sorting="+label_sorting+"&lokasi="+lokasi
            +"&part_number="+part_number+"&po="+po+"&supplierName="+supplierName+"&type="+type); 
            
          
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
                audio.load()
                audio.play();                         
            }                      
        })
    }
}
function splitLabel_backup(){
    // $('#qty').on('keypress', function(e){
    var rog_number          = $('#rog_number').val();
    var part_number         = $('#part_number').val();  
    var sorting_by          = $('#sorting_by').val();
    var label_original      = $('#label_original').val();
    var status              = $('#status').val();
    var qty_split           = $('#qty_split').val();
    
    if(label_original.search(part_number)>= 0){
        $.ajax({
        type    :"POST",
        dataType:"json",
        data    :{sorting_by,rog_number,part_number,label_original,status,qty_split},
        url     :"{{url('/sorting/view/{id}')}}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success : function(response){
        window.location.replace(response.redirect);
            console.log(data);
            var audio   = document.getElementById('audio');
            var source  = document.getElementById('audioSource');
            var audio   = new Audio("{{asset('')}}storage/sound/OK.mp3");
            document.getElementById("result_OK").innerHTML = "OKE";
            audio.load()
            audio.play();   

            // window.open(this.href, "{{url('/sorting/view/{id}/print/')}}");   
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
                audio.load()
                audio.play();                         
            }                      
        })
    }
}


// function getqty(event){
//     event.preventDefault();
//     if(event.which == 13){
//         $('#label_original').attr('disabled', false);
//         let labelOri = $("#label_original").val();
//         let qtyLabelOri = labelOri.substr(24,5);
//         $("#qty_split").attr({"max":qtyLabelOri-1,"min":1});
//         // alert(qtyLabelOri);
//     }
// }



</script>

@endsection
