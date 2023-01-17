@extends('layouts.main')
@section('section')


	<div class="breadcomb-area tb-res-mg-t-20 rounded">
		<div class="container">
			

				

								<div class="panel-heading">
									<div class="row">
										<div class="col-md-5">Total Records - <b><span id="total_records"></span></b></div>
										<div class="col-md-5">
											<div class="input-group input-daterange">
												<input type="date" name="start_date" id="start_date">
												<div class="input-group-addon">to</div>
												<input type="date" name="end_date" id="end_date">
											</div>
										</div>
										<div class="col-md-2">
											<button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
											<button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
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
															{{-- @foreach($data as $key => $value)
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
															@endforeach   --}}
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

<script type="text/javascript">

$(document).ready(function () {
    var date = new Date();

    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    var _token = $('input[name="_token"]').val();

    fetch_data();

    function fetch_data(start_date = '', end_date = '') {
        $.ajax({
            url: "{{url('/record/filter/')}}",
            method: "POST",
            data: {
                start_date: start_date,
                end_date: end_date,
                _token: _token
            },
            dataType: "json",
            success: function (data) {
                var output = '';
                $('#total_records').text(data.length);
                for (var count = 0; count < data.length; count++) {
                    output += '<tr>';
                    output += '<td>' + data[count].rog_number + '</td>';
                    output += '<td>' + data[count].part_number + '</td>';
                    output += '<td>' + data[count].csr_eid + '</td>';
                }
                $('tbody').html(output);
            }
        })
    }

    $('#filter').click(function () {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if (start_date != '' && end_date != '') {
            fetch_data(start_date, end_date);
        } else {
            alert('Both Date is required');
        }
    });

    $('#refresh').click(function () {
        $('#start_date').val('');
        $('#end_date').val('');
        fetch_data();
    });
});

</script>
@endsection

