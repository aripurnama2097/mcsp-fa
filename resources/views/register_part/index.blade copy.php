@extends('layouts.main')
@section('section')


 <body>  
	<div class="breadcomb-area ">	
		<div class="container">			
{{-- 			
			<div class="pd-5">
				<form action="{{url('/register_part/create/')}}" method="POST">
					<button  data-toggle="tooltip" data-placement="left" title="create part" class="btn btn-outline-success btn-sm"><i class="notika-icon notika-edit mb-3"></i>CREATE</i></button>	
				</form>
			</div> --}}

			<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="notika-icon notika-edit mb-3"></i>CREATE</i>		
				</button>
				<br>
				<br>
				
				
			<div class="row">
				<div class="col-lg-12 ">
					<div class="breadcomb-list shadow-lg">
						<div class="row ">						
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2 style="font-weight:bold">List Part</h2>
										<br>
										<br>
									</div>
								</div>
							 
								 @if(Session::has('success'))
									<p class="alert alert-success">{{Session::get('success')}}</p>
								@endif

								<form action="{{url('register_part')}}" method="GET">			
										<input type="text" name="keyword"  value="" class="form-control mb-2 pad-l20" placeholder="Search..." autofocus>
										<button class="btn btn-primary btn-sm" type="submit" ><i class="bi bi-search"></i>SUBMIT</button>
										<br>
										<br>								
								</form>				
								<div class="container">
												<div class="table table-hover shadow-xl table-sm ">
													<table  class="table table-sm">
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

															</tr>
														</thead>
														<tbody>									
															@foreach($data as $key => $value)
															<tr class="mb-1 pd-1">
																<td class="text-center">{{ ++$i }}</td>
																<td class="text-center">{{$value->rog_number}} </td>
																<td class="text-center">{{$value->part_number}} </td>
																<td class="text-center">{{$value->qty_request}} </td>
																<td class="text-center"> 										
																<?php if ($value->status == 'SELECT') {
																		echo '<span class= "badge text-bg-light badge-font-size:20px;">SELECT</span>';
																	} ?>
																 <?php if ($value->status == 'PICKING') {
																		echo '<span class= "badge text-bg-primary">PICKING</span>';
																	} ?>  
																<?php if ($value->status == 'DONE') {
																	echo '<span class= "badge text-bg-success">DONE</span>';
																} ?> 	       
																</td>
																<td class="text-center">{{$value->register_at}} </td>
																<td class="text-center">{{$value->register_by}} </td>
																<td class="text-center">


																	<div class="d-grid gap-2 d-md-block">
																		<a class="btn btn-warning btn-sm mb-3" href="{{url('register_part/' .$value->id. '/edit')}}"><i class="notika-icon notika-edit"></i>UPDATE</a>																
																<form action="{{url('/register_part/'.$value->id)}}" method="POST">
																	@csrf
																	<input type="hidden" name="s_method" value="DELETE">
																	<button type="submit" class="btn btn-outline-danger btn-sm" ><i class="notika-icon notika-trash"></i>DELETE</button> 
																</form>		
																	</div>
																<br>				 
																</td> 
																<td class="text-center">
																	<?php
																	if ($value->status== 'PICKING') {
																		// href="javascript:void(0);"
																		echo '<a  data-bs-toggle="modal" data-bs-target="#modal_confirm" id="confirm_part"
																			data-confirm_id ="' . $value->id . '"
																			data-confirm_status ="' . $value->status . '"													   
																			class = "btn btn-outline-success btn-sm">
																			Confirm 
																		</a>';
																		// <button type="button" class="btn btn-outline-warning btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="notika-icon notika-edit mb-3"></i>CREATE</i>		
																	}																	
																	?>
														</td>
															</tr>
															@endforeach  
														</tbody>														
													</table>														
												</div>
												<br>
												<br>
											{{-- </div>  --}}
											
												{{ $data->links() }}											
									</div>
						   </div>
						</div>
					</div>
				</div>
			</div>
		{{-- </div>
	</div>    
</div>  --}}

 <!-- Modal -->






 <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h1 class="modal-title fs-5" id="exampleModalLabel">REGISTER PART</h1>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="{{ url('/register_part/createPart/') }}" method="post">
				@csrf
				<div class="breadcomb-area">
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
										<i class="notika-icon notika"></i>
									</div>
									<div class="nk-int-st">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                    <h2>Serach Option</h2>
                                </div>
                                <div class="bootstrap-select fm-cmp-mg">
                                    <select class="selectpicker" data-live-search="true">
											<option>Drama</option>
											<option>Cariska</option>
											<option>Cheriska</option>
											<option>Malias</option>
											<option>Kamines</option>
											<option>Austranas</option>
										</select>
                                </div>
                            </div>
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




<div class="modal fade" id="modal_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body text-center">
			<form action="{{url('/register_part/confirm/') }}" method="POST">
				@csrf
				<div class="breadcomb-area">
					<div class="container">
						<h1 class="modal-title fs-5 text-center" id="exampleModalLabel">CONFIRM PART?</h1>
						<input type="hidden" name="id" id="confirm_id">
						<input type="hidden" name="status" id="confirm_status">
						<br>
						<br>					
						<div class="modal-footer text-center">
						<button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary text-center">Save changes</button>
						</div>	
					</div>
				</div>
			</form>
		</div>	
	  </div>
	</div>
</div>


	{{-- MODAL CONFIRM PART  --}}
<div class="modal fade" id="smodal_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">		  
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="{{url('/register_part/confirm/') }}" method="POST">
				@csrf
				
				<div class="breadcomb-area">
					<div class="container">
						<div class="row">					
							<div class="col-8">
								<h1 class="modal-title fs-5 text-center" id="exampleModalLabel">CONFIRM PART ?</h1>
								<input type="text" name="id" id="confirm_id">
								<input type="text" name="status" id="confirm_status"value="DONE">
								<br>
								<br>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  						<button type="submit" class="btn btn-primary">Save changes</button>
							</div>										
						</div>
					</div>
				</div>
			</form>
		</div>
		{{-- <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  <button type="submit" class="btn btn-primary">Save changes</button>
		</div> --}}
	  </div>
	</div>
 </div>


  @endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
				 $(document).on('click', '#confirm_part', function() { 
					 var confirm_id = $(this).data('confirm_id')
					 var confirm_status = $(this).data('confirm_status')	
					 $('#confirm_id').val(confirm_id)
					 $('#confirm_status').val(confirm_status)
				 })
			 })
</script>


