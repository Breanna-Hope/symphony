<?php

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
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}



//sql select statement to retrieve diagnosis.
$sql = "SELECT description FROM vCrgvrPrtl_Medication WHERE mpi_id = '$mpi' AND (order_type = 'Standard Medication' OR order_type = 'Antibiotic/Anti-Infective' OR order_type = 'Anticoagulant' OR order_type = 'Psychotropic') ORDER BY		description ASC" ;
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		array_push($mdesc, $value);
	}
}	


//sql select statement to retrieve form.
$sql = "SELECT form FROM vCrgvrPrtl_Medication WHERE mpi_id = '$mpi' AND (order_type = 'Standard Medication' OR order_type = 'Antibiotic/Anti-Infective' OR order_type = 'Anticoagulant' OR order_type = 'Psychotropic') ORDER BY description ASC";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		array_push($mform, $value);
	}
}


?>