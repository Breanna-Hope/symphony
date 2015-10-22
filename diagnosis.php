<?php

session_start(); // Starting Session

//establishing variables
$cfname= ucfirst(strtolower($_SESSION['cfname']));
$clname= ucfirst(strtolower($_SESSION['clname']));
$cpin= $_SESSION['cpin'];
$mpi= $_SESSION['mpi'];
$cphone = array();
$ctype= array();
$crelation=array();
$rfname = '';
$rlname = '';
$rDOB = '';
$rGender = '';
$pfname = '';
$plname = '';
$rAllergies = '';
$rRoom ='';
$rcode='';
$rdiagnosis=array();
$rdiagnosis_onset=array();
$rbps = '';
$rbpd = '';
$rbp_date = '';

$error=''; // Variable To Store Error Message

include'queries.php';
include'vitals_query.php';
include'diagnosis_query.php';

//print_r($rcode);
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
			Symphony Caregiver Portal
		</title>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<nav class="col-sm-12 navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<img alt="Logo" src="SymphonyLogo.png" height="75" width="250">
				</div>
				<h2 class="navbar-text">
					Caregiver Portal
				</h2>
				<form method="post" action="logout.php">
		<button class="btn btn-default navbar-btn navbar-right" type="submit">
				Log Out
		</button>
		</form>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3">
					<table class="table">
						<thead>
							<tr>
								<th colspan="2">
									Caregiver Information
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Name:	
								</td>
								<td>
									<?php print_r ("$cfname $clname"); ?>
								</td>
							</tr>
							<tr>
								<td>
									Relation: 
								</td>
								<td>
									<?php while (list($key, $value) = each($crelation)) {echo $value;} ?>
								</td>
							</tr>
							<tr>
								<td>
									Phone:	
								</td>
								<td>
									<?php while (list($key, $value) = each($cphone)) {echo $value;} ?>
								</td>
							</tr>
							<tr>
								<td>
									Contact type:	
								</td>
								<td>
									<?php while (list($key, $value) = each($ctype)) {echo $value;} ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-5">
					<table class="table">
						<thead>
							<tr>
								<th colspan="4">
									Patient Information
								</th>
								<th>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Name: 
								</td>
								<td>
									<?php print_r ("$rfname $rlname"); ?>
								</td>
								<td>
									Room: 
								</td>
								<td>
									<?php print_r ("$rRoom"); ?>
								</td>
							</tr>
							<tr>
								<td>
									Date of Birth:
								</td>
								<td>
									<?php  print_r($rDOB);  ?>
								</td>
								<td>
									Primary Physician: 
								</td>
								<td>
									<?php print_r ("$pfname $plname"); ?>
								</td>
							</tr>
							<tr>
								<td>
									Gender: 
								</td>
								<td>
									<?php if ($rGender === "F"){print_r("Female");} else if ($rGender ==="M"){print_r("Male");} else {} ?>
								</td>
								<td>
									Allergies: 
								</td>
								<td>
									<?php while (list($key, $value) = each($rAllergies)) {echo $value;} ?>
								</td>
							</tr>
							<tr>
								<td>
									Code Status:
								</td>
								<td colspan="2">
									<?php while (list($key, $value) = each($rcode)) {echo $value;} ?>
								</td><td></td><td></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-4">
					<table class="table">
						<thead>
							<tr>
								<th colspan="4">
									Current Vitals
								</th>
								<th>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="2">
									BP: 
									<?php if ($rbps === NULL){print_r("N/A");} else{ print_r ("$rbps"."/"."$rbpd"."</br><small>"."($rbp_date)"."</small>");} ?>
								</td>
								<td colspan="2">
									Resp: 
									<?php if ($rresp === NULL){print_r("N/A");} else{ print_r ("$rresp"."</br><small>"."($rresp_date)"."</small>");} ?>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									Temp: 
									<?php if ($rtemp === NULL){print_r("N/A");} else{ print_r ("$rtemp"."</br><small>"."($rtemp_date)"."</small>");} ?>
								</td>
								<td colspan="2">
									BS: 
									<?php if ($rbs === NULL){print_r("N/A");} else{ print_r ("$rbs"."</br><small>"."($rbs_date)"."</small>");} ?>
								</td>		
							</tr>
							<tr>
								<td colspan="2">
									Pulse:  
									<?php if ($rpulse === NULL){print_r("N/A");} else{ print_r ("$rpulse"."</br><small>"."($rpulse_date)"."</small>");} ?>
								</td>
								<td colspan="2">
									0<sub>2</sub>: 
									<?php if ($r02 === NULL){print_r("N/A");} else{ print_r ("$r02"."</br><small>"."($r02_date)"."</small>");} ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<ul class="nav nav-tabs">
				<li>
					<a href="Therapy.php">Therapy</a>
				</li>
				<li>
					<a href="Medications.php">Medications</a>
				</li>
				<li class="active">
					<a href="Diagnosis.php">Diagnosis</a>
				</li>
				<li>
					<a href="Labs.php">Labs</a>
				</li>
				<li>
					<a href="Progress.php">Progress Notes</a>
				</li>
			</ul>
			<div class="dropdown">
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
				</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<table class="table">
						<thead>
							<tr>
								<th>
									Diagnosis
								</th>
								<th>
									Onset Date
								</th>
							</tr>
						</thead>
						<tbody>
							<?php for($i=0; $i < sizeof($rdiagnosis); $i++){
							print_r("<tr><td>");
							echo $rdiagnosis[$i];
							print_r("</td><td>");
							echo $rdiagnosis_onset[$i];
							print_r("</td></tr>");
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
			</div>
		</div>
		<!-- jQuery Version 1.11.0 -->
		<script src="js/jquery-1.11.1.js">
		</script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.js">
		</script>
	</body>
</html>