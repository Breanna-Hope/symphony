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



//sql select statement to retrieve therapy description. OR order_type = 'Therapy Clarification' OR order_type = 'Therapy Modalities'
$sql = "SELECT description FROM vCrgvrPrtl_Medication WHERE mpi_id = '$mpi' AND (order_type = 'Therapy') ORDER BY		description ASC" ;
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		array_push($therapy, $value);
	}
}
sqlsrv_free_stmt( $stmt);
/*
$sql = "SELECT start_date FROM vCrgvrPrtl_Medication WHERE mpi_id = '$mpi' AND (order_type = 'Therapy' ) ORDER BY		description ASC" ;
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		array_push($therapy_sdate, $value);
	}
}

$sql = "SELECT end_date FROM vCrgvrPrtl_Medication WHERE mpi_id = '$mpi' AND (order_type = 'Therapy' ) ORDER BY		description ASC" ;
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		array_push($therapy_edate, $value);
	}
}
*/

$sql = "SELECT start_date FROM vCrgvrPrtl_Medication WHERE mpi_id = '$mpi' AND (order_type = 'Therapy') ORDER BY		description ASC" ;
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
   
	//$therapy = print_r( $row['description'], true);
	array_push($therapy_sdate, $row['start_date'] -> format('m/d/Y'));

}
sqlsrv_free_stmt($stmt);

?>