@extends('layouts.main')
@section('section')


	<div class="breadcomb-area tb-res-mg-t-20 rounded">
		<div class="container">
			<div class="row">
			
								</div>

								<div class="col-lg-12 shadow-sm rounded border border-secondary">
									<div class="breadcomb-list rounded-3 border-success">
										<div class="row border-success">
											<div class="col-lg-6 border-success">
												<div class="breadcomb-wp border-success ">
													<div class="breadcomb-icon">
														<i class="notika-icon notika-form"></i>
													</div>
													<div class="breadcomb-ctn ">
														<h2>FILTER</h2>
														<form id="date-form">
															<div class="input-group mb-3 rounded-1">
															<label for="date"></label>
															<input type="date" class="form-control rounded-3 form-control-sm border border-success" name="start_date" id="start-date" value="{{date('Y-m-d')}}">
															<input type="date" class="form-control rounded-3 form-control-sm border border-success" name="end_date" id="end-date" value="{{date('Y-m-d')}}">	
																							
															<button type="submit" data-toggle="tooltip" data-placement="left" title="" class="btn btn-outline-success btn-sm rounded">Submit</buton>
															
															</div>
															<div class="breadcomb-report">
																{{-- FILTER --}}
																
																{{-- DOWNLOAD --}}
																<button type="button" id="export-csv" data-toggle="tooltip" data-placement="left" title="" class="btn waves-effect" data-original-title="Download Report"><i class="notika-icon notika-sent"></i></buton>
															</div>
														</form>
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
							{{-- <div class="card card-success border border-secondary"> --}}
								<h4 class="text-center">SORTING RECORD</h4>	
								
								
						   {{-- </div> --}}

						<div class="breadcomb-list shadow rounded-3">
							<div class="card card-success">
								<div class="col">
									<div class="container-fluid">
										<div class="table-responsive bg-light  shadow rounded">
											<table class="table table-hover srounded align-middle">
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
														<td class="text-black text-center">{{$value->sorting_by}} </td>
														<td class="text-black text-center">{{$value->rog_number}} </td>
														<td class="text-black text-center">{{$value->part_number}} </td>
														<td class="text-black text-center">{{$value->PO}} </td>
														<td class="text-black text-center">{{$value->label_original}} </td>
														<td class="text-black text-center">{{$value->status}} </td>
														<td class="text-black text-center">{{$value->shorting_date}} </td>
														<td class="text-black text-center">{{$value->label_sorting}} </td>
														<td class="text-black text-center">{{$value->label_balance}} </td>
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

<script type="text/javascript">

			$(document).ready(function() {
				$('#date-form').submit(function(event) {
					event.preventDefault();

					var startDate = $('#start-date').val();
    				var endDate = $('#end-date').val();

					// send the AJAX request to the route
					$.ajax({
						url: "{{url('/record/filter/')}}",
						method: 'POST',
						data: {
							start_date: startDate,
        					end_date: endDate,
							_token: '{{ csrf_token() }}'
						},
						success: function(response) {
						var data=""
							console.log(data);

							$.each(response,function(key, value){

							data = data + "<tr>"
							data = data + "<td>"+value.id+"</td>"
							data = data + "<td>"+value.sorting_by+"</td>"
							data = data + "<td>"+value.rog_number+"</td>"
							data = data + "<td>"+value.part_number+"</td>"
							data = data + "<td>"+value.PO+"</td>"
							data = data + "<td>"+value.label_original+"</td>"
							data = data + "<td>"+value.status+"</td>"
							data = data + "<td>"+value.shorting_date+"</td>"
							data = data + "<td>"+value.label_sorting+"</td>"
							data = data + "<td>"+value.label_balance+"</td>"
							data = data + "</tr>"
							})
							$('tbody').html(data);
						}
					});
				});
				$("#export-csv").on("click",function(){
					let start_date = $('#start-date').val();
    				let end_date = $('#end-date').val();

					window.open("{{url('/record/download')}}"+"?start_date="+start_date+"&end_date="+end_date);

				});
			});

</script>
@endsection

