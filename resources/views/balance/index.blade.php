@extends('layouts.mainRegister')
@section('section')


<body class="responsive">  
	<div class="breadcomb-area tb-res-mg-t-20">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list bg-light shadow-lg rounded-3">
						<div class="row justify-content-center">					
							<div class="breadcomb-wp mb-lg-3">
								<div class="breadcomb-icon">
										<i class="notika-icon notika-form"></i>
									</div>
								</div>

								<div class="col-12 mb-5">
							<div class="card card-success">
								<h4 class="text-center">LABEL SCAN</h4>
								<div class="container ">
									<div class="row ">
										<div class="responsive">
											<div style="overflow-x:auto;">
												<div class="table-responsive">
													<table class="table table-hover shadow-sm ">
														<thead class="table-dark">
															<tr>
																<th class="text-center text-white ">NO</th>
																<th class="text-center text-white">ROG NUMBER</th>
																<th class="text-center text-white">PART NUMBER</th>
																{{-- <th class="text-center text-white">STATUS</th> --}}
																<th class="text-center text-white">ACTION </th>
															</tr>
														</thead>
														<tbody>									
															@foreach($data as $key => $value)
															<tr class="table-light">
																<td class="text-black text-center">{{ ++$i }}</td>
																<td class="text-black text-center">{{$value->rog_number}} </td>
																<td class="text-black text-center">{{$value->part_number}} </td>
																
																<td class="text-black text-center">
																<div class="dialog-pro dialog"> 												
																		<a href="{{ url('/balance/view/'.$value->id.'') }}" 
																		class="btn btn-success btn-sm rounded-2">SCAN</a>			
																</div>
																</td>
															</tr>

															@endforeach  
														</tbody>
													</table>
													<div style="justify-content-md-center ">
													{{ $data->links() }}
													</div>
												</div>
												</div>
											</div>
										</div>
									</div>
								</div>
						   </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>    
</div> 
</body>

@endsection

