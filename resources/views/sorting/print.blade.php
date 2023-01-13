@extends('layouts.main')

@section('section') 
<?php
// ADD BALANCE MODUL SCAN

$raw_nik    = isset($_REQUEST['sorting_by']) ? $_REQUEST['sorting_by'] : "";
$splitlabel = isset($_REQUEST['label_original']) ? $_REQUEST['label_original'] : "";
$splitqty   = isset($_REQUEST['qty_split']) ? $_REQUEST['qty_split'] : "";

// echo $datas;
// die();
?>   
         
             {{-- <div class="visible-print text-center mb-5">
                    {!! $qrCode !!}         
                    <br>
                    <br>             
                    <a  href="" class="btn btn-secondary btn-sm rounded">Print Label</a>
                </div>    --}}
               
        
            <div class="container">     
                <div class="col">
                    <div class="accordion" id="accordionExample">
                        <div class="card  mb-5 shadow-lg ">
                            <div class="card-body ">
                                    @foreach($datas as $key => $value)
                                    <div class="breadcomb-list">
                                        {{-- <input class="text-center" type="hidden" name="PO" value="{{$value->PO}}"  id="PO"  disabled>
                                        <input class="text-center" type="hidden" name="label_original" value="{{$value->label_original}}"  id="label_original"  disabled>
                                        <input class="text-center" type="hidden" name="sorting_by" value="{{$value->sorting_by}}"  id="sorting_by"  disabled>
                                        <input class="text-center" type="hidden" name="rog_number" value="{{$value->rog_number}}"  id="rog_number"  disabled>
                                        <input class="font-weight-bold" type="hidden" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled>
                                        @endforeach --}}
                                        <h4 class="font-size:25px text-center text-success">LABEL BALANCE SCAN </h4>
                                        <input class="form-control form-control-lg mb-3 text-center " type="text" name="id" value="{{$value->id}}" id="id" >
                                        <input class="form-control form-control-lg mb-3 text-center " type="text" name="label_sorting" value="" id="label_sorting" placeholder="SCAN LABEL SORTING" >
                                        <input class="form-control form-control-lg mb-4  text-center" type="text" name="label_balance"  value="" id="label_balance" placeholder="SCAN LABEL BALANCE" disabled>
                                        <h1 id="msg" class="card-text text-center"></h1>
                                        @endforeach

                                        <audio id="audio">
                                         <source id="audioSource" src="{{asset('')}}storage/sound/OK.mp3" type="audio">
                                        </audio>
                                        <label class="text-center font-weight-bold text-success" id="result_OK"  style="font-size:50px;">
                                        </label>
                                        <label class="text-center font-weight-bold text-danger" id="result_NG" style="font-size:50px;">
                                        </label>
                                     
                                     </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        
                
      
<!-- Java Script -->
<script type="text/javascript">
	$('#label_sorting').focus();

    $(document).ready( function () {
        $('#label_sorting').on('keypress', function(e){
				if(e.which == 13) {
				var val = $('#label_sorting').val();
					if (val != '') {
                        $('#label_balance').attr('disabled', false);
						$('#label_balance').focus();
					}

				}
            })
        });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // START COMPARE PART
    $('#label_balance').on('keypress', function(e){
			if(e.which == 13) { 
                    
                    var label_sorting   = $('#label_sorting').val();
                    var label_balance   = $('#label_balance').val();
                    var id              = $('#id').val();

                    if(label_balance.search(label_sorting)>= 0){
                      $.ajax({
                        type    :"GET",
                        dataType:"json",
                        data    :{id:id,label_sorting:label_sorting, label_balance:label_balance},
                        url     :"{{url('/sorting/view/{id}/print/update')}}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success : function(data){
                            var audio = document.getElementById('audio');
                            var source = document.getElementById('audioSource');
                            var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                            document.getElementById("result_OK").innerHTML = "OKE";
                            audio.load()
                            audio.play();
                           console.log(data);
                          
                        }
                      })
                    }
                    else {
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
            // }
            }
        });

</script>          
@endsection 