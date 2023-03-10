@extends('layouts.main')


@section('section')
	<div class="">
		<div class="container">
            <div class="row">
                <br>
                <div class="col-md-12">
                    <a href="{{url('./picking')}}" class="btn btn-warning bi bi-back mt-3"><i class="notika-icon notika-back"></i>Back</a>
                </div>
            </div>
            <br>

            <div class="col">
                <div class="accordion" id="accordionExample">
                    <div class="card  mb-5 shadow-lg ">
                        <div class="card-body ">
                                @foreach($data as $key => $value)
                                <div class="breadcomb-list">
                                    <br>
                                    <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" onclick="closeForm()"><i class="notika-icon notika-refresh"></i>RESET</button>
                                    </div>
                                    <input class="text-center" type="hidden" name="rog_number" value="{{$value->rog_number}}"  id="rog_number"  disabled>
                                    <p class="mb-2">PART  NUMBER</p>
                                    <input class="font-weight-bold" type="text" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled>
                                    <br>
                                    <input type="hidden" name="part_picking_id" value="{{$value->id}}"  id="part_picking_id"  >
                                    <input type="hidden" name="status" value="{{$value->status}}"  id="status"  disabled>
                                    <input type="hidden" name="qty_request" value="{{$value->qty_request}}"  id="qty_request"  disabled>
                                    <br>
                                    <h4 class="font-size:25px text-center text-success">COMPARE PART </h4>
                                    <input class="form-control form-control-lg mb-3 text-center " type="text" name="picking_by" value="" id="picking_by" maxlength="8" placeholder="SCAN NIK HERE" >
                                    <input class="form-control form-control-lg mb-4  text-center" type="text" name="scan_label"  value="" id="scan_label" placeholder="SCAN LABEL PART HERE" disabled>

                                    <input class="form-control form-control-lg mb-4  text-center" type="hidden" name="qty_scan"  value="" id="qty_scan">
                                    <h1 id="msg" class="card-text text-center"></h1>

									<audio id="audio">
                                     <source id="audioSource" src="{{asset('')}}storage/sound/OK.mp3" type="audio">
                                    </audio>
                                    <label class="text-center font-weight-bold text-success" id="result_OK"  style="font-size:50px;">
                                    </label>
                                    <label class="text-center font-weight-bold text-danger" id="result_NG" style="font-size:50px;">
                                    </label>
                                    @endforeach
                                 </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

                <div class="breadcomb-list shadow rounded-3">
                    <div class="card card-success">
                        <div class="col">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    <h4 class="text-center">RESULT</h4>
                                    <table class="table table-bordered data-table ">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class=text-white>ID</th>
                                                <th class=text-white>ROG NUMBER</th>
                                                <th class=text-white>PART NUMBER</th>
                                                <th class=text-white>LABEL PART</th>
                                                <th class=text-white>QTY </th>
                                                <th class=text-white>STATUS</th>
                                                <th class=text-white>PIC</th>
                                                <th class=text-white>SCAN DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>



{{-- MODAL COMPARE --}}
<div class="modal fade" id="compareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTER PART</h1>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="{{ url('/register_part/createPart/') }}" method="post">
				@csrf
				<div class="breadcomb-area rounded">
					<div class="container">

						<div class="row">				
							<div class="col-lg-12 ">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika"></i>
									</div>
									<div class="nk-int-st">
									<input type="text" class="form-control mb-3" name="rog_number" placeholder="ROG NUMBER" required>
									@foreach ($errors->get('rog_number') as $msg)
									<p class="text-danger">{{$msg}} </p>
										@endforeach
									</div>
								</div>
							</div>
						</div>
			
						<div class="row">
							<div class="col-lg-12 ">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika"></i>
									</div>
									<div class="nk-int-st">
										<input type="text" class="form-control mb-3"
											name="part_number" placeholder="PART NUMBER" required>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 ">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-part"></i>
									</div>
									<div class="nk-int-st">
										<input type="text" class="form-control mb-3"
											name="qty_request" placeholder="QTY"required >
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 ">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-part"></i>
									</div>
									<div class="nk-int-st">
										<input type="text" class="form-control mb-3"
											name="register_by" placeholder="REGISTER BY" required>
										
									</div>
								</div>
							</div>
						</div>																
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
	  </div>
	</div>
</div>


<!-- Java Script -->
<script type="text/javascript">
	$('#picking_by').focus();

    $(document).ready( function () {
        $('#picking_by').on('keypress', function(e){
				if(e.which == 13) {
				var val = $('#picking_by').val();
					if (val != '') {
                        $('#scan_label').attr('disabled', false);
						$('#scan_label').focus();
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
    $('#scan_label').on('keypress', function(e){
			if(e.which == 13) {
                // function addData(){
                    // $('#picking_by').focus();

                    var rog_number   = $('#rog_number').val();
                    var part_number  = $('#part_number').val();
                    var status       = $('#status').val();
                    var picking_by   = $('#picking_by').val();
                    var scan_label   = $('#scan_label').val();
                    var qty_scan   = $('#qty_scan').val();
                    var qty_request   = $('#qty_request').val();
                    var id            = $('#part_picking_id').val();


                    part_number = part_number.replace("+","#");
                    scan_label = scan_label.replace("+","#");


               
                    if(scan_label.search(part_number)>= 0){

                        scan_label = scan_label.replace("#","+");
                      $.ajax({
                        type    :"POST",
                        dataType:"json",
                        data    :{rog_number,part_number,status, picking_by, scan_label, qty_scan,qty_request, id},
                        url     :"{{url('/picking/detail/')}}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success : function(data){
                           console.log(data);
                            var audio = document.getElementById('audio');
                            var source = document.getElementById('audioSource');
                            var audio = new Audio("{{asset('')}}storage/sound/OK.mp3");
                            document.getElementById("result_OK").innerHTML = "OKE";
                            audio.load()
                            audio.play();
                            resultCompare();
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

             function closeForm() {
                document.getElementById("result_NG").style.display = "none";
               
                $('#scan_label').val('');
             
                $('#scan_label').focus();
                document.getElementById("scan_label").value = "";
               
                $('#scan_label').focus();
                }

                    function resultCompare()
                    {
                        $.ajax({
                            type: 'GET',
                            dataType:"json",          
							url: "{{url('/picking/detail/{id}/result/')}}",            
							success: function(response){
                            console.log(data);
                            var data=""
                              $.each(response,function(key, value){

                                data = data + "<tr>"
                                data = data + "<td>"+value.id+"</td>"
                                data = data + "<td>"+value.rog_number+"</td>"
                                data = data + "<td>"+value.part_number+"</td>"
                                data = data + "<td>"+value.scan_label+"</td>"
                                data = data + "<td>"+value.qty_scan+"</td>"
                                data = data + "<td>"+value.status+"</td>"
                                data = data + "<td>"+value.picking_by+"</td>"
                                data = data + "<td>"+value.picking_at+"</td>"
                                data = data + "</tr>"
                                })
                                $('tbody').html(data);

							}
							});
                    }
                    resultCompare();

</script>

@endsection





