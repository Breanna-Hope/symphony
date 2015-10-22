<?php
session_start();

$resid= $_SESSION['resid'];
$facility = $_SESSION['facility'];
$mpi = $_SESSION['mpi'];

//echo $resid;
//echo $facility;

$serverName = "localhost";
$connectionInfo = array( "Database"=>"xxx", "UID"=>"xxx", "PWD"=>"xxx");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) 
{
   // echo "Connection established.<br />";
}
else
{
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}

//sql select statement to retrieve contact type(s).
$sql = "SELECT admission_date, original_admission_date FROM clients WHERE client_id = '$resid' AND fac_id = '$facility';"; 
$stmt= sqlsrv_query( $conn, $sql);
if( sqlsrv_fetch( $stmt ) === false) {
	echo "failure",
     die( print_r( sqlsrv_errors(), true));
}
$readmit = sqlsrv_get_field( $stmt, 0)->format('m/d/Y');
$admit = sqlsrv_get_field( $stmt, 1)->format('m/d/Y');

sqlsrv_free_stmt( $stmt);

$sql = "SELECT name FROM facility WHERE fac_id = '$facility';"; 
$stmt= sqlsrv_query( $conn, $sql);
if( sqlsrv_fetch( $stmt ) === false) {
	echo "failure",
     die( print_r( sqlsrv_errors(), true));
}
$facname= sqlsrv_get_field( $stmt, 0);

sqlsrv_free_stmt( $stmt);
//sql select statement to retrieve contact type(s).

$sql = "SELECT p.ProviderFirstName, p.ProviderLastName FROM clients AS c INNER JOIN PatientPrimaryProvider AS p ON c.primary_physician_id = p.ProviderPatientID WHERE c.client_id = '$resid' AND c.fac_id = '$facility';"; 
$stmt= sqlsrv_query( $conn, $sql);
if( sqlsrv_fetch( $stmt ) === false) {
	echo "failure",
     die( print_r( sqlsrv_errors(), true));
}
$pfname = sqlsrv_get_field( $stmt, 0);
$plname = sqlsrv_get_field( $stmt, 1);

sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve contact type(s).
$sql = "SELECT first_name, last_name FROM mpi Where mpi_id = '$mpi';"; 
$stmt= sqlsrv_query( $conn, $sql);
if( sqlsrv_fetch( $stmt ) === false) {
	echo "failure",
     die( print_r( sqlsrv_errors(), true));
}
$fname = sqlsrv_get_field( $stmt, 0);
$lname = sqlsrv_get_field( $stmt, 1);

sqlsrv_free_stmt( $stmt);
 
 
 //sql select statement to retrieve contact type(s).
$sql = "SELECT ReasonForTransfer FROM vRtrnToHsptlByAdmtLctn Where FacilityID = '$facility' AND ClientID = '$resid';"; 
$stmt= sqlsrv_query( $conn, $sql);
if( sqlsrv_fetch( $stmt ) === false) {
	echo "failure",
     die( print_r( sqlsrv_errors(), true));
}
$reason = sqlsrv_get_field( $stmt, 0);

 ?>
 <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Symphony Caregiver Portal">
		<meta name="author" content="Breanna Hope">
		<title>
			Resident Readmit Form
		</title>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
	<div class="container">
		<h3>Resident Readmit Form</h3>
			<div class="row">
				<div class="col-md-4">
					<p>Facility:  </p> 
				</div>
				<div class="col-md-8">
					<?php print_r ($facname); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>Resident ID:  </p> 
				</div>
				<div class="col-md-8">
					<?php print_r ($resid); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>Rush Physicians/NP’s involved in care:  </p> <!--[Primary Provider] -->
				</div>
				<div class="col-md-8">
					<?php if ($pfname === NULL || empty($pfname) ){print_r("N/A");} else{ print_r ( $pfname." ".$plname); }?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>Resident Name:  </p>
				</div>
				<div class="col-md-8">
					<?php print_r ($fname.' '.$lname); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>Date of Initial Admission:  </p>
				</div>
				<div class="col-md-8">
					<?php print_r ($admit); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>Readmission Date:  </p>
				</div>
				<div class="col-md-8">
					<?php print_r ($readmit); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>Reason for Hospitalization: </p>
				</div>
				<div class="col-md-8">
					<?php if ($reason === NULL || empty($reason)){print_r("N/A");} else{ echo $reason;} ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<p>LOS in the Hospital:  </p>
				</div>
				<div class="col-md-8">
					<select class="form-control" name="facility" id="facility" aria-labelledby="facility">
						<option>Select LOS:</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
					</select>
				</div>
			</div>
			<div class="row">
						<div class="col-md-4">
							<p>Diagnosis: </p>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3"></textarea>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>What treatment/discussions occurred in hospital: </p>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3"></textarea>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>Current Advanced Directives:</p>
						</div>
						<div class="col-md-8">
							<?php print_r ($addirect); ?>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>What treatment/discussions occurred in hospital: </p>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3"></textarea>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>Any Change in Advance Directives:</p>
						</div>
						<div class="col-md-8">
							<?php print_r ($comment); ?>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>Partners in Care Needed: </p>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3"></textarea>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>Resident/Family Education Needed: </p>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3"></textarea>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>Palliative Care Consult Needed: </p>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3"></textarea>
						</div>						
					</div> <!-- /row -->
					<div class="row">
						<div class="col-md-4">
							<p>Hospice Recommended: </p>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" rows="3"></textarea>
						</div>						
					</div> <!-- /row -->
</div>
 <!-- jQuery Version 1.11.0 -->
		<script src="js/jquery-1.11.1.js">
		</script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.js">
		</script>
</body>
</html>
