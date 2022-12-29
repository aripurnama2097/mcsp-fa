@extends('layouts.main')
@section('section')


 <body class="responsive">  
	<div class="breadcomb-area tb-res-mg-t-20">
		<div class="container text-center">
			<div class="row text-center">
				<div class="col-lg-12">
					<div class="breadcomb-list text-center ">
						<div class="row justify-content-center">					
								<div class="breadcomb-wp mb-lg-3 responsive">
									<div class="breadcomb-icon text-center">
										{{-- <i class="notika-icon notika-form"></i> --}}
										{{-- <p class="text-center text-bold"><i class="notika-icon notika-edit"></i>PARTLIST PICKING<p> --}}
									</div>
								</div>

							<div class="col-12 mb-5">
								<div class="card card-success ">
									<h4 class="text-center ">PICKING PART</h4>
								<div class="container">
									
									<div class="row">
										<div class="col-xs-12">
												<div class="table-responsive">
													<table class="table table-hover shadow-xxl " cell-padding="2">
														<thead class="table-dark">
															<tr>
																<th class="text-center text-white">NO</th>
																<th class="text-center text-white">ROG NUMBER</th>
																<th class="text-center text-white">PART NUMBER</th>
																<th class="text-center text-white">QTY REQUEST</th>
																<th class="text-center text-white">STATUS</th>
																<th class="text-center text-white">ACTION </th>
															</tr>
														</thead>
														<tbody>									
															@foreach($data as $key => $value)
															<tr>
																<td class="text-black text-center">{{ ++$i }}</td>
																<td class="text-black text-center">{{$value->rog_number}} </td>
																<td class="text-black text-center">{{$value->part_number}} </td>
																<td class="text-black text-center">{{$value->qty_request}} </td>
																<td class="text-black text-center">
																	<?php if ($value->status == 'SELECT') {
																		echo '<span class= "badge text-bg-warning badge-font-size:20px;">BEFORE PICKING</span>';
																	} ?>
																 <?php if ($value->status == 'PICKING') {
																		echo '<span class= "badge text-bg-primary">SUCCESS</span>';
																	} ?>  
																<?php if ($value->status == 'DONE') {
																	echo '<span class= "badge text-bg-success">DONE</span>';
																} ?> 	 
																</td>
																<td class="text-black text-center">
																<div class="dialog-pro dialog">
																	<?php if ($value->status =='SELECT'){?>
																	<a href="{{ url('/picking/detail/'.$value->id.'') }}" class="btn btn-success btn-sm">PICKING</a>
																	<?php }?>
																</div>
																<br>
																</td>
															</tr>
															@endforeach  
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br>
								{{ $data->links() }}
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

