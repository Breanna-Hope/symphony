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
$sql = "SELECT diagnosis_codes.icd9_full_desc FROM clients LEFT OUTER JOIN diagnosis ON clients.fac_id = diagnosis.fac_id AND clients.client_id = diagnosis.client_id INNER JOIN diagnosis_codes ON diagnosis.diagnosis_id = diagnosis_codes.diagnosis_id WHERE clients.mpi_id = '$mpi' AND clients.discharge_date IS NULL AND clients.admission_date IS NOT NULL ORDER BY diagnosis.onset_date DESC;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		//echo "inside loop! ";
		array_push($rdiagnosis, $value);
	}
}	
sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve diagnosis.
$sql = "SELECT diagnosis.onset_date FROM clients LEFT OUTER JOIN diagnosis ON clients.fac_id = diagnosis.fac_id AND clients.client_id = diagnosis.client_id INNER JOIN diagnosis_codes ON diagnosis.diagnosis_id = diagnosis_codes.diagnosis_id WHERE clients.mpi_id = '$mpi' AND clients.discharge_date IS NULL AND clients.admission_date IS NOT NULL ORDER BY		diagnosis.onset_date DESC;";
$stmt= sqlsrv_query( $conn, $sql);

//getting the dates and converting their format
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		//echo "inside loop! ";
		array_push($rdiagnosis_onset, $value -> format('m/d/Y'));
	}	
}
sqlsrv_free_stmt( $stmt);





?>