<?php 
function get_connection()
{
	//local
	// $serverName = "DESKTOP-IJOBITJ\SQLEXPRESS"; 
	// $connectionInfo = array( "Database"=>"library", "CharacterSet" => "UTF-8");
	

//rds
// $serverName = "library.ch5bf5k9ozoc.us-east-2.rds.amazonaws.com";
// $connectionInfo = array( "Database"=>"library",'UID'=>'maxi', 'PWD'=>'novatel720', "CharacterSet" => "UTF-8");
	
	// live
 $serverName = "10.2.81.252";
 $connectionInfo = array( "Database"=>"library",'UID'=>'Chitatel', 'PWD'=>'katalog', "CharacterSet" => "UTF-8");

	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	return $conn;
}

 ?>
