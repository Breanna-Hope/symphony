<?php
//sql select statement to retrieve contact phone and identify type.
//Establishing Connection with Server by passing server_name, user_id and password as a parameter
$serverName = "localhost";
$connectionInfo = array( "Database"=>"xxx", "UID"=>"xxx", "PWD"=>"xxx");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) 
{
    //echo "Connection established.<br />";
}
else
{
    // echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}
//sql select statement to retrieve contact type(s).
$sql = "SELECT DISTINCT pc.ContactTypeDesc FROM view_ods_patient_contact pc INNER JOIN vCrgvrPrtl_User ON pc.PatientContactID=vCrgvrPrtl_User.CaregiverPin WHERE vCrgvrPrtl_User.CaregiverPin = '$cpin' AND UPPER(vCrgvrPrtl_User.FirstName) = UPPER('$cfname') AND UPPER(vCrgvrPrtl_User.LastName) = UPPER('$clname');";
$stmt= sqlsrv_query( $conn, $sql);

if( $stmt === false)
{
    echo "Error in query preparation/execution.\n";
    die( print_r( sqlsrv_errors(), true));
}
//fetches each row returned from the query
while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
{
	$i=0;
	//iterates through the returned array to identify which values are not null; places them in a new array with type identified.
	while (list($key, $value) = each($row)) 
	{
		
		if(!empty($value)) 
		{
			
			$ctype[] = print_r( $value."<br />" , true);	
		}
		$i++;
	}
}
sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve relation description.
$sql = "SELECT DISTINCT pc.RelationshipDesc FROM view_ods_patient_contact pc INNER JOIN vCrgvrPrtl_User ON pc.PatientContactID=vCrgvrPrtl_User.CaregiverPin WHERE vCrgvrPrtl_User.CaregiverPin = '$cpin' AND UPPER(vCrgvrPrtl_User.FirstName) = UPPER('$cfname') AND UPPER(vCrgvrPrtl_User.LastName) = UPPER('$clname');";
$stmt= sqlsrv_query( $conn, $sql);

if( $stmt === false)
{
    echo "Error in query preparation/execution.\n";
    die( print_r( sqlsrv_errors(), true));
}
//fetches each row returned from the query
while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
{
	$i=0;
	//iterates through the returned array to identify which values are not null; places them in a new array with type identified.
	while (list($key, $value) = each($row)) 
	{
		
		if(!empty($value)) 
		{
			
			$crelation[] = print_r( $value , true);	
		}
		$i++;
	}
}
sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve contact phone and identify type.
$sql = "SELECT c.phone_cell, c.phone_home, c.phone_office, c.phone_office_ext, c.phone_other, c.phone_pager, c.fax FROM contact AS c INNER JOIN contact_relationship AS cr ON c.contact_id = cr.contact_id WHERE cr.reference_id = '$mpi' AND c.contact_id= '$cpin';";
$stmt= sqlsrv_query( $conn, $sql);

if( $stmt === false)
{
    echo "Error in query preparation/execution.\n";
    die( print_r( sqlsrv_errors(), true));
}
//fetches each row returned from the query
while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
{
	$phone = array("Cell: ","Home: ","Office: ","Office Ext.: ","Other: ","Pager: ","Fax: ");
	$i=0;
	//iterates through the returned array to identify which values are not null; places them in a new array with type identified.
	while (list($key, $value) = each($row)) 
	{
		
		if(!empty($value)) 
		{
			//echo "phone!";
			$cphone[] = print_r( "$phone[$i] ".$value."<br />", true);	
		}
		$i++;
	}
}
sqlsrv_free_stmt( $stmt);


//sql select statement to retrieve resident information.
$sql = "SELECT vCrgvrPrtl_Resident.FirstName, vCrgvrPrtl_Resident.LastName, vCrgvrPrtl_Resident.DOB, vCrgvrPrtl_Resident.Gender, vCrgvrPrtl_Resident.ProviderFirstName, vCrgvrPrtl_Resident.ProviderLastName, vCrgvrPrtl_Resident.Room FROM vCrgvrPrtl_Resident INNER JOIN vCrgvrPrtl_User ON vCrgvrPrtl_Resident.ResidentID = vCrgvrPrtl_User.MasterPatientID WHERE vCrgvrPrtl_User.CaregiverPin = '$cpin' AND UPPER(vCrgvrPrtl_User.FirstName) = UPPER('$cfname') AND UPPER(vCrgvrPrtl_User.LastName) = UPPER('$clname');";
$stmt= sqlsrv_query( $conn, $sql);

if( $stmt === false)
{
    echo "Error in query preparation/execution.\n";
    die( print_r( sqlsrv_errors(), true));
}
if( sqlsrv_fetch( $stmt ) === false) {
	echo "failure",
     die( print_r( sqlsrv_errors(), true));
}

// Get the row fields. Field indeces start at 0 and must be retrieved in order.
// Retrieving row fields by name is not supported by sqlsrv_get_field.

	
	$rfname = ucfirst(strtolower(sqlsrv_get_field( $stmt, 0)));
	$rlname= ucfirst(strtolower(sqlsrv_get_field( $stmt, 1)));
	$rDOB = sqlsrv_get_field( $stmt, 2)->format('m/d/Y');
	$rGender = sqlsrv_get_field( $stmt, 3);
	$pfname = ucfirst(strtolower(sqlsrv_get_field( $stmt, 4)));
	$plname = ucfirst(strtolower(sqlsrv_get_field( $stmt, 5)));
	$rRoom = sqlsrv_get_field( $stmt, 6);


sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve allergies
$sql = "SELECT DISTINCT vCrgvrPrtl_Resident.Allergies FROM vCrgvrPrtl_Resident INNER JOIN vCrgvrPrtl_User ON vCrgvrPrtl_Resident.ResidentID = vCrgvrPrtl_User.MasterPatientID WHERE vCrgvrPrtl_User.CaregiverPin = '$cpin' AND UPPER(vCrgvrPrtl_User.FirstName) = UPPER('$cfname') AND UPPER(vCrgvrPrtl_User.LastName) = UPPER('$clname');";
$stmt= sqlsrv_query( $conn, $sql);

if( $stmt === false)
{
    echo "Error in query preparation/execution.\n";
    die( print_r( sqlsrv_errors(), true));
}
//fetches each row returned from the query
while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
{
	$i=0;
	//iterates through the returned array to identify which values are not null; places them in a new array with type identified.
	while (list($key, $value) = each($row)) 
	{
		if(!empty($value)) 
		{
			$rAllergies[] = print_r($value."<br />", true);	
		}
		$i++;
	}
}
sqlsrv_free_stmt( $stmt);
?>