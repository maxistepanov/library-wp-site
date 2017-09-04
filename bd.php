<?php
/*
//
//Работает только под MsSql.
//пиар не нужен.
//
// ДОбавленные фичи:
// поиск по наличию эл. копии
// скачка эл. копии
// поиск "мистить текст" по названию
// страница описания документа переведена на рус.
// отображение номера периоодики
// --исправлено:
//   переход страниц из описания
//
*/
/*--------------------------------*/
/*$dbName =		'library';//имя базы
$host =	    	'MAXINOTE\SQLEXPRESS';
//$host =	    	'10.2.81.252';a
$UserName =		'Chitatel';
$UserPassword =	'katalog';*/
/*--------------------------------*/

/*-------------------------------------------------------------------------*/
//mssql_connect ( [string servername [, string username [, string password]]])
/*function DBSelectExpression($key){$key = strtolower($key);return $key;}

// Connect to MSSQL
$link = mssql_connect($host, $UserName, $UserPassword);

if (!$link) {
    die('Something went wrong while connecting to MSSQL');
    echo "string";
}*/
/*echo phpinfo();*/


$serverName = "10.2.81.252"; 
$connectionInfo = array( "Database"=>"library");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
$id = 14300;
$name = "Евсеев Александр Сергеевич";
$name_true = iconv('UTF-8', 'Windows-1251', $name);
  $sql = "SELECT code , name FROM physical_person  where code = " . $id . " and name = '". $name_true . "'";

$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

$row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
 if (!is_null($row)){
 		echo "okay";
 	}
 else echo "no okay";
 echo phpinfo();
     








?>
