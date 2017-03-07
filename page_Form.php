<meta charset="cp-1251">
<?php
//include 'inc_DB_Connection.php';
include 'inc_Dictionary.php'; 

$Mode = 'form';

InitDictionary();
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
FetchVar( $Language, 'lang', 'ukr' ); 
if ($Language != "rus" AND $Language != "eng") 
	$Language = "ukr";

FetchVar( $Extended, 'ext', 'no' ); 
if ($Extended != "yes")
	$Extended = "no";

//FetchVar( $Dis,     'dis',     '0' );
//FetchVar( $DisCond,     'dis_cond',     '0');
FetchVar( $DisList,		  'discipline',   '0');
FetchVar( $ThemePath,     'theme_path',     '0' );
FetchVar( $AuthorFld,     'author_fld',     '');
FetchVar( $DocNameFld,    'docname_fld',    '');
FetchVar( $DocNameCond,   'docname_cond',   '1');
FetchVar( $PublYearFld1,  'year_fld1',      '');
FetchVar( $PublYearFld2,  'year_fld2',      '');
FetchVar( $UDC_Fld,       'udc_fld',        '');
FetchVar( $ISBN_Fld,      'isbn_fld',       '');
FetchVar( $LangList,      'lang_list',      '0');
FetchVar( $DocTypeList,   'doctype_list',   '0');
FetchVar( $PresenceList,  'presence_list',  '0');
FetchVar( $PublPlaceFld,  'pubplace_fld',   '');
FetchVar( $PublisherFld,  'publisher_fld',  '');
FetchVar( $BBC_Fld,       'bbc_fld',        '');
FetchVar( $ISSN_Fld,      'issn_fld',       '');
FetchVar( $AnnotationFld, 'annotation_fld', '');
FetchVar( $ThemeCond,     'theme_cond',     'all_theme');
FetchVar( $ElCopy,        'el_copy',        '');

$LangListArray     = explode(",", $LangList);
$DocTypeListArray  = explode(",", $DocTypeList);
$PresenceListArray = explode(",", $PresenceList);
$DisListArray  = explode(",", $DisList);




//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
$serverName = "MAXINOTE\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"library");
$db1= sqlsrv_connect( $serverName, $connectionInfo);
 if(!$db1){ die ("No connect to base"); };

echo "

<!-- ******************** USH/Library BODY *************************** -->

<input name='mode'       type='hidden' value='$Mode'>
<input name='ext'        type='hidden' value='$Extended'>
<input name='lang'       type='hidden' value='$Language'>
<input name='theme_path' type='hidden' value='$ThemePath'>

<table width=100% border=0><tr>
<td>&nbsp;
<input style='font-size:9pt' type='submit' value='" .Translate('Select'). "' onClick='form_main.mode.value=\"BookList\";'>&nbsp;
<input style='font-size:9pt' type='reset'  value='" .Translate('Clear').  "'><br>\n
</td>
<td align=right><a href='page_lib.php' onClick='form_main.mode.value=\"SearchHelp\";form_main.submit();return false'>".Translate("Help")."</a></td>
</tr></table>
<table border='0'><tr>

<!-- ************************************
Query fields 
************************************ -->

<td valign='top'>
<table border=0>
";

for( $i=0; $i < count( $SearchDocFormFields ); $i++ )
{	
	if( ($Extended == 'no'  and $SearchDocFormFields[$i][1] == 1) or 
		($Extended == 'yes' and $SearchDocFormFields[$i][2] == 1) )
	{
		echo "<tr valign = 'top'>\n";
		if( $SearchDocFormFields[$i][0] == 'Author' )
		{
			echo "	<td>" . Translate("Author") . "</td>\n";
			echo "	<td width=250><INPUT name='author_fld' size=35 maxlength=250 style='font-size:9pt' value='$AuthorFld'></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'DocName' )
		{
			echo "	<td>" . Translate("DocName") . "<br>\n";
			echo "	&nbsp;&nbsp;&nbsp;&nbsp;<SELECT name='docname_cond' size=1 style='font-size:9pt'>\n";
            echo "		<OPTION value='containtext'";
			if( $DocNameCond == "containtext" ) echo " selected";
			echo ">" . Translate("ContainsText"). "</OPTION>\n";

            echo "		<OPTION value='containword' ";
            if( $DocNameCond == "containword" || $DocNameCond =='1') echo "selected";
			echo ">" . Translate("ContainsWords"). "</OPTION>\n";

            echo "		<OPTION value='start'";
			if( $DocNameCond == "start" ) echo " selected";
			echo ">" . Translate("StartFrom"). "</OPTION>\n";
			echo "	</SELECT></td>\n";

			echo "	<td width=250><INPUT name='docname_fld' size=35 maxlength=250 style='font-size:9pt' value='$DocNameFld'></td>\n";

		}
		else if( $SearchDocFormFields[$i][0] == 'PublYear' )
		{
			echo "	<td>" . Translate("PublYear") . "</td>\n";
			echo "	<td valign='center'>\n";
			echo "	<INPUT name='year_fld1' size=5 maxlength=5 style='font-size:9pt' value='$PublYearFld1'>&nbsp;--&nbsp;\n";
			echo "	<INPUT name='year_fld2' size=5 maxlength=5 style='font-size:9pt' value='$PublYearFld2'></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'UDC' )
		{
			echo "	<td>" . Translate("UDC") . "</td>\n";
			echo "	<td><INPUT name='udc_fld' size=35 maxlength=250 style='font-size:9pt' value='$UDC_Fld'></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'ISBN' )
		{
			echo "	<td>ISBN</td>\n";
			echo "	<td><INPUT name='isbn_fld' size=35 maxlength=250 style='font-size:9pt' value='$ISBN_Fld'></td>\n";
		}
        else if( $SearchDocFormFields[$i][0] == 'ElCopy' )
		{
			echo "	<td>". SelectWord($Language, "Електронна копія", "Электронная копия", "Electronic copy") ."</td>\n";
			echo "	<td><INPUT name='el_copy'  type=\"CHECKBOX\"></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'Language' )
		{
			echo "	<td>" . Translate("Lang") . "</td>\n";
			echo "	<td colspan=2>\n";
			
			echo "	<SELECT name='lang_list' size=5 style='font-size:9pt'>\n"; // multiple: doesn't work in php???
			echo "		<OPTION value='0'";
			for( $j=0; $j < count($LangListArray); $j++ )
				if( '0' == $LangListArray[$j] )
					echo " selected";
			//if( array_search( '0', $LangListArray ) !== FALSE )
			//	echo " selected";
			echo ">" . Translate("NoRestrict"). "</OPTION>\n";
			$Result =sqlsrv_query("select kod, name from languages where kod > 0 and ( stat is null or stat <> 'E' ) and used = 1 order by name",$db1 );
			while ($row = sqlsrv_fetch_array($Result))
			{ 
				echo "		<OPTION value='". $row[0] . "'";
				for( $j=0; $j < count($LangListArray); $j++ )
					if( $row[0] == $LangListArray[$j] )
						echo " selected";
	
				//if( array_search( $row[0], $LangListArray ) !== FALSE )
				//	echo " selected";
				echo ">". $row[1]. "</OPTION>\n";
			}
			sqlsrv_free_result($Result);
			echo "	</SELECT>\n";
			echo "	</td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'DocType' )
		{
			echo "	<td>" . Translate("DocType") . "</td>\n";
			echo "	<td colspan=2>\n";
			echo "	<SELECT name='doctype_list' size=5 style='font-size:9pt'>\n"; // multiple: doesn't work in php
			echo "		<OPTION value='0'";
			for( $j=0; $j < count($DocTypeListArray); $j++ )
				if( '0' == $DocTypeListArray[$j] )
					echo " selected";
			//if( array_search( '0', $DocTypeListArray ) !== FALSE )
			//	echo " selected";
			echo ">" . Translate("NoRestrict"). "</OPTION>\n";
			$Result = sqlsrv_query("select code, name from doctype order by norder",$db1 );
			while ($row = sqlsrv_fetch_array($Result))
			{
				echo "		<OPTION value='". $row[0] . "'";
				for( $j=0; $j < count($DocTypeListArray); $j++ )
					if( $row[0] == $DocTypeListArray[$j] )
						echo " selected";
				//if( array_search( $row[0], $DocTypeListArray ) !== FALSE )
				//	echo " selected";
				echo ">" . $row[1]. "</OPTION>\n";
			}
			sqlsrv_free_result($Result);
			echo "	</SELECT>\n";
			echo "	</td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'Presence' )
		{
			echo "	<td>" . Translate("Presence") . "</td>\n";
			echo "	<td colspan=2>\n";
			echo "	<SELECT name='presence_list' size=5 style='font-size:9pt'>\n"; // multiple: doesn't work in php
			echo "		<OPTION value='0'";
			for( $j=0; $j < count($PresenceListArray); $j++ )
				if( '0' == $PresenceListArray[$j] )
					echo " selected";
			//if( array_search( '0', $PresenceListArray ) !== FALSE )
			//	echo " selected";
			echo ">" . Translate("NoRestrict"). "</OPTION>\n";
			$Result = sqlsrv_query("select code, name from juridical_person order by name" ,$db1);
			while ($row = sqlsrv_fetch_array($Result))
			{
				echo "		<OPTION value='". $row[0] . "'";
				for( $j=0; $j < count($PresenceListArray); $j++ )
					if( $row[0] == $PresenceListArray[$j] )
						echo " selected";
				//if( array_search( $row[0], $PresenceListArray ) !== FALSE )
				//	echo " selected";
				echo ">" . $row[1]. "</OPTION>\n";
			}
			sqlsrv_free_result($Result);
			echo "	</SELECT>\n";
			echo "	</td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'PublPlace' )
		{
			echo "	<td>" . Translate("PublPlace") . "</td>\n";
			echo "	<td><INPUT name='pubplace_fld' size=35 maxlength=250 style='font-size:9pt' value='$PublPlaceFld'></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'Publisher' )
		{
			echo "	<td>" .Translate("Publisher"). "</td>\n";
			echo "	<td><INPUT name='publisher_fld' size=35 maxlength=250 style='font-size:9pt' value='$PublisherFld'></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'BBC' )
		{
			echo "	<td>" .Translate("BBC"). "</td>\n";
			echo "	<td><INPUT name='bbc_fld' size=35 maxlength=250 style='font-size:9pt' value='$BBC_Fld'></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'ISSN' )
		{
			echo "	<td>ISSN</td>\n";
			echo "	<td><INPUT name='issn_fld' size=35 maxlength=250 style='font-size:9pt' value='$ISSN_Fld'></td>\n";
		}
		else if( $SearchDocFormFields[$i][0] == 'Annotation' )
		{
			echo "	<td>".Translate("Annotation")."</td>\n";
			echo "	<td width=250><INPUT name='annotation_fld' size=35 maxlength=250 style='font-size:9pt' value='$AnnotationFld'></td>\n";
		}
		echo "</tr>\n";
	}
}
echo "</table>\n";

/*echo "<font size=-1>";
if ( $Extended == "no" )
	echo "<a href='page_lib.php' onClick='form_main.ext.value=\"yes\";form_main.mode.value=\"form\";form_main.submit();return false'>".Translate("LongFldList").'</a>';
else
	echo "<a href='page_lib.php' onClick='form_main.ext.value=\"no\";form_main.mode.value=\"form\";form_main.submit();return false'>".Translate("ShortFldList").'</a>';
echo "</font>\n";*/
?>
</td>

<?php

/*
if ($ThemePath == "0")
{
    $Result = odbc_exec($ODBC_Id, "select count(*) from dbo.master_cards where group_kod in ( " .$UserGroupList . " ) ");
    odbc_fetch_row($Result);
	if( odbc_result($Result, 1) == 0 )
        $bUseThemeCondition = 0;
}
*/


if ($bUseThemeCondition)
{	
	echo "<!-- ************************************\n";
	echo "Theme search \n";
	echo "************************************ -->\n\n";
	
	echo "<td valign='top'>\n\n";
	echo "<p><font size=-1>".Translate("ThemeSearch")."</font><br>\n";
	echo "<INPUT name='theme_context' size=30 maxlength=100 style='font-size:9pt'>\n";
	echo "<input type='submit' value='".Translate("Search")."' style='font-size:9pt' onClick='form_main.mode.value=\"SearchThemeForm\";'>\n";
	echo "</p>\n\n";

	$UserGroupList = "-1";
	$Result = sqlsrv_query("select groupcode from usergroup where alias = '$UserName'", $db1);
	while ($row = sqlsrv_fetch_array($Result) )
		$UserGroupList .= ',' . $row[0];
	sqlsrv_free_result($Result);

	$ThemeList = explode(",", $ThemePath);
	$ThemeCount = count($ThemeList);
	$ColSpan = $ThemeCount + 1; 

	echo "<table border=0 style='font-size:9pt'>\n";
	if ($ThemeCount > 1)
		echo "<tr><td colspan='$ColSpan'><a href='page_lib.php' onClick='form_main.theme_path.value=\"0\";form_main.mode.value=\"form\";form_main.submit();return false'>".Translate('ThemeCatalogs')."</a></td></tr>\n";
	else
		echo "<tr><td colspan='$ColSpan'><font size=+1><b>".Translate('ThemeCatalogs')."</b></font></td></tr>\n";

	$ThemeRef = "0";
	$ThemeIdx = 1;
	while ($ThemeIdx < $ThemeCount)
	{
		$Result = sqlsrv_query("select name from cards where card_id = " . $ThemeList[ $ThemeIdx ],$db1 );
		$row = sqlsrv_fetch_array($Result);
		$ThemeName = $row[0];
   
		$ThemeRef .= "," . $ThemeList[ $ThemeIdx ];
		echo "<tr>";
		for( $i=0; $i < $ThemeIdx; $i++ )
			echo "<td width=15>&nbsp;</td>"; 
		if ($ThemeIdx < $ThemeCount - 1 ) // Not last theme code
			echo "<td colspan='$ColSpan'><a href='page_lib.php' onClick='form_main.theme_path.value=\"$ThemeRef\";form_main.mode.value=\"form\";form_main.submit();return false'>$ThemeName</a></td></tr>\n";
		else
		{   echo "\n<td  colspan='$ColSpan' valign='center'><font size=+1><b>$ThemeName</b></font><br>\n";
			echo "<SELECT name='theme_cond' size=1 style='font-size:9pt'>\n";
			echo "	<OPTION value='all_theme' ".( ($ThemeCond=='all_theme') ? "selected " : "" ).">".Translate('AllDocTheme')."</OPTION>\n";
			echo "	<OPTION value='all_tree' ".( ($ThemeCond=='all_tree') ? "selected " : "" ).">".Translate('AllDocSubTheme')."</OPTION>\n";
			echo "	<OPTION value='any' ".( ($ThemeCond=='any') ? "selected " : "" ).">".Translate('AllDoc')."</OPTION>\n";
			echo "</SELECT>\n";
			echo "</td></tr>\n";
		}
		$ThemeIdx++;
	}

	if ($ThemeCount == 1 )
	{
		$Sql = "select distinct C.card_id, C.name from cards C, master_cards MC where MC.master_id = C.card_id";
		if( $UserName != 'SYSADM' )
			$Sql .= " and MC.group_kod in ( $UserGroupList )";
		$Sql .= " order by name";
	} 
	else
		$Sql = 
			"select C.card_id, C.name from cards C, ref_card R where C.card_id = R.card_ref and R.card_id =". 
			$ThemeList[ $ThemeIdx - 1 ] . " order by C.name";

	$Result = sqlsrv_query($Sql,$db1);
	while ($row = sqlsrv_fetch_array($Result))
	{	$ThemeRef = $ThemePath . "," . $row[0];
		$ThemeName = $row[1];
		echo "<tr>";
		for( $i=0; $i < $ThemeCount; $i++ )
			echo "<td width=15>&nbsp;</td>";
		echo "<td><a href='page_lib.php' onClick='form_main.theme_path.value=\"$ThemeRef\";form_main.mode.value=\"form\";form_main.submit();return false'>$ThemeName</a></td>";

		echo "</tr>";
	}
	sqlsrv_free_result($Result);
	echo "</table>\n";


	if ($ThemePath == "0")
		echo "<INPUT type='hidden' name='theme_cond' value='all_theme'>\n";
	echo "
		<INPUT type='hidden' name='theme_id' value='".$ThemeList[ $ThemeCount-1 ] . "'>";

/*	echo "<table border=0 style='font-size:9pt'>\n";
//	$DisPath = 0;
	$DisList = explode(",", $Dis);
	$DisCount = count($DisList);
	$ColSpan = $DisCount + 1; 
	if ($DisCount > 1)
		echo "<tr><td colspan='$ColSpan'><a href='page_lib.php' onClick='form_main.dis.value=\"0\";form_main.mode.value=\"form\";form_main.submit();return false'>".Translate('Disciplines')."</a></td></tr>\n";
	else
		echo "<tr><td colspan='$ColSpan'><font size=+1><b>".Translate('Disciplines')."</b></font></td></tr>\n";

	$DisRef = "0";
	$DisIdx = 1;
	while ($DisIdx < $DisCount)
	{
		$Result = sqlsrv_query("select name from discipline where id = " . $DisList[ $DisIdx ],$db1 );
		$row = sqlsrv_fetch_array($Result);
		$DisName = $row[0];
		$DisRef .= "," . $DisList[ $DisIdx ];
		echo "<tr>";
		for( $i=0; $i < $DisIdx; $i++ )
			echo "<td width=15>&nbsp;</td>"; 
		{   echo "\n<td  colspan='$ColSpan' valign='center'><font size=+1><b>$DisName</b></font><br>\n";
			echo "</td></tr>\n";
		}
		$DisCond = '1';
		$DisIdx++;
	}

	if ($DisCount == 1 )
	{
		$Sql = "select d.id, d.name from discipline d";
		$Sql .= " order by name";
	} 
	else
		$Sql = 
			"select '-1', '' from discipline d where d.id =". 
			$DisList[ $DisIdx - 1 ] . " order by d.name";

	$Result = sqlsrv_query($Sql,$db1);
	while ($row = sqlsrv_fetch_array($Result))
	{	$DisRef = $Dis . "," . $row[0];
	    $DisName = $row[1];
		echo "<tr>";
		for( $i=0; $i < $DisCount; $i++ )
			echo "<td width=15>&nbsp;</td>"; 
		echo "<td><a href='page_lib.php' onClick='form_main.dis.value=\"$DisRef\";form_main.mode.value=\"form\";form_main.submit();return false'>$DisName</a></td>";
		echo "</tr>";
	}
	sqlsrv_free_result($Result);
	echo "</table>\n";*/
}
else
	echo "
		<INPUT type='hidden' name='theme_cond' value='any'>
		<INPUT type='hidden' name='theme_id' value='0'>";
?>
</td>

</tr></table>
<table width=640>
<?php
if ($bUseThemeCondition)
		{
		echo "<tr valign = 'top'>\n";
			echo "	<td colspan=3><font size=+1>" . Translate("Disciplines") . "</font><br>\n";
			echo "	<SELECT name='discipline' size=8 style='font-size:9pt'>\n"; // multiple: doesn't work in php
			echo "		<OPTION value='0'";
			for( $j=0; $j < count($DisListArray); $j++ )
				if( '0' == $DisListArray[$j] )
					echo " selected";
			//if( array_search( '0', $DisListArray ) !== FALSE )
			//	echo " selected";
			echo ">" . Translate("NoRestrict"). "</OPTION>\n";
			$Result = sqlsrv_query("select id, name from discipline order by name",$db1 );
			while ($row = sqlsrv_fetch_array($Result))
			{
				echo "		<OPTION value='". $row[0] . "'";
				for( $j=0; $j < count($DisListArray); $j++ )
					if( $row[0] == $DisListArray[$j] )
						echo " selected";
				//if( array_search( $row[0], $DisListArray ) !== FALSE )
				//	echo " selected";
				echo ">" . $row[1]. "</OPTION>\n";
			}
			sqlsrv_free_result($Result);
			echo "	</SELECT>\n";
			echo "	</td>\n";
		echo "</tr></table>\n";
		}
echo "<table width=640><tr><td>";
echo "<font size=-1>";
if ( $Extended == "no" )
	echo "<a href='page_lib.php' onClick='form_main.ext.value=\"yes\";form_main.mode.value=\"form\";form_main.submit();return false'>".Translate("LongFldList").'</a>';
else
	echo "<a href='page_lib.php' onClick='form_main.ext.value=\"no\";form_main.mode.value=\"form\";form_main.submit();return false'>".Translate("ShortFldList").'</a>';
echo "</font>\n";
echo "</td></tr>";
?>
</table>

<table width=640>
<tr><td>
	<?php echo Translate("PgDocCount"); ?>  
	<SELECT name="step">
	<OPTION value="10">10
	<OPTION value="20" SELECTED>20
	<OPTION value="30">30
	<OPTION value="40">40
	<OPTION value="50">50
	</SELECT>

<?php

$Result = sqlsrv_query("SELECT CONVERT(varchar, MAX(in_date), 104) FROM document WHERE (status IS NULL)",$db1);
$row = sqlsrv_fetch_array($Result);
$LastDate = $row[0];  
$Result = sqlsrv_query("select count(*) from document d, docxfield_value dxf where d.doc_id = dxf.doc_id and (status is null)",$db1);
$row = sqlsrv_fetch_array($Result);
$RowCount = $row[0];
/*--*/
 
echo "
&nbsp;<input style='font-size:9pt' type='submit' value='" .Translate('Select'). "' onClick='form_main.mode.value=\"BookList\";'>&nbsp;
<input style='font-size:9pt' type='reset' value='" .Translate('Clear'). "'><br><br>\n

";

$IP = $_SERVER['REMOTE_ADDR'];
	if(($IP=='10.2.0.197')||($IP=='10.2.0.221')||($IP=='10.2.0.80')){
		echo "<a href=page_lib.php  onClick='form_main.mode.value=\"page_zakaz_list\";form_main.submit();return false'>Замовлення літератури<br><br></a>";
	}

?>

<INPUT type="hidden" name="page" value="1">
</td></tr>
</table>

<!-- //******************** USH/Library BODY *************************** -->

<?php include 'inc_Footing.php'?>

<?php

sqlsrv_close($db1);

// -------------- Some useful functions ---------------------

function NavigationBar()
{	global $sMainPageURL;
	echo "<img src='../img/razd3.gif' width='6' height='10'> ";
	echo "<font size=-1><a href='$sMainPageURL'>". Translate("MainPage") ."</a> ";
	echo "<img src='../img/razd3.gif' width='6' height='10'> ";
	echo Translate("SearchEngine");
	echo "</font>"; 
}

function InitDictionary()
{	global $Dictionary;
	$Dictionary = array(
		'LitSearch'      => array('Пошук літератури','Поиск литературы','Search engine'),
		'SearchEngine'   => array('Електронний каталог','Электронный каталог','El. catalogue'),
		'Select'         => array('Вибрати','Выбрать','Search'),
		'Clear'          => array('Очистити','Очистить','Clear'),
		'ThemeSearch'    => array('Пошук теми','Поиск темы','Theme search'),
		'Search'         => array('Шукати','Искать','Search'),
		'ThemeCatalogs'  => array('Класифікатори','Классификаторы','Theme catalogues'),
		'Disciplines'  => array('Навчальні дисципліни','Учебные дисциплины','Normative courses'),
		'AllDocTheme'    => array('Всі документи теми','Все документы темы','All documents of theme'),
		'AllDocSubTheme' => array('Всі документи теми з підтемами','Все документы темы с подтемами','All documents of theme with subthemes'),
		'AllDoc'         => array('Без обмежень','Без ограничений','All documents'),
		'Author'         => array('Автор','Автор','Author'),
		'CaseSensitive'  => array('З урахуванням регістру','С учетом регистра','Case sensitive'),
		'DocName'        => array('Назва документа','Название документа','Document name'),
		'PublYear'       => array('Рік видання','Год издания','Year of publication'),
		'UDC'            => array('УДК','УДК','UDC'),
		'Lang'           => array('Мова','Язык','Language'),
		'DocType'        => array('Вид документа','Вид документа','Type of document'),
		'PublPlace'      => array('Місце видання','Место издания','Place of publication'),
		'Publisher'      => array('Видавництво','Издательство','Publisher'),
		'BBC'            => array('ББК','ББК','BBC'),
		'Presence'       => array('В наявності','В наличии','Is present'),
		'Annotation'     => array('Анотація','Аннотация','Annotation'),
		'ShortFldList'   => array('Скорочений перелік полів','Сокращенный перечень полей','Short field list'),
		'LongFldList'    => array('Розширений перелік полів','Расширенный перечень полей','Extended field list'),
		'PgDocCount'     => array('Кількість документів на сторінці','Количество документов на странице','Documents on page'),
		'MainPage'       => array('Головна сторінка','Главная страница','Main page'),
		'MainPageHTM'    => array('main.htm','mainrus.htm','maineng.htm'),
		'USH_Lib'        => array('Інформаційно-пошукова система<br>"УФД/Бібліотека"','Информационно-поисковая система<br>"УФД/Библиотека"','Information system<br>"USH/Library"'),
		'USH'            => array('Український Фондовий Дім','Украинский Фондовий Дом','Ukranian Stock House'),
		'NoRestrict'     => array('Без обмежень','Без ограничений','Without restrict'),
		'StartFrom'      => array('Починається з','Начинается с','Begin with'),
		'ContainsWords'  => array('Містить слова','Содержит слова','Contains words'),
		'ContainsText'  => array('Містить текст','Содержит текст','Contains text'),
		'Equal'          => array('Дорівнює','Равняется','Equal'),
		'NotEqual'       => array('Не дорівнює','Не равняется','Not equal'),
		'Greater'        => array('Більше','Больше','Greater'),
		'GreaterEqual'   => array('Більше або дорівнює','Больше или равняется','Greater or equal'),
		'Less'           => array('Меньше','Меньше','Less'),
		'LessEqual'      => array('Меньше або дорівнює','Меньше или равняется','Less or equal'),
		'Between'        => array('В діапазоні','В диапазоне','Between'),
		'NotBetween'     => array('Не в діапазоні','Не в диапазоне','Not between'),
		'Include'        => array('Включаючи','Включая','Include'),
		'LastUpdate'     => array('Останнє поновлення','Последнее обновление','Last update'),
		'DocCount'       => array('документів','документов','documents'),
		'Help'           => array('Допомога','Помощь','Help'),
		'Except'         => array('За винятком','За исключением','Not include')
	);
}
?>
