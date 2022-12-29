@extends('layouts.main')

@section('section')


	<div class="">	
		<div class="container">
            <div class="row">
                <br>
                <div class="col-md-12">
                    <a href="{{url('./sorting')}}" class="btn btn-secondary bi bi-back mt-3"><i class="notika-icon notika-back"></i>Back</a>
                </div>

                
            </div>
            <br>

           
        {{-- <div class="col">
                <div class="accordion" id="accordionExample">
                    <div class="card  mb-5 shadow-lg "> --}}
                        <div class="card-body mb-3">                              
                                @foreach($data as $key => $value)
                            <div class="breadcomb-list shadow-lg">
                                <input style="text-bold font-size:25px"class="text-center text-primary " type="hidden" name="rog_number" value="{{$value->rog_number}}"  id="rog_number"  disabled>	                               
                                <p style="text-bold font-size:25px" class="mb-2 text-success  font-size:25px">PART  NUMBER</p>
                                <input class="font-weight-bold" type="text" name="part_number" value="{{$value->part_number}}"  id="part_number"  disabled>
                                <br>               
                                <input type="hidden" name="status" value="PICKING"  id="status"  disabled>
                                <br> 
                            </div>
                                <br>   
                            <div class="breadcomb-list shadow-lg">
                                {{-- <div class="card card-success">	
                                    <div class="col"> --}}
                                    <br>                                                               
                                    <h4 class="font-size:25px text-center text-primary">SORTING PART</h4>
                                    <input class="form-control form-control-lg mb-3 text-center ml-lg-2 " type="text" name="picking_by" value="" id="picking_by" maxlength="8" placeholder="SCAN NIK HERE" >                                
                                    <input class="form-control form-control-lg mb-4  text-center" type="text" name="scan_label"  value="" id="scan_label" placeholder="SCAN LABEL PART HERE" disabled> 
                                    <input class="form-control form-control-lg mb-4  text-center" type="text" name="scan_label"  value="" id="scan_label" placeholder="QTY" disabled>                                                                                              
                                    <h5 id="msg" class="card-text text-success"></h5>
                                    <label class="text-center text-bg-success" id="result_OK"> 
                                    </label>
                                    <label class="text-center text-bg-danger" id="result_NG"> 
                                    </label>
                                    @endforeach                                             
                                {{-- </div>
                            </div>  --}}
                            </div>                                               
                    </div>
                
                
                    {{-- </div>
            </div>  --}}

                <div class="breadcomb-list shadow">
                    <div class="card card-success">	
                        <div class="col">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    <h4 class="text-center">RESULT</h4>
                                    <table class="table table-bordered data-table shadow-sm">
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
</div> 



@endsection

<script>

$(document).ready( function () {
        $('#picking_by').on('keypress', function(e){
				if(e.which == 13) {
				var val = $('#picking_by').val();
					if (val != '') {
						$('#scan_label').focus();
					}
                        
				} 
            })
        
        
        
        // Set focus on input Label Slip after scan
            $('#picking_by').on('keypress', function(e){
						if(e.which == 13) {
							var val = $('#picking_by').val();
							if (val != '') {
								$('#scan_label').attr('disabled', false);
								$('#labelPart').attr('disabled', false);
								$('#scan_label').focus();
							}
						}
					});
				// ------------------------------------------ //

				// Set focus on input Label Part after scan
					$('#scan_label').on('keypress', function(e){
						if(e.which == 13) {
							var val_LabelPart = $('#scan_label').val();
							if (val_LabelPart != '') {
								$('#labelPart').focus();
							}
						}
					});
        
        });  

				// ----------
</script>


	
