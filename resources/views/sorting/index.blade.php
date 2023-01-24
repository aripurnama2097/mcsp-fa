@extends('layouts.main')
@section('section')


<body class="responsive">  
	<div class="breadcomb-area tb-res-mg-t-20">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					{{-- <div class="breadcomb-list bg-light shadow-lg rounded-3">
						<div class="row justify-content-center">					
							<div class="breadcomb-wp mb-lg-3">
								<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
								</div>

								<div class="col-12 mb-5">
						
						   </div>
						</div>
					</div> --}}

						<div class="breadcomb-list shadow rounded-3">
							{{-- <div class="card card-success"> --}}
								<div class="col">
									<div class="container-fluid">
										<div class="table-responsive rounded-2">
											<h4 class="text-center">SORTING PART</h4>
											<table class="table table-hover shadow-sm rounded">
												<thead class="table-dark">
													<tr>
														<th class="text-center text-white ">NO</th>
														<th class="text-center text-white">ROG NUMBER</th>
														<th class="text-center text-white">PART NUMBER</th>
														<th class="text-center text-white">QTY REQUEST</th>
														<th class="text-center text-white">STATUS</th>
														<th class="text-center text-white">ACTION </th>
													</tr>
												</thead>
												<tbody>									
													@foreach($data as $key => $value)
													<tr class="table-light">
														<?php if ($value->status == 'SORTING') {
															echo '<tr style="background-color: rgb(144, 144, 144);">';
														} else {
															echo '<tr style="background-color:#69dec1;">';
																
														}?>       
														<td class="text-black text-center">{{ ++$i }}</td>
														<td class="text-black text-center">{{$value->rog_number}} </td>
														<td class="text-black text-center">{{$value->part_number}} </td>
									
														<td class="text-black text-center">{{$value->qty_request}} </td>
														<td class="text-black text-center">
															<?php if ($value->status == 'SELECT') {
																echo '<span class= "badge text-bg-warning badge-font-size:20px;">BEFORE PICKING</span>';
															} ?>
															<?php if ($value->status == 'SORTING') {
																echo '<span class= "badge text-bg-danger">BEFORE SORTING</span>';
															} ?>

															<?php if ($value->status == 'DONE') {
																echo '<span class= "badge text-bg-primary">SUCCESS</span>';
															} ?>
																														
														</td>
														<td class="text-black text-center">
														<div class="dialog-pro dialog"> 
															<?php if ($value->status =='SORTING'){?>
																<a href="{{ url('/sorting/view/'.$value->id.'') }}" 
																class="btn btn-success btn-sm rounded-2">SORTING</a>
															<?php }?>
														</div>
														</td>
													</tr>
	
													@endforeach  
												</tbody>
											</table>
											<div class="d-flex justify-content-center">
												{{ $data->links() }}
											</div>
										</div>
									</div>
								</div>
							{{-- </div> --}}
						</div>
				</div>
			</div>
		</div>
	</div>    
</div> 
</body>

@endsection

