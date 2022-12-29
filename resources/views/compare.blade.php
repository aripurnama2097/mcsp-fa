<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="../resources/favicon.ico">
		<title>SORTING PART</title>
		<link rel="stylesheet" type="text/css" href="../bootstrap/4.6.0/css/"/>
		<link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
		<link rel="stylesheet" type="text/css" href="../DataTables/jquery-ui-1.12.1/jquery-ui.min.css"/>
		<link href="../../font/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">	
	</head>
	<body class="bg-primary">
		<nav class="navbar navbar-expand-lg navbar-light bg-primary">
			<a class="navbar-brand" href="#"><h3 class="text-white">COMPARE PART</h3></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<?//php include 'm_menu.php';?>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<!-- <div class="col text-center alert alert-primary">
					<h3>COMPARE MENU</h3>
				</div>
				<div class="w-100"></div> -->
				<div class="col text-center">
					<div class="accordion" id="accordionExample">
						<div class="card border-secondary mb-3">
							<div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><h5>COMPARE LABEL</h5></div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body text-primary">
									<!-- <form id="compareForm"> -->
										<input class="form-control form-control-lg mb-2 text-center" type="text" name="scanBy" value="" id="scanBy" maxlength="8" placeholder="SCAN NIK HERE">
										<!-- <label for="labelSlip">LABEL SLIP</label> -->
										<input class="form-control form-control-lg mb-2 text-center" type="text" name="labelSlip" value="" id="labelSlip" placeholder="SCAN LABEL SLIP HERE" disabled>
										<!-- <label for="labelPart">LABEL PART</label> -->
										<input class="form-control form-control-lg mb-2 text-center" type="text" name="labelPart" value="" id="labelPart" placeholder="SCAN LABEL PART HERE" disabled>
										<h5 id="msg" class="card-text text-success"></h5>
									<!-- </form> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="w-100"></div>
				<div class="col">
					<div class="container-fluid bg-light">
						<div class="table-responsive">
							<table id="table_id" name="table_id" class="table table-striped table-sm" style="width:100%">
								<thead>
									<tr>
										<th>ID</th>
										<th>LABEL SLIP</th>
										<th>LABEL PART</th>
										<th>SCAN RESULT</th>
										<th>SCAN DATE</th>
										<th>PIC</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Java Script -->
		<script type="text/javascript" src="../../DataTables/datatables.min.js"></script>
    	<script type="text/javascript" src="../../DataTables/jquery-ui-1.12.1/jquery-ui.min.js"></script>
		<script>
			$(document).ready( function () {
				// set focus on input nik
				$('#scanBy').focus();

				var dt_table = $('#table_id').DataTable({
					// fixedHeader: true,
					order: false,
					searching: false,
					paging: false,
					language: {
						loadingRecords: '<br><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i><br><br><span>Fetching data...</span><br>',
						info: '<p style="padding-left:10px">Showing _START_ to _END_ of _TOTAL_ entries</p>',
						infoEmpty: '<p style="padding-left:10px">Showing 0 to 0 of 0 entries</p>',
					},
					ajax: {
						url: '../json/mc_dispCompare.php',
						type: "POST",
						dataSrc: 'rows'
					},
					columns: [
						{ data: "AUTOID" }, { data: "LABELSLIP" }, { data: "LABELPART" }
						,{ data: "SCANRESULT" }, { data: "SCANDATE" }, { data: "PIC" }
					]
				});

				// Set focus on input Label Slip after scan
					$('#scanBy').on('keypress', function(e){
						if(e.which == 13) {
							var val = $('#scanBy').val();
							if (val != '') {
								$('#labelSlip').attr('disabled', false);
								$('#labelPart').attr('disabled', false);
								$('#labelSlip').focus();
							}
						}
					});
				// ------------------------------------------ //

				// Set focus on input Label Part after scan
					$('#labelSlip').on('keypress', function(e){
						if(e.which == 13) {
							var val_LabelPart = $('#labelSlip').val();
							if (val_LabelPart != '') {
								$('#labelPart').focus();
							}
						}
					});
				// ------------------------------------------ //

				// Start compare data
					$('#labelPart').on('keypress', function(e){
						if(e.which == 13) {
							var val_LabelSlip = $('#labelSlip').val();
							var val_LabelPart = $('#labelPart').val();
							var val_ScanBy = $('#scanBy').val();

							if (val_LabelSlip != '') {
								$.ajax({
									url: '../response/MC_compareLabel.php',
									type: 'POST',
									data: {labelPart:val_LabelPart,labelSlip:val_LabelSlip,scanBy:val_ScanBy},
									success: function(data){
										var result = JSON.parse(data);
										var status = result.success;
										var audio = '';
										if (status === false) {
											var audio = new Audio('../resources/sound/WRONG.mp3');
										} else {
											var audio = new Audio('../resources/sound/OK.mp3');
										}
										audio.play();
										$('#msg').html(result.msg);
										$('#labelPart').val('');
										$('#labelSlip').val('');
										dt_table.ajax.reload();
										$('#labelSlip').focus();
									}
								});
							}
						}
					});
				// ------------------------------------------ //
			});
		</script>
	</body>
</html>
