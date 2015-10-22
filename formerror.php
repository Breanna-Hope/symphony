<?php
if(isset($_SESSION['login_user'])){
session_cache_expire();
session_unset();
session_destroy();
$_SESSION['login_user']='';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Resident Readmit Form</title>
				<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="style.css" rel="stylesheet">		
	</head>
	<body>
	
	
	<div class="container">
		<form method="post" action="form_login.php">
		<h3> Resident Readmit Form </h3>
		<div class="container well">
		<h4 class="text-danger">Facility and Resident ID do not match. Please try again.</h4>
			<div class="col-lg-6">
			<select class="form-control" id="facility" aria-labelledby="facility">
				<option value=''>Select Facility:</option>
								<option value="16">Aria Post Acute Care</option>
								<option value="17">Bronzeville Park</option>
								<option value="18">California Gardens</option>
								<option value="9001">Care Line</option>
								<option value="20">Claremont of Buffalo Grove</option>
								<option value="19">Claremont of Hanover Park</option>
								<option value="21">Imperial of Lincoln Park</option>
								<option value="22">Ivy Apartments</option>
								<option value="23">Jackson Square</option>
								<option value="24">Monroe Pavilion</option>
								<option value="31">NuCare Services Corporation</option>
								<option value="32">NuVision Holdings, LLC</option>
								<option value="28">Renaissance at 87th Street</option>
								<option value="25">Renaissance at Midway</option>
								<option value="26">Renaissance at Park South</option>
								<option value="27">Renaissance at South Shore</option>
								<option value="29">Seven Oaks</option>
								<option value="13">Springdale Village Assisted Living</option>
								<option value="12">Springdale Village Healthcare</option>
								<option value="14">Springdale Village Independent Living</option>
								<option value="11">Sycamore Village</option>
								<option value="5">Symphony of Countryside</option>
								<option value="6">Symphony of Crestwood</option>
								<option value="36">Symphony of Crown Point - Assisted Living</option>
								<option value="35">Symphony of Crown Point - Skilled Nursing</option>
								<option value="3">Symphony of Decatur</option>
								<option value="34">Symphony of Dyer - Assisted Living</option>
								<option value="33">Symphony of Dyer - Skilled Nursing</option>
								<option value="30">Symphony of Evanston</option>
								<option value="1">Symphony of Joliet</option>
								<option value="8">Symphony of Lincoln</option>
								<option value="7">Symphony of Maple Crest</option>
								<option value="9">Symphony of McKinley</option>
								<option value="15">Symphony of Mesa</option>
								<option value="10">Symphony of Northwoods</option>
								<option value="2">US-Multi DB Template-ALF1</option>
							</select>
						</div>
					<label for="resid">Resident ID</label>
					<input type="text" name="resid" id="resid" />
					
				
			<input type="submit" value="Send" />
		</div><!-- /container well -->
		</form>
	
	</div><!-- /container -->
		 <!-- jQuery Version 1.11.0 -->
 <script src="js/jquery-1.11.3.js"></script>
 <!-- Bootstrap Core JavaScript -->
 <script src="js/bootstrap.js"></script>
	</body>
</html>