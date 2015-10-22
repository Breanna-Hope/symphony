<?php

session_start(); // Starting Session

$error=''; // Variable To Store Error Message



	if (empty($_POST['scp_firstname']) || empty($_POST['scp_lastname']) || empty($_POST['scp_pin']))
	{
		$error = "Name or Pin is invalid";
	}
	else
	{
		
		//Define $username and $password
		$firstname=strtoupper($_POST['scp_firstname']);
		$lastname=strtoupper($_POST['scp_lastname']);
		$pin=$_POST['scp_pin'];
		$_SESSION['cfname']=$firstname;
		$_SESSION['clname']=$lastname;
		$_SESSION['cpin']=$pin;
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$serverName = "localhost";
		$connectionInfo = array( "Database"=>"xxx", "UID"=>"xxx", "PWD"=>"xxx");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);

		if( $conn ) 
		{
			echo "Connection established.<br />";
		}
		else
		{
			echo "Connection could not be established.<br />";
			die( print_r( sqlsrv_errors(), true));
		}

		$sql = "SELECT MasterPatientID FROM vCrgvrPrtl_User	WHERE vCrgvrPrtl_User.CaregiverPin = '$pin' AND UPPER(vCrgvrPrtl_User.FirstName) = '$firstname' AND UPPER(vCrgvrPrtl_User.LastName) ='$lastname';";

		$stmt = sqlsrv_query( $conn, $sql);
		if( $stmt === false ) 
		{
			die( print_r( sqlsrv_errors(), true));
		}
		else if( sqlsrv_has_rows($stmt) != 1 )
		{
			header("location: logerror.php"); // Redirecting To Invalid pin Page
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
				header("location: portal.php"); // Redirecting To Other Page
				
			}
		}
		
		
		
	}

?>