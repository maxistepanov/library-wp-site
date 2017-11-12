<?php 
function get_connection()
{
	$serverName = "DESKTOP-IJOBITJ\SQLEXPRESS"; 
	$connectionInfo = array( "Database"=>"library", "CharacterSet" => "UTF-8");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

	
// $serverName = "10.2.81.252";
// $connectionInfo = array( "Database"=>"library",'UID'=>'Chitatel', 'PWD'=>'katalog', "CharacterSet" => "UTF-8");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);
	
	return $conn;
}

 ?>