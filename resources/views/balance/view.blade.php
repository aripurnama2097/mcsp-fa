@extends('layouts.main')

@section('section') 


            <div class="container">     
                <div class="col">
                    <div class="accordion" id="accordionExample">
                        <div class="card  mb-5 shadow-lg ">
                            <div class="card-body ">
                                    @foreach($data as $key => $value)
                                    <div class="breadcomb-list">
                                        {{-- <input class="text-center" type="hidden" name="PO" value="{{$value->PO}}"  id="PO"  disabled>
                                        <input class="text-center" type="hidden" name="label_original" value="{{$value->label_original}}"  id="label_original"  disabled>
                                        <input class="text-center" type="hidden" name="sorting_by" value="{{$value->sorting_by}}"  id="sorting_by"  disabled>
                                       
                                        <input class="font-weight-bold" type="hidden" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled>
                                        @endforeach --}}
                                        {{-- <p class="text text-bolg text text-bg-secondary">PART NUMBER : {{$value->part_number}}</p> --}}

                                        <input class="text-center" type="text" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled>
                                        <br>
                                        <br>
                                        <h4 class="font-size:25px text-center text-success">LABEL BALANCE SCAN </h4>
                                        {{-- <input class="form-control form-control-lg mb-3 text-center " type="text" name="id" value="{{$value->id}}" id="id" > --}}
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
                    
                     var part_number   = $('#part_number').val();
                    var label_sorting   = $('#label_sorting').val();
                    var label_balance   = $('#label_balance').val();
                    // var id              = $('#id').val();

                    // if(label_balance.search(label_sorting)>= 0){
                      $.ajax({
                        type    :"POST",
                        dataType:"json",
                        data    :{part_number:part_number,label_sorting:label_sorting, label_balance:label_balance},
                        url     :"{{url('/balance/view/{id}/insert')}}",
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
                    // }
                    // else {
                    //     $.ajax({
                    //         success : function(data){
                    //         var audio = document.getElementById('audio');
                    //         var source = document.getElementById('audioSource');
                    //         var audio = new Audio("{{asset('')}}storage/sound/WRONG.mp3");
                    //         document.getElementById("result_NG").innerHTML = "NG";
                    //         audio.load()
                    //         audio.play();
                    //     }

            //         })
            //       }
            // // }
            }
        });

</script>          
@endsection 