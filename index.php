<?php
//include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Symphony Caregiver Portal">
 <meta name="author" content="Breanna Hope">
 <title>Symphony Caregiver Portal</title>
 <!-- Bootstrap Core CSS -->
 <link href="css/bootstrap.css" rel="stylesheet">
 <!-- Custom CSS -->
 <link href="style.css" rel="stylesheet">
 </head>
<body>
<div class="container">
<h1>Symphony Caregiver Portal </h1>

 <div class="container well">

<form method="post" action="login.php">
	<div class="row">
		<div class="col-xs-6">
			<h3 class="form-signin-heading">Log-in</h3>
		</div>
	</div>
	<div class='row'>
		<div class="col-xs-4">   
			<label for="scp_firstname" class="sr-only">First Name</label>
			<input type="text" id="scp_firstname" name="scp_firstname" class="form-control" placeholder="First Name" required autofocus>
		</div>
		<div class="col-xs-4">
			<label for="scp_lastname" class="sr-only">Last Name</label>
			<input type="text" id="scp_lastname" name="scp_lastname" class="form-control" placeholder="Last Name" required autofocus> 
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<label for="scp_pin" class="sr-only">Pin</label>
			<input type="password" id="scp_pin" name="scp_pin" class="form-control" placeholder="Pin" required>
		</div> 
	</div>
	
	<div class="row">
		<div class="col-xs-3">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
		</div>
	</div>
</form>
</div> <!-- /container -->
 <!-- jQuery Version 1.11.0 -->
 <script src="js/jquery-1.11.1.js"></script>
 <!-- Bootstrap Core JavaScript -->
 <script src="js/bootstrap.js"></script>
</body>
</html>