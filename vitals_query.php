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

//sql select statement to retrieve bp and date/time 
$sql = "SELECT X.value, X.dystolic_value, X.date FROM (SELECT  wv_std_vitals.description, wv_vitals.value, wv_vitals.dystolic_value, wv_vitals.date, ROW_NUMBER() OVER (PARTITION BY wv_std_vitals.description ORDER BY wv_vitals.date DESC) AS rank FROM wv_std_vitals INNER JOIN wv_vitals ON wv_std_vitals.std_vitals_id = wv_vitals.std_vitals_id  INNER JOIN clients ON wv_vitals.client_id = clients.client_id WHERE clients.mpi_id = '$mpi' AND	wv_std_vitals.description = 'BP - Systolic') X WHERE X.rank = 1 ;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
   // echo $row['value'];
	$rbps = print_r( $row['value'], true);
	$rbpd = print_r($row['dystolic_value'], true);
	//echo $row['dystolic_value'];
	$rbp_date = print_r($row['date']-> format('m/d/Y h:i A'), true); 

	}
 	
sqlsrv_free_stmt( $stmt);


//sql select statement to retrieve temperature
$sql = "SELECT X.Temp, X.date FROM (SELECT  wv_std_vitals.description, wv_vitals.value AS Temp, wv_vitals.dystolic_value, wv_vitals.date, ROW_NUMBER() OVER (PARTITION BY wv_std_vitals.description ORDER BY wv_vitals.date DESC) AS rank FROM wv_std_vitals INNER JOIN wv_vitals ON wv_std_vitals.std_vitals_id = wv_vitals.std_vitals_id  INNER JOIN clients ON wv_vitals.client_id = clients.client_id WHERE clients.mpi_id = '$mpi' AND wv_std_vitals.description = 'Temperature') X WHERE X.rank = 1;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //echo $row['Temp'];
	$rtemp = print_r( $row['Temp'], true);
	$rtemp_date = print_r($row['date']-> format('m/d/Y h:i A'), true); 
}
	
sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve pulse
$sql = "SELECT X.value, X.date FROM (SELECT  wv_std_vitals.description, wv_vitals.value, wv_vitals.dystolic_value, wv_vitals.date, ROW_NUMBER() OVER (PARTITION BY wv_std_vitals.description ORDER BY wv_vitals.date DESC) AS rank FROM wv_std_vitals INNER JOIN wv_vitals ON wv_std_vitals.std_vitals_id = wv_vitals.std_vitals_id  INNER JOIN clients ON wv_vitals.client_id = clients.client_id WHERE clients.mpi_id = '$mpi' AND wv_std_vitals.description = 'Pulse') X WHERE X.rank = 1;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //echo $row['value'];
	$rpulse = print_r( $row['value'], true);
	$rpulse_date = print_r($row['date']-> format('m/d/Y h:i A'), true); 
}
sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve 02
$sql = "SELECT X.value, X.date FROM (SELECT  wv_std_vitals.description, wv_vitals.value, wv_vitals.dystolic_value, wv_vitals.date, ROW_NUMBER() OVER (PARTITION BY wv_std_vitals.description ORDER BY wv_vitals.date DESC) AS rank FROM wv_std_vitals INNER JOIN wv_vitals ON wv_std_vitals.std_vitals_id = wv_vitals.std_vitals_id  INNER JOIN clients ON wv_vitals.client_id = clients.client_id WHERE clients.mpi_id = '$mpi' AND wv_std_vitals.description = 'O2 sats') X WHERE X.rank = 1;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //echo $row['value'];
	$r02 = print_r( $row['value'], true);
	$r02_date = print_r($row['date']-> format('m/d/Y h:i A'), true); 
}
sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve respiration
$sql = "SELECT        X.value, X.date FROM            (SELECT  wv_std_vitals.description, wv_vitals.value, wv_vitals.dystolic_value, wv_vitals.date,                ROW_NUMBER() OVER (PARTITION BY wv_std_vitals.description ORDER BY wv_vitals.date DESC) AS rank           FROM wv_std_vitals INNER JOIN                          wv_vitals ON wv_std_vitals.std_vitals_id = wv_vitals.std_vitals_id  INNER JOIN                          clients ON wv_vitals.client_id = clients.client_id 						 WHERE           clients.mpi_id = '$mpi' AND	wv_std_vitals.description = 'Respiration') X WHERE X.rank = 1;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //echo $row['value'];
	$rresp = print_r( $row['value'], true);
	$rresp_date = print_r($row['date']-> format('m/d/Y h:i A'), true); 
}	
sqlsrv_free_stmt( $stmt);

//sql select statement to retrieve respiration
$sql = "SELECT        X.value, X.date FROM            (SELECT  wv_std_vitals.description, wv_vitals.value, wv_vitals.dystolic_value, wv_vitals.date,                ROW_NUMBER() OVER (PARTITION BY wv_std_vitals.description ORDER BY wv_vitals.date DESC) AS rank           FROM wv_std_vitals INNER JOIN                          wv_vitals ON wv_std_vitals.std_vitals_id = wv_vitals.std_vitals_id  INNER JOIN                          clients ON wv_vitals.client_id = clients.client_id 						 WHERE           clients.mpi_id = '$mpi' AND	wv_std_vitals.description = 'Blood Sugar') X WHERE X.rank = 1;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //echo $row['value'];
	$rbs = print_r( $row['value'], true);
	$rbs_date = print_r($row['date']-> format('m/d/Y h:i A'), true); 
}	
sqlsrv_free_stmt( $stmt);


?>