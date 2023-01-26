@extends('layouts.main')
@section('section')


<body  class="responsive">  
	<div class="breadcomb-area">	
		<div class="container">							
			<div class="col-lg-12 shadow-sm rounded  ">
				<div class="breadcomb-list rounded-3 ">
					<div class="row border-success">
						<div class="col-12 border-success">
							<div class="breadcomb-wp border-success">						
								<div class="col-6">
									<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="notika-icon notika-edit mb-3"></i>CREATE</i>		
									</button>
								</div>

								{{-- <div class="pd-5">
									<form action="{{url('/register_part/create/')}}" method="POST">
										<button  data-toggle="tooltip" data-placement="left" title="create part" class="btn btn-outline-success btn-sm"><i class="notika-icon notika-edit mb-3"></i>CREATE </i></button>	
									</form>
								</div> --}}

								<div class="d-flex justify-content-end col-6 mr-2">
									<ul>
									<li class="nav-item dropdown">
										<button class=" btn btn-secondary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<i class="bi bi-person-circle"></i> {{auth()->user()->name}}
										</button>
										<ul class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
										  <li><hr class="dropdown-divider"></li>
										  <li>
											<form action="{{url('/logout')}}" method="post">
											  @csrf
											  <button type="submit" class="dropdown-item btn btn-warning btn-sm text-white text-bold font-size:25px"> <i class="bi bi-box-arrow-left fs-5">
												</i>  LOGOUT</a></button>
											</form>
										  </li>
										</ul>
									  </li>
									</ul>
								</div>

						
								
								{{-- <form action="{{url('/logout')}}" method="post" class="col-5 text-right">
									@csrf
									<button type="submit" class="btn btn-secondary btn-sm"> <i class="bi bi-arrow-left-circle"></i>
										Logout</button>
								</form> --}}
							</div>				
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<br>

<div class="breadcomb-area ">	
	<div class="container">							
		<div class="col-lg-12 shadow-sm rounded ">
			<div class="breadcomb-list rounded-3">
				<div class="row border-success">
					@if(Session::has('success'))
												<p class="alert alert-success">{{Session::get('success')}}</p>
									@endif
									<h4 class="text-center">PART REQUEST</h4>
									<form action="{{url('register_part')}}" method="GET">			
											<input type="text" name="keyword"  value="" class="form-control mb-2 pad-l20 border border-secondary" placeholder="Search..." autofocus>
											<button class="btn btn-primary btn-sm" type="submit" ><i class="bi bi-search"></i> SEARCH</button>
											<br>
											<br>											
									</form>		
					<div class="col-12 border-success">
						<div class="breadcomb-wp border-success">	
						<div class="table-responsive">					
							<table  class="table table-hover shadow-smm mb-5">
								<thead class="table-dark">
									<tr>
										<th class="text-center text-white" width="20px">NO</th>
										<th class="text-center text-white">ROG NUMBER</th>
										<th class="text-center text-white">PART NUMBER</th>
										<th class="text-center text-white">QTY REQUEST</th>
										<th class="text-center text-white">STATUS</th>
										<th class="text-center text-white">REGISTER AT</th>
										<th class="text-center text-white">REGISTER BY</th>
										<th class="text-center text-white">ACTION </th>
										<th class="text-center text-white">CONFIRM</th>
										<th class="text-center text-white">CONFIRM BY</th>

									</tr>
								</thead>
								<tbody>									
									@foreach($data as $key => $value)
									<tr>
										 
									
										<td class="text-center">{{ ++$i }}</td>
										<td class="text-center">{{$value->rog_number}} </td>
										<td class="text-center">{{$value->part_number}} </td>
										<td class="text-center">{{$value->qty_request}} </td>
										<td class="text-center">										
										<?php if ($value->status == 'SELECT') {
												echo '<span class= "badge text-bg-light badge-font-size:20px;">WAITING SORTING</span>';
											} ?>
										 <?php if ($value->status == 'SORTING') {
												echo '<span class= "badge text-bg-primary">SORTING</span>';
											} ?>  
										<?php if ($value->status == 'DONE') {
											echo '<span class= "badge text-bg-success">DONE</span>';
										} ?> 	       
										</td>
										<td class="text-center">{{$value->register_at}} </td>
										<td class="text-center">{{$value->register_by}} </td>
										<td class="row">
											
										<div class="btn-group">
											
											<a class="btn btn-warning btn-sm mb-3 margin-right:20px  " href="{{url('register_part/' .$value->id. '/edit')}}"><i class="notika-icon notika-edit"></i>UPDATE</a>																	
											{{-- <form action="{{url('/register_part/'.$value->id)}}" method="POST" onsubmit="return confirm('Delete Part Data?')">
												@method('delete')
												@csrf							
												<input type="hidden" name="s_method" value="DELETE">
												<button type="submit" class="btn btn-outline-danger btn-sm" ><i class="bi bi-x-circle-fill"></i>DELETE</button> 
											</form>	 --}}

											<div class="modal fade" id="updateModal_{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-lg">
												  <div class="modal-content">
													<div class="modal-header">
													  <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE DATA</h1>
													  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<form action="register_part/update/{{$value->id}}" method="POST">
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
																				<input type="text" class="form-control mb-3" name="rog_number" placeholder="ROG NUMBER" value="{{$value->rog_number}}"required>
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
																						name="part_number" placeholder="PART NUMBER" value="{{$value->part_number}}"required>
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
																						name="qty_request" placeholder="QTY" value="{{$value->qty_request}}"required >
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
																						name="register_by" placeholder="REGISTER BY" value="{{$value->register_by}}"required>
																					
																				</div>
																			</div>
																		</div>
																	</div>	
																	<div class="row">															
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
											</div>'
									
										<br>
												 
										</td> 
										<td class="text-center">
											<?php
											if ($value->status== 'SORTING') {
												// href="javascript:void(0);"
												echo '<a  data-bs-toggle="modal" data-bs-target="#modal_confirm" id="confirm_part"
													data-confirm_id ="' . $value->id . '"
													data-confirm_status ="' . $value->status . '"													   
													class = "btn btn-outline-success btn-sm"><i class="bi bi-check-sm"></i> CONFIRM
												</a>';			
											}																	
											?>
										</td>
										<td class="text-center">
											{{$value->confirm_by}} 
										</td>
									</tr>
									@endforeach  
								</tbody>														
							</table>
						</div>				
					</div>
				</div>
				<div class="d-flex justify-content-center">
				{{ $data->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
 <!-- Modal -->



 {{-- href="{{url('register_part/' .$value->id. '/edit')}} --}}

{{-- MODAL CREATE --}}
 <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			
						{{-- <div class="row">
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
						</div> --}}

						<div class="row">
							<div class="col-lg-12 ">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika"></i>
									</div>
									<div class="bootstrap-select fm-cmp-mg">
										{{-- <select class="selectpicker" data-live-search="true" name="part_number">
											<option value="">PART NUMBER</option>
											@foreach($data_part as $dd)
											<option value="{{$dd}}">{{$dd}}</option>
											@endforeach
										</select> --}}

										<label for="exampleDataList" class="form-label">PART NUMBER</label>
										<input class="form-control" list="datalistOptions" id="exampleDataList" name="part_number" placeholder="Type to search...">
										<datalist id="datalistOptions">
											@foreach($data_part as $dd)
											<option value="{{$dd}}">{{$dd}}</option>
											@endforeach
										</datalist>
									</div>

								</div>
							</div>
						</div>
						<br>

					{{-- AUTO P/N --}}
						{{-- <div class="row">	 
							<div class="col-LG-12">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika"></i>
									</div>
									<div class="nk-int-st">
										{{-- <input type="text" class="form-control mb-3"
											name="part_number" placeholder="PART NUMBER AUTO" required> --}}
											{{-- <div class="bootstrap-select fm-cmp-mg">
												<select class="selectpicker" data-live-search="true" name="part_number">
													<option value="">PART NUMBER</option>
													@foreach($data_part as $dd)
													<option value="{{$dd}}">{{$dd}}</option>
													@endforeach
													</select>
											</div>
									</div>
								</div>
							</div>
						</div> --}}
					

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





<div class="modal fade" id="modal_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog bg-cyan">
	  <div class="modal-content ">
		<div class="modal-header">
		  <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body text-center">
			<form action="{{url('/register_part/confirm/') }}" method="POST">
				@csrf
				<div class="breadcomb-area">
					<div class="container">
						<h1 class="modal-title fs-5 text-white font-size:50px" id="exampleModalLabel">PART RECEIVED ?</h1>
						
							<div class="col-lg-12 ">
								<div class="form-group ic-cmp-int rounded">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-part"></i>
									</div>
									<div class="nk-int-st">
										<input type="text" class="form-control mb-3"
											name="confirm_by" placeholder="INPUT NIK" required>
										
									</div>
								</div>
							</div>
							
							<input type="hidden" name="id" id="confirm_id">
							<input type="hidden" name="status" id="confirm_status">
						<br>
						<br>					
						<div class="modal-footer text-center">
						<button type="button" class="btn btn-warning text-center btn-sm" data-bs-dismiss="modal">CANCEL</button>
						<button type="submit" class="btn btn-primary text-center btn-sm">CONFIRM</button>
						</div>	
					</div>
				</div>
			</form>
		</div>	
	  </div>
	</div>
</div>

  @endsection
  
  
  <script src="{{asset ('') }}js/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		$(document).on('click', '#confirm_part', function() { 
			var confirm_id = $(this).data('confirm_id')
			var confirm_status = $(this).data('confirm_status')	
			$('#confirm_id').val(confirm_id)
			$('#confirm_status').val(confirm_status)
		})
	});



$('.delete-btn').click(function() {
  // get the item's id from the data attribute
  var id = $(this).data('id');

  // show the Sweet Alert confirm dialog
  swal({
    title: "Are you sure?",
    text: "This action cannot be undone.",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      // if the user confirms, send an AJAX request to delete the item
      $.ajax({
        url: '/items/' + id,
        method: 'DELETE',
        success: function(data) {
          // if the delete was successful, show a success message and refresh the page
          swal("Success!", "The item has been deleted.", "success")
            .then(() => {
              location.reload();
            });
        },
        error: function(error) {
          // if there was an error, show an error message
          swal("Error!", "There was an error deleting the item.", "error");
        }
      });
    }
  });
});
</script>


