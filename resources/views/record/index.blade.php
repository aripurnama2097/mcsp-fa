@extends('layouts.main')
@section('section')


	<div class="breadcomb-area tb-res-mg-t-20 rounded">
		<div class="container">
			<div class="row">
							
							
							
							\
							
								
								
								</div>

								<div class="col-lg-12 shadow-sm rounded border-success">
									<div class="breadcomb-list rounded-3 border-success">
										<div class="row border-success">
											<div class="col-lg-6 border-success">
												<div class="breadcomb-wp border-success ">
													<div class="breadcomb-icon">
														<i class="notika-icon notika-form"></i>
													</div>
													<div class="breadcomb-ctn ">
														<h2>FILTER</h2>
														<form action="{{url('/record/filter')}}" method="PUT">
															@csrf
															<div class="input-group mb-3">
																<input type="date" class="form-control" name="start_date">
																<input type="date" class="form-control" name="end_date">
																<button class="btn btn-success" type="submit">Filter</button>
															</div>			
														</form>
														
													</div>
												</div>

												<div class="col-2">
													<div class="breadcomb-report">
														<a href="export-csv" target="_blank" data-toggle="tooltip" data-placement="left" title="" class="btn waves-effect" data-original-title="Download Report"><i class="notika-icon notika-sent"></i></a>
													</div>	
												</div>	
											</div>
											<br>
											<br>
											
										</div>
									</div>
								</div>
								<br>
											
							<div class="col-12 mb-5">
							<div class="card card-success">
								<h4 class="text-center">SORTING RECORD</h4>	
								
								<div class="container responsive">
									<div class="row ">
										<div class="col-xs-12 ">
											<div style="overflow-x:auto;">
												<div class="table-responsive">
													<table class="table table-hover shadow-sm rounded">
														<thead class="table-dark">
															<tr>
																<th class="text-center text-white ">NO</th>
																<th class="text-center text-white">NIK</th>
																<th class="text-center text-white">ROG NUMBER</th>
																<th class="text-center text-white">PART NUMBER</th>
																<th class="text-center text-white">PO</th>
																<th class="text-center text-white">LABEL ORIGINAL</th>
																<th class="text-center text-white">STATUS</th>
																<th class="text-center text-white">DATE </th>
																<th class="text-center text-white">LABEL SORTING </th>
																<th class="text-center text-white">LABEL BALANCE </th>
															</tr>
														</thead>
														<tbody>									
															@foreach($data as $key => $value)
															<tr class="table-light">
																<td class="text-black text-center">{{ ++$i }}</td>
																<td class="text-black text-center">{{$value->rog_number}} </td>
																<td class="text-black text-center">{{$value->part_number}} </td>
																<td class="text-black text-center">{{$value->qty_request}} </td>
																<td class="text-black text-center">{{$value->qty_request}} </td>
																<td class="text-black text-center">{{$value->qty_request}} </td>
																<td class="text-black text-center">
																<div class="dialog-pro dialog">
																
																</div>
																</td>
																<td class="text-black text-center">{{$value->picking_at}} </td>
																<td> </td>
																<td> </td>
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


@endsection

