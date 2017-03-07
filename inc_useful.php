<?php
function FetchPostVar( &$PostVar, $KeyWord, $Default)
{
	$PostVar = array_key_exists($KeyWord, $_POST ) ? $_POST[$KeyWord] : $Default;
}

function FetchGetVar( &$GetVar, $KeyWord, $Default)
{
	$GetVar = array_key_exists($KeyWord, $_GET ) ? $_GET[$KeyWord] : $Default;
}

function FetchVar( &$Var, $KeyWord, $Default)
{
	if( array_key_exists($KeyWord, $_GET ) )
		$Var = $_GET[$KeyWord];
	else if( array_key_exists($KeyWord, $_POST ) )
		$Var = $_POST[$KeyWord];
	else
		$Var = $Default;
}
?>
