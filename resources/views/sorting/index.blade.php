@extends('layouts.main')
@section('section')


<body class="responsive">  
	<div class="breadcomb-area tb-res-mg-t-20">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="col-lg-12 shadow-sm rounded ">
						<div class="breadcomb-list rounded-3 border-success">
							<div class="row border-success">
								<div class="col-lg-6 border-success">
									<div class="breadcomb-wp border-success ">
										<div class="breadcomb-icon">
											<i class="bi bi-funnel"></i>
										</div>
										<div class="breadcomb-ctn ">
											<h2>FILTER</h2>
											<form id="date-form">
												<div class="input-group mb-3 rounded-1">
												<label for="date"></label>
												<input type="date" class="form-control rounded-3 form-control-sm" name="start_date" id="start-date" value="{{date('Y-m-d')}}">
												<input type="date" class="form-control rounded-3 form-control-sm" name="end_date" id="end-date" value="{{date('Y-m-d')}}">	
																				
												<button type="submit" data-toggle="tooltip" data-placement="left" title="" class="btn btn-primary btn-sm rounded">Search</buton>
												
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
														<th class="text-center text-white">DATE </th>
													</tr>
												</thead>
												<tbody>									
													@foreach($data as $key => $value)
													<tr class="table-light">
														<?php if ($value->status == 'SORTING') {
															echo '<tr style="background-color: rgb(144, 144, 144);">';
														} else {
															echo '<tr style="background-color:#82d489;">';
																
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
														<td class="text-black text-center">{{$value->picking_at}} </td>
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

<script type="text/javascript">

	$(document).ready(function() {

		$('#date-form').submit(function(event) {
			event.preventDefault();

			var startDate = $('#start-date').val();
			var endDate = $('#end-date').val();

			// send the AJAX request to the route
			$.ajax({
				url: "{{url('sorting/filter/')}}",
				method: 'POST',
				data: {
					start_date: startDate,
					end_date: endDate,
					_token: '{{ csrf_token() }}'
				},
				success: function(response) {
				var data=""
					console.log(data);
					// if (data !== null && typeof data !== "undefined") {
					// // do something with data.id
					// }
					// else {
					// console.log("data is null or undefined");
					// }
					
					$.each(response,function(key, value){

					data = data + "<tr>"
					
					data = data + "<td>"+value.id+"</td>"				
					data = data + "<td>"+value.rog_number+"</td>"
					data = data + "<td>"+value.part_number+"</td>"
					data = data + "<td>"+value.qty_request+"</td>"
					data = data + "<td>"+value.status+"</td>"
					data = data + "<td>"+value.picking_at+"</td>"
				
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

