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
$dbName =		'library';//имя базы
$host =	    	'MAXINOTE\SQLEXPRESS';
//$host =	    	'10.2.81.252';a
$UserName =		'Chitatel';
$UserPassword =	'katalog';
/*--------------------------------*/

/*-------------------------------------------------------------------------*/
//mssql_connect ( [string servername [, string username [, string password]]])
function DBSelectExpression($key){$key = strtolower($key);return $key;}

// Connect to MSSQL
$link = mssql_connect($host, $UserName, $UserPassword);

if (!$link) {
    die('Something went wrong while connecting to MSSQL');
    echo "string";
}
?>
