<?php
$Dictionary = 0;
$Language = "";
function Translate($KeyWord)
{	global $Language, $Dictionary;
	if( $Language == "ukr" )
		return array_key_exists($KeyWord, $Dictionary ) ? $Dictionary[$KeyWord][0] : ""; 
	else if( $Language == "rus" )
		return array_key_exists($KeyWord, $Dictionary ) ? $Dictionary[$KeyWord][1] : ""; 
	else if( $Language == "eng" )
		return array_key_exists($KeyWord, $Dictionary ) ? $Dictionary[$KeyWord][2] : ""; 
	return "";
}

function SelectWord( $Language, $Ukr, $Rus, $Eng)
{	global $Language;
	if ($Language == "ukr") $SelectWord = $Ukr;
	elseif ($Language == "rus" ) $SelectWord = $Rus;
	elseif ($Language == "eng" ) $SelectWord = $Eng;
	else    $SelectWord == "";
	return $SelectWord;
}

?>
