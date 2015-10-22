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



//sql select statement to retrieve progress note
$sql = "SELECT        view_ods_progress_note.NoteText FROM            view_ods_progress_note INNER JOIN                          clients ON view_ods_progress_note.PatientID = clients.client_id WHERE        (clients.mpi_id = '$mpi') AND view_ods_progress_note.EffectiveDate >= DATEADD(month, -1, getdate()) ORDER BY	view_ods_progress_note.EffectiveDate DESC";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		array_push($prog_note, $value);
	}
}

//sql select statement to retrieve progress note
$sql = "SELECT        view_ods_progress_note.EffectiveDAte FROM            view_ods_progress_note INNER JOIN                          clients ON view_ods_progress_note.PatientID = clients.client_id WHERE        (clients.mpi_id = '$mpi') AND view_ods_progress_note.EffectiveDate >= DATEADD(month, -1, getdate()) ORDER BY	view_ods_progress_note.EffectiveDate DESC";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	foreach($row as $value){
		array_push($prog_date, $value -> format('m/d/Y'));
	}
}
/*	
$sql = "SELECT        view_ods_progress_note.EffectiveDate FROM            view_ods_progress_note INNER JOIN                          clients ON view_ods_progress_note.PatientID = clients.client_id WHERE        (clients.mpi_id = '$mpi') AND view_ods_progress_note.EffectiveDate >= DATEADD(month, -1, getdate()) ORDER BY	view_ods_progress_note.EffectiveDate DESC";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		array_push($prog_date, $row -> format('m/d/Y'));
}
/*		
$sql = "SELECT pn_progress_note.description, pn_text.created_date FROM clients INNER JOIN pn_progress_note ON clients.client_id = pn_progress_note.client_id INNER JOIN pn_text ON pn_text.pn_id = pn_progress_note.pn_id WHERE (pn_text.deleted = 'N') AND (clients.mpi_id = '$mpi') AND pn_text.created_date >= DATEADD(month, -1, getdate()) ORDER BY pn_text.created_date DESC; ORDER BY pn_text.created_date DESC;";
$stmt= sqlsrv_query( $conn, $sql);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	array_push($prog_type, $row);
}	
sqlsrv_free_stmt( $stmt);

*/
?>