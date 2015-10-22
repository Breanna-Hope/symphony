<?php

session_start(); // Starting Session

$error=''; // Variable To Store Error Message



	if (empty($_POST['resid']))
	{
		echo "Resident ID Required </br>";
		?><a href="readmission.php">Please Try Again</a><?php
	}
	else if (empty($_POST['facility']))
	{
		echo "Facility Required </br>";
		?><a href="readmission.php">Please Try Again</a><?php
	}
	else
	{
		
		//Define $username and $password
		$facility=$_POST['facility'];
		$resid=$_POST['resid'];
		
		$_SESSION['facility']=$facility;
		$_SESSION['resid']=$resid;
		
		//echo $facility.' & '.$resid."</br>";
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$serverName = "localhost";
		$connectionInfo = array( "Database"=>"xxx", "UID"=>"xxx", "PWD"=>"xxx");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);

		if( $conn ) 
		{
			//echo "Connection established.<br />";
		}
		else
		{
			echo "Connection could not be established.<br />";
			die( print_r( sqlsrv_errors(), true));
		}

		$sql = "SELECT mpi_id FROM clients WHERE fac_id = '$facility' AND client_id = '$resid';";

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) 
		{
			die( print_r( sqlsrv_errors(), true));
		}
		else if( sqlsrv_has_rows($stmt) != 1 )
		{
			header("location: formerror.php"); // Redirecting To Invalid pin Page
		}
		else
		{
			// Make the first (and in this case, only) row of the result set available for reading.
			if( sqlsrv_fetch( $stmt ) === false) 
			{
				die( print_r( sqlsrv_errors(), true));
			}
			else
			{
				// Get the row fields. Field indeces start at 0 and must be retrieved in order.
				// Retrieving row fields by name is not supported by sqlsrv_get_field.
				$mpi = sqlsrv_get_field( $stmt, 0);	
				
				$_SESSION['mpi']=$mpi;
				sqlsrv_free_stmt( $stmt);
				sqlsrv_close( $conn);
				header("location: fill.php"); // Redirecting To Other Page
				//echo $mpi;
			}
		}
		
		
		
	}

?>