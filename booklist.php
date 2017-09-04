<?php


InitDictionary();

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
// var_dump ($DisList);
FetchVar( $PageNum,       'page',           '1' );
if ($PageNum < 1)$PageNum = 1;

FetchVar( $PageSize,      'step',            20);
?>



<?php
$serverName = "DESKTOP-IJOBITJ\SQLEXPRESS"; 
$connectionInfo = array( "Database"=>"library");
$db1 = sqlsrv_connect( $serverName, $connectionInfo);
$db2 = sqlsrv_connect( $serverName, $connectionInfo);

if( $db1 ) {
     echo "Connection established db1.<br />";
}else{
     echo "Connection could not be established db1.<br />";
     die( print_r( sqlsrv_errors(), true));
}
if( $db2 ) {
     echo "Connection established db2.<br />";
}else{
     echo "Connection could not be established. db1<br />";
     die( print_r( sqlsrv_errors(), true));
}
/*-------------------------------------------------------------------------*/
//mssql_connect ( [string servername [, string username [, string password]]])
function DBSelectExpression($key){$key = strtolower($key);return $key;}

/*$db1 = DB::connect($dsn);
if (DB::isError($db1)) {die ($db1->getMessage());}
$db2 = DB::connect($dsn);
if (DB::isError($db2)) {die ($db2->getMessage());}*/






// -----------------------------   Load DocTypeFld Info  ---------------------------
$DocTypeFld_Count = 0;
$Result = sqlsrv_query($db1,'select doctype_kod, col_kod from doctype_field');
while ($row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC))
{	$DocTypeFld_DocTypeCode[ $DocTypeFld_Count ] = $row[0];
	$DocTypeFld_ColCode[ $DocTypeFld_Count ] = $row[1];
	$DocTypeFld_Count++;
	echo $DocTypeFld_Count;
}


// -----------------------------   Load xField Info  ---------------------------

$xFldNameList = "";
$xFldCount = 0;
$xFldCurSelectColIdx = 0;

$Result = sqlsrv_query($db1,"select   kod, name, superfield, stype, marc_codetbl, allowtextedit, separator, area, nno, end_separator from docxfield_list order by norder" );

while( $row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC) )
{
//print_r ($row);
//////////////

    $xFldKod[$xFldCount]          = $row[DBSelectExpression('kod')];           if( is_null($xFldKod[$xFldCount]) )          $xFldKod[$xFldCount] = "";
	$xFldName[$xFldCount]         = $row[DBSelectExpression('name')];          if( is_null($xFldName[$xFldCount]) )         $xFldName[$xFldCount] = "";
	$xFldSuperField[$xFldCount]   = $row[DBSelectExpression('superfield')];    if( is_null($xFldSuperField[$xFldCount]) )   $xFldSuperField[$xFldCount] = "";
	$xFldMarcCodeTbl[$xFldCount]  = $row[DBSelectExpression('marc_codetbl')];  if( is_null($xFldMarcCodeTbl[$xFldCount]) )  $xFldMarcCodeTbl[$xFldCount] = "";
	$xFldAllowEdit[$xFldCount]    = $row[DBSelectExpression('allowtextedit')]; if( is_null($xFldAllowEdit[$xFldCount]) )    $xFldAllowEdit[$xFldCount] = "";
	$xFldSeparator[$xFldCount]    = $row[DBSelectExpression('separator')];     if( is_null($xFldSeparator[$xFldCount]) )    $xFldSeparator[$xFldCount] = "";
	$xFldEndSeparator[$xFldCount] = $row[DBSelectExpression('end_separator')]; if( is_null($xFldEndSeparator[$xFldCount]) ) $xFldEndSeparator[$xFldCount] = "";
	$xFldArea[$xFldCount]         = $row[DBSelectExpression('area')];          if( is_null($xFldArea[$xFldCount]) )         $xFldArea[$xFldCount] = "";
/*------------------------------------------------------*/


    if( $bNewDBStruct )
	{	$xFldDataType[$xFldCount] = $row[DBSelectExpression('stype')]; if( is_null($xFldDataType[$xFldCount]) ) $xFldDataType[$xFldCount] = "";
		$xFldNo[$xFldCount]       = $row[DBSelectExpression('nno')];   if( is_null($xFldNo[$xFldCount]) )       $xFldNo[$xFldCount] = "";
	}
	else
	{	$xFldDataType[$xFldCount] = $row[DBSelectExpression('type')];  if( is_null($xFldDataType[$xFldCount]) ) $xFldDataType[$xFldCount] = "";
		$xFldNo[$xFldCount]       = $row[DBSelectExpression('no')];    if( is_null($xFldNo[$xFldCount]) )       $xFldNo[$xFldCount] = "";
	}
	if ($xFldDataType[$xFldCount] != "GROUP")
	{	$xFldColName[$xFldCount] = $xFldKod[$xFldCount];
		if ($xFldKod[$xFldCount] < 100)
			$xFldColName[$xFldCount] = "0" . $xFldColName[$xFldCount];
		if ($xFldKod[$xFldCount] < 10)
			$xFldColName[$xFldCount] = "0" . $xFldColName[$xFldCount];
		$xFldColName[$xFldCount] = "col" . $xFldColName[$xFldCount];
		$xFldNameList .= ", " . $xFldColName[$xFldCount];

		$xFldSelectColIdx[$xFldCount] = $xFldCurSelectColIdx + 13;
		$xFldCurSelectColIdx++;
	}
	else
	{	$xFldColName[$xFldCount] = "";
		$xFldSelectColIdx[$xFldCount] = -1;
	}
	$xFldCount++;
}


for( $xFldIdx=0; $xFldIdx < $xFldCount; $xFldIdx++ )
	$xFldRealArea[ $xFldIdx ] = GetAreaCode( $xFldIdx );

// --------------------- Get book list ----------------------------
$sqlcount = "select count(*) from document d, docxfield_value dxf ";
$sql = "select d.doc_id, author, name, doc_type, publ_place, publisher, publ_year, sizem, isbn, issn, device_kod, cipher, long_filename, author_mark $xFldNameList from document d, docxfield_value dxf ";
$sqlcond = " where d.doc_id = dxf.doc_id and (status is null) ";

$CondCommentText = "";

if( ($ThemeCond == "all_theme" OR $ThemeCond == "all_tree") AND $ThemePath != "0" )
{
	$ThemeList = explode(",", $ThemePath);
	$ThemeId = $ThemeList[count($ThemeList)-1];
	//$ThemeName = db1->getOne("select name from cards where card_id = $ThemeId");
	$Result = sqlsrv_query( $db1,"select name from cards where card_id = $ThemeId");
	$row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
	$ThemeName = $row[0];
	if ($ThemeCond == "all_theme")
	{	$sqlcond .= " and exists ( select * from ref_doc where doc_id = d.doc_id and card_id = $ThemeId ) ";
		$CondCommentText .= SelectWord($Language, "Всі документи теми", "Все документы темы", "All documents of theme");
		$CondCommentText .= " \"$ThemeName\" "; /* "\ */
	}	
	if ($ThemeCond == "all_tree")
	{
		$CondCommentText .= SelectWord($Language, "Всі документи теми з підтемами", "Все документы темы с подтемами", "All documents of theme with subtheme");
		$CondCommentText .= " \"$ThemeName\" "; /* "\ */
		$NotTestedTheme = $ThemeId;
		$TestedTheme = "";
		while ($NotTestedTheme != "")
		{	$sqltheme = "select distinct card_ref from ref_card where card_id in ( $NotTestedTheme ) ";
			if( $TestedTheme != "")
				$sqltheme .= "and card_ref not in ( $TestedTheme ) ";
			if( $NotTestedTheme != "")
				$sqltheme .= "and card_ref not in ( $NotTestedTheme ) ";
			if( $TestedTheme != "")
				$TestedTheme .= ",";
			$TestedTheme .= $NotTestedTheme;
			$NotTestedTheme = "";
			$Result = sqlsrv_query($db1,$sqltheme);
			while($row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC))
			{	if ( $NotTestedTheme != "")
					$NotTestedTheme .= ",";
				$NotTestedTheme .= $row[0];
			}
			
		}
		$sqlcond .= " and exists ( select * from ref_doc where doc_id = d.doc_id and card_id in ( $TestedTheme ) ) ";
	}
}

//if( $Dis != "0" )
//{
//	$DisList = explode(",", $Dis);
//	$DisId = $DisList[count($DisList)-1];
//	//$ThemeName = db1->getOne("select name from cards where card_id = $ThemeId");
//	$Result = sqlsrv_query("select name from discipline where id = $DisId",$db1 );
//	$row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
//	$DisName = $row[0];
//	$sqlcond .= " and exists ( select * from doc_dscp where doc_id = d.doc_id and dscp_id = $DisId ) ";
//		$CondCommentText .= SelectWord($Language, "Всі документи навчальної дисципліни", "Все документы учебной дисциплины", "All documents of course");
//		$CondCommentText .= " \"$DisName\" "; /* "\ */
//}

AddConditionStr( "author", SelectWord($Language, "Автор", "Автор", "Author" ), 'containword', $AuthorFld , $sqlcond, $CondCommentText );

AddConditionStr( "name", SelectWord($Language, "Назва документа", "Название документа", "Document name" ), $DocNameCond, $DocNameFld, $sqlcond, $CondCommentText );

AddConditionStr( "publ_place", SelectWord($Language, "Місце видання", "Место издания", "Place of publication" ), 'start', $PublPlaceFld, $sqlcond, $CondCommentText );

AddConditionStr( "publisher", SelectWord($Language, "Видавництво", "Издательство", "Publisher" ), 'start', $PublisherFld, $sqlcond, $CondCommentText );

AddConditionStr( "el_copy", SelectWord($Language, "Електронна копія", "Электронная копия", "Electronic copy" ), 'on', $ElCopy, $sqlcond, $CondCommentText );

// Год реально строковое поле и обрабатывается особым образом
AddConditionYear( SelectWord($Language, "Рік видання", "Год издания", "Year of publication" ), $PublYearFld1, $PublYearFld2, $sqlcond, $CondCommentText );

AddConditionStr( "udk", SelectWord($Language, "УДК", "УДК", "UDC" ), 'start', $UDC_Fld, $sqlcond, $CondCommentText );
AddConditionStr( "bbk", SelectWord($Language, "ББК", "ББК", "BBC" ), 'start', $BBC_Fld, $sqlcond, $CondCommentText );
AddConditionStr( "annot", SelectWord($Language, "Анотація", "Анотация", "Annotation" ), 'containword', $AnnotationFld, $sqlcond, $CondCommentText );

AddConditionStr( "isbn", "ISBN", 'start', $ISBN_Fld, $sqlcond, $CondCommentText );
AddConditionStr( "issn", "ISSN", 'start', $ISSN_Fld, $sqlcond, $CondCommentText );

if( $LangList != "0" AND $LangList != "" AND !is_null($LangList) )
{	if( $CondCommentText != "" )
		$CondCommentText .= "<br>\n";
	$sqlcond .= " and lang_kod in ( $LangList ) ";
	$CondCommentText .= SelectWord($Language, " Мова включаючи ( ", " Язык включая ( ", " Language include ( " );
	$IsFirstListItem = 1;
	$Result = sqlsrv_query($db1,"select name from languages where kod in ( $LangList  ) order by name");
	while( $row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC) )
	{	if( $IsFirstListItem )
			$IsFirstListItem = 0;
		else
			$CondCommentText .= ", ";
		$CondCommentText .= $row[0];
	}
   
	$CondCommentText .= " ) ";
}

if( $DocTypeList != "0" AND $DocTypeList != "" AND !is_null($DocTypeList) )
{	if( $CondCommentText != "" )
		$CondCommentText .= "<br>";
	$sqlcond .= " and doc_type in ( $DocTypeList ) ";
	$CondCommentText .= SelectWord($Language, " Вид документа включаючи ( ", " Вид документа включая ( ", " Type of document include ( " );
	$IsFirstListItem = 1;
	$Result = sqlsrv_query($db1, "select name from doctype where code in ( $DocTypeList ) order by norder" );
	while( $row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC) )
	{	if( $IsFirstListItem )
			$IsFirstListItem = 0;
		else
			$CondCommentText .= ", ";
		$CondCommentText .= $row[0];
	}
	
	$CondCommentText .= " ) ";
}

if( $PresenceList != "0" AND $PresenceList != "" AND !is_null($PresenceList) )
{	if( $CondCommentText != "" )
		$CondCommentText .= "<br>";
	$PresenceListArray = explode(",", $PresenceList);
	$PresenceQuotedList = "";
	for( $i=0; $i < count($PresenceListArray); $i++ )
	{
		if( $PresenceQuotedList != "" ) $PresenceQuotedList .= ", ";
		$PresenceQuotedList .= "'$PresenceListArray[$i]'";
	}
	
	$sqlcond .= " and d.doc_id in ( SELECT doc_id FROM doc_presence WHERE doc_owner  IN ( $PresenceQuotedList  ) ) ";
	$CondCommentText .= SelectWord($Language, " В наявності у ( ", " В наличии у ( ", " Is present in ( " );
	$IsFirstListItem = 1;
	$Result = sqlsrv_query($db1, "select name from juridical_person where code in ( $PresenceQuotedList ) order by name");
	while( $row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC) )
	{	if( $IsFirstListItem )
			$IsFirstListItem = 0;
		else
			$CondCommentText .= ", ";
		$CondCommentText .= "'" . $row[0] . "'";
	}
	
	$CondCommentText .= " ) ";
}

if( $DisList != "0" AND $DisList != "" AND !is_null($DisList) )
{	if( $CondCommentText != "" )
		$CondCommentText .= "<br>\n";
	$sqlcond .= " and d.doc_id in (select doc_id from doc_dscp where dscp_id in ( $DisList ) ) ";
	$CondCommentText .= SelectWord($Language, " Дисципліна включаючи ( ", " Дисциплина включая ( ", " Course include ( " );
	$IsFirstListItem = 1;
	$Result = sqlsrv_query($db1,"select name from discipline where id in ( $DisList  ) order by name");
	while( $row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC) )
	{	if( $IsFirstListItem )
			$IsFirstListItem = 0;
		else
			$CondCommentText .= ", ";
		$CondCommentText .= $row[0];
	}
   
	$CondCommentText .= " ) ";
}

if( $CondCommentText == "" )
	$CondCommentText = SelectWord($Language, "Без обмежень", "Без ограничений", "Without restrict" ); 

echo "<p><font size=+1><b>" . SelectWord($Language, "Умови пошуку", "Условия поиска", "Search conditions" ) . 
     "</b></font><br> " . $CondCommentText . "</p>"; 

$sqlcount .= $sqlcond;
$sql .= $sqlcond . " order by d.author, d.name";
$Result = sqlsrv_query( $db1,$sqlcount);
//echo "$sqlcount<br><hr>";
//echo "$sql<br>";
$row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
$RecordCount = $row[0];

if( $RecordCount == 0 )
	echo '<p>' . SelectWord($Language, "Не знайдено жодного документа", "Не найдено ни одного документа", "None document found" ) . '</p>'; 
else
{	
	//echo SelectWord($Language, "Всього знайдено документів: ", "Всего найдено документов: ", "Documents found: " ); 
	//echo '<b>' . $RecordCount . '</b><br>'; 

	$StartNum = ( $PageNum - 1 ) * $PageSize + 1;
	$StopNum = $StartNum + $PageSize - 1;
	if( $StartNum <= $RecordCount )
	{	if( $StopNum > $RecordCount )$StopNum = $RecordCount;
		echo Translate("DocPresent")."<b>$StartNum - $StopNum</b> ";
		echo Translate("FoundQty")."<b>$RecordCount</b><br>";
		echo '<hr align="left" width=640>';
	
		//echo "$sql";
		$Result = sqlsrv_query($db1, $sql );
		//echo $sql, $StartNum;


    /* - */
    
     
             
			//$row = $Result->fetchRow(DB_FETCHMODE_ASSOC, $StartNum-1 );
            for ($i=0; $i<$StartNum; $i++) {$row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);};

			/*- тут тоже надо приделать обработку ошибок -*/

		$CurNum = $StartNum;
		echo '<table width=640 border=0>';
		//print_r(array_keys ($row)); 
		while ( $row and $CurNum <= $StopNum )
		{
			$DocId           = $row[DBSelectExpression('doc_id')];
			$DocFldType      = $row[DBSelectExpression('doc_type')];
			$DocAuthorMark   = $row[DBSelectExpression('author_mark')];
			$DocFldAuthor    = $row[DBSelectExpression('author')];
			$DocFldName      = $row[DBSelectExpression('name')];
			$DocFldPublPlace = $row[DBSelectExpression('publ_place')];
			$DocFldPublisher = $row[DBSelectExpression('publisher')];
			$DocFldPublYear  = $row[DBSelectExpression('publ_year')];
			$DocFldSize      = $row[DBSelectExpression('sizem')];
			$DocFldISBN      = $row[DBSelectExpression('isbn')];
			$DocFldISSN      = $row[DBSelectExpression('issn')];
			$DocFldCipher    = $row[DBSelectExpression('cipher')];
			$DocDeviceCode   = $row[DBSelectExpression('device_kod')];
			$DocURL          = $row[DBSelectExpression('long_filename')];     
		/* */

			$DocFldAnnotation = "";
	        for( $xFldIdx = 0; $xFldIdx < $xFldCount; $xFldIdx++ )

			/*- отладочный вывод -*/
            //echo $xFldCount," = ", $xFldIdx, " = ", $xFldSelectColIdx[ $xFldIdx ]," =";
			/* ------ */
				if( $xFldSelectColIdx[ $xFldIdx ] >= 0 )
			           	$xFldValue[ $xFldIdx ] = $row[ DBSelectExpression( $xFldColName[$xFldIdx] ) ];
					//$xFldValue[ $xFldIdx ] = $row[ DBSelectExpression( $xFldColName[$xFldIdx] ) ];

			$DocumentCard = "";
			CreateDocCard( $DocumentCard );
			if( !is_null($DocFldCipher) and $DocFldCipher != "" ){
				$DocumentCard .= "<br>Шифр: " . $DocFldCipher;  }
            if( !is_null($DocAuthorMark) and $DocAuthorMark != "" ){
				$DocumentCard .=((!is_null($DocFldCipher) and $DocFldCipher != '')?'&nbsp;&nbsp;':'<br>'). SelectWord($Language, "Авторський знак:&nbsp;", "Авторский знак:&nbsp;", "Author mark:&nbsp;" ). $DocAuthorMark; }
			$DocumentCard .= "<br><a href=page_lib.php onClick='form_main.docid.value=\"$DocId\";form_main.mode.value=\"DocBibRecord\";form_main.submit();return false'>";
			$DocumentCard .= SelectWord($Language, "Опис документа", "Описание документа", "Document info" ) . "</a>";
			
			//$IP = $_SERVER['REMOTE_ADDR'];
			//if(($IP=='10.2.0.197')||($IP=='10.2.0.103')||($IP=='10.2.0.2')){
			$DocumentCard .= "<br><a href=page_lib.php  onClick='form_main.docid.value=\"$DocId\";form_main.mode.value=\"page_zakaz\";form_main.submit();return false'>";
			$DocumentCard .= SelectWord($Language, "Замовлення документа", "Заказ документа", "Document order" ) . "</a>";
			//}
			
			/* - Вывод ссылки на электронную копию - просто выводим ссылку на ХТТП или ФТП */
			if( $DocDeviceCode == 28670 and trim($DocURL) != "" and !is_null($DocURL) )
				$DocumentCard .= "<br><a target='_blank' href='$DocURL'>"
				 . SelectWord($Language, "Електронна версія документа", "Электронная версия", "Elektronic copy")
				 ."</a><br><br>\n";
			echo '
				<tr>
                <td align="right" valign="top" width=30><b>' .$CurNum . '.</b></td>
                <td align="left" valign="top" width=610>' . $DocumentCard . '</td>
                </tr>';
			//$row = $Result->fetchRow(DB_FETCHMODE_ASSOC);
			$row = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);//возможно тут надоmssql_fetch_assoc
			if( $CurNum % 2 == 0 ) 
				echo '</table><table width=640 border=0>'; 
			$CurNum++;
		}
		
		echo '</table>'; 
	}
	echo "<p>".Translate('ResultPage');
	$PageFrom = max( $PageNum - 10, 1 );
	$PageTo   = min( $PageNum + 10, ((int)($RecordCount-1)/$PageSize) + 1 );
	for( $i=$PageFrom; $i <= $PageTo; $i++ )
		if( $i == $PageNum )
			echo " <b>$i</b> ";
		else
			echo " <a href='page_lib.php' onClick='form_main.page.value=\"$i\";form_main.mode.value=\"BookList\";form_main.submit();return false'>$i</a> ";

	//if( $StopNum < $RecordCount )
	//	echo '<p><input type="submit" value="' . SelectWord($Language, "Далі", "Дальше", "Next" ) . '" ></p>'; 
}
  sqlsrv_close($db1);
  sqlsrv_close($db2);

?>
</FORM>



<?php 
function AddConditionStr ($FieldName, $FieldComment, $CondValue, $FieldValue, &$SqlText, &$CommentText )
{	global $Language;
	if ( $FieldValue == "" ) return;

	if($CondValue == 'on'){
    /*надо искать электронную копию*/
    $CondText ='';
    }else{$CondText = " UPPER($FieldName) ";};
	$NewFieldValue = strtoupper($FieldValue);
	$Comment = "";


    if( $CondValue == 'containtext')/*- тут добавлен поиск мистыть текст -*/
	{
    $CondText .= " like '%" . $NewFieldValue . "%' ";
		$Comment = $FieldComment . SelectWord($Language, " містить текст '", " содержит текст '", " contain text '") .
			$FieldValue . "' " . $Comment;
	}elseif( $CondValue == "start")
	{	$CondText .= " like '$NewFieldValue%' ";
		$Comment = $FieldComment . SelectWord($Language, " починається з '", " начинается с '", " begin with '") .
			$FieldValue . "' " . $Comment;
	}elseif( $CondValue == 'on')
	{ /*-  По этой ветке должно пойти только в случее с електронной копией  -*/
        $CondText .= " (device_kod !=0) ";
		//$Comment = $FieldComment . SelectWord($Language, " існує", " существует", " exist") .$FieldValue . "' " . $Comment;
	    $Comment = $FieldComment . SelectWord($Language, " існує '", " существует '", " exist '") .SelectWord($Language, "так", "да", "yes"). "' " . $Comment;
	}
	elseif( $CondValue == "containword")
	{	$Comment = $FieldComment . SelectWord($Language, " містить слова '", " содержит слова '", " contain word '") .
    	           $FieldValue . "' " . $Comment;
		$CondText = " ( (1=1) ";
if ($FieldName=='author'){$NewFieldValue=$NewFieldValue . '*';$NewFieldValue = str_replace(" ", "* ", $NewFieldValue );}else{};

    	$NewFieldValue = str_replace("*", "%", $NewFieldValue );
		$WordList = explode(" ", $NewFieldValue );
		$WordCount = count($WordList);
		for( $WordIdx = 0; $WordIdx < $WordCount; $WordIdx++ )
		{	if( $WordList[ $WordIdx ] != "")
			{	if( $FieldName == "author")
				{	$CondText .= " and d.doc_id in (select doc_id from author_word_index where  
				                     UPPER(author) like '" . $WordList[$WordIdx] . "' ) ";
				}
				elseif( $FieldName == "name")
				{	$CondText .= " and d.doc_id in (select doc_id from word_index where field_kod = 0 and  
				                     UPPER(word) like '" . $WordList[$WordIdx]  . "' ) ";
				}
				elseif( $FieldName == "annot")
				{	$CondText .= " and d.doc_id in (select doc_id from word_index where field_kod = 7 and  
				                     UPPER(word) like '" . $WordList[$WordIdx]  . "' ) ";
				}
			}
		}
		$CondText .= " ) ";
	}    
	else
		return;

	$SqlText .= " and " . $CondText;
	if( $CommentText != "")
		$CommentText .= "<br>";
	$CommentText .= $Comment;
}

function AddConditionYear($FieldComment, $FieldValue1, $FieldValue2, &$SqlText, &$CommentText )
{	global $Language;
	if( is_numeric($FieldValue1) and is_numeric($FieldValue2) )
	{	
		$FieldValue1 = "'" . $FieldValue1 . "'";
		$FieldValue2 = "'" . $FieldValue2 . "'";
		$CondText = "( " . $FieldValue1 . " <= publ_year and publ_year <= " . $FieldValue2 . " )";
		$Comment = $FieldComment . SelectWord($Language, " в діапазоні ", " в диапазоне ", " between ") . $FieldValue1 . " - " . $FieldValue2;
	}
	else if( is_numeric($FieldValue1) )
	{	
		$FieldValue1 = "'" . $FieldValue1 . "'";
		$CondText = " publ_year >= " . $FieldValue1;
		$Comment = $FieldComment . SelectWord($Language, " більше або дорівнює ", " больше или равняется ", " greater or equal ") . $FieldValue1;
	}
	else if( is_numeric($FieldValue2) )
	{	
		$FieldValue2 = "'" . $FieldValue2 . "'";
		$CondText = " publ_year <= " . $FieldValue2;
		$Comment = $FieldComment . SelectWord($Language, " меньше або дорівнює ", " меньше или равняется ", " less or equal ") . $FieldValue2;
	}
	else
		return;
	$SqlText .= " and " . $CondText;
	if( $CommentText != "" )
		$CommentText .= "<br>";
	$CommentText .= $Comment;
}

// ----------------------------  CreateDocCard  --------------------------------------

function CreateDocCard( &$ResultCard )
{	global 	$DocFldAuthor, $DocFldName, $DocFldPublPlace, $DocFldPublisher, $DocFldPublYear,
			$DocFldISBN, $DocFldISSN, $DocFldAnnotation, $DocFldSize, $DocFldType, $DocLang,$AuthorType;
	$IsFirst = 0;
	$ResultCard = "";

	if( $AuthorType < 1 )
	{AddXFields( 1, $IsFirst, 0, 2, $ResultCard, 1, 1 );  // AREA_Header

//	$AuthType = sqlsrv_query('select author_type from document',$db1);
//echo ".",$AuthorType,".";
	if( $AuthorType < 1 )
	{
//		$RespAuth = "";
		$DocFldAuth = str_replace(", ", ",", $DocFldAuthor);
		$DocFldAuth = str_replace(". ", ".", $DocFldAuth);
		$AuthList = explode(",", $DocFldAuth );
		$AuthCount = count($AuthList);
		if ($AuthCount < 4)
		{
			$Auth1 = explode(" ", $AuthList[0] );
			$Auth1Words = count($Auth1);
			if ($Auth1Words > 0)
			{
			$DocFldAuth = $Auth1[0];
			if ($Auth1Words > 1)
			{
				$Auth11 = "";
				for( $AuthI = 1; $AuthI < $Auth1Words; $AuthI++ )
				{	if( $Auth1[ $AuthI ] != "" and $Auth1[$AuthI] != " ")
						$Auth11 = "$Auth11 $Auth1[$AuthI]" ;
				}
			$DocFldAuth = $DocFldAuth . ", " . $Auth11;
			}
			$DocFldAuth = str_replace(".", ". ", $DocFldAuth);
			}
		}
//echo $AuthCount;
//		if ($AuthCount < 4)  {$DocFldAuthor = str_replace(" ", ", ", $AuthList[0]);}  else  {$DocFldAuthor = "";}
//		for( $AuthIdx = 0; $AuthIdx < $AuthCount; $AuthIdx++ )
//		{	if( $AuthList[ $AuthIdx ] != ""  and $AuthList[ $AuthIdx ] != " ")
//			{	$Auth = explode(" ", $AuthList[ $AuthIdx ] );
//				$AuthC = count($Auth);
//echo $AuthC;
//				$Auth11 = "";
//				for( $AuthI = 1; $AuthI < $AuthC; $AuthI++ )
//				{	if( $Auth[ $AuthI ] != "" and $Auth[$AuthI] != " ")
//						$Auth11 = "$Auth11 $Auth[$AuthI]" ;
//				}
//				$Auth11 = "$Auth11 $Auth[0]";
//				if( $RespAuth != "" )
//				{$RespAuth = "$RespAuth, $Auth11";}
//				else {$RespAuth = "$Auth11";}
//			}
//		}
	}

	AddField( $DocFldAuth, "", $IsFirst, $ResultCard );
//	AddField( $DocFldAuthor, " ", $IsFirst, $ResultCard );
	AddXFields( 1, $IsFirst, 2, 10, $ResultCard, 1, 1 );  // AREA_Header
	if( $ResultCard != "" )
		$ResultCard = "<b>$ResultCard</b><br>";}
	AddField( $DocFldName, "", $IsFirst, $ResultCard );
	if( $DocFldType == "7")
		$ResultCard = "$ResultCard [Звукозапис]";
	elseif( $DocFldType == "21" or $DocFldType == "26")
		$ResultCard = "$ResultCard [Електронний ресурс]";
	elseif( $DocFldType == "22" or $DocFldType == "19")
		$ResultCard = "$ResultCard [Ноти]";
	elseif( $DocFldType == "25")
		$ResultCard = "$ResultCard [Карти]";
	elseif( $DocFldType == "24")
		$ResultCard = "$ResultCard";
		//$ResultCard = "$ResultCard [Графіка]";
	else 
		$ResultCard = "$ResultCard [Текст]";
//	$IsFirst = 1;
	AddXFields( 1, $IsFirst, 10, 30, $ResultCard, 0, 0 );
//	if( $RespAuth != "" AND !is_null($RespAuth) )
//		{AddField( $RespAuth, " / ", $IsFirst, $ResultCard );
//		$IsFirst = 0;
//		AddXFields( 1, $IsFirst, 30, 35, $ResultCard, 0 );}
//	else
//	{AddXFields( 1, $IsFirst, 30, 35, $ResultCard, 1 );}
//	$IsFirst = 1;
	AddXFields( 1, $IsFirst, 30, 41, $ResultCard, 1, 1 );
	AddXFields( 1, $IsFirst, 41, 46, $ResultCard, 1, 1 );
	$IsFirst = 1;
	AddXFields( 1, $IsFirst, 46, 49, $ResultCard, 1, 0 );
//	$IsFirst = 1;
	AddXFields( 1, $IsFirst, 49, 0, $ResultCard, 0, 0 );
//	$IsFirst = 1;
	AddXFields( 2, $IsFirst, 0, 0, $ResultCard, 1, 1 ); // AREA_Publication
	$IsFirst = 1;
	AddXFields( 3, $IsFirst, 5, 10, $ResultCard, 1, 1 ); // AREA_OutData
	if( $DocFldPublPlace != "" AND !is_null($DocFldPublPlace) )
		AddField( $DocFldPublPlace, "", $IsFirst, $ResultCard );
	if( $DocFldPublisher != "" AND !is_null($DocFldPublisher) )
		AddField( $DocFldPublisher, " : ", $IsFirst, $ResultCard );
	if( $DocFldPublYear != 0 )
		AddField( $DocFldPublYear, ", ", $IsFirst, $ResultCard );
	AddXFields( 3, $IsFirst, 12, 0, $ResultCard, 1, 1 ); // AREA_OutData
	$IsFirst = 1;
	AddXFields( 4, $IsFirst, 0, 5, $ResultCard, 1, 1 ); // AREA_Quantity
	if( $DocFldSize != "" AND !is_null($DocFldSize) )
	if( is_numeric($DocFldSize) or substr_count($DocFldSize,"-")>0 )
	{ if ( $DocFldType == "6" or  $DocFldType == "18" or  $DocFldType == "22" or  $DocFldType == "26")
		if ( $DocLang == "Російська" or  $DocLang == "Українська")
			AddField( "C. " . $DocFldSize, "", $IsFirst, $ResultCard );
//			$ResultCard .= "C. ";
		else
			AddField( "P. " . $DocFldSize, "", $IsFirst, $ResultCard );
//			$ResultCard .= "P. ";
	  else
		if ( $DocLang == "Російська" or  $DocLang == "Українська")
			AddField( $DocFldSize . " c.", "", $IsFirst, $ResultCard );
		else
			AddField( $DocFldSize . " p.", "", $IsFirst, $ResultCard );
	}
	else	AddField( $DocFldSize, "", $IsFirst, $ResultCard );
	AddXFields( 4, $IsFirst, 5, 0, $ResultCard, 1, 1 ); // AREA_Quantity
	$IsFirst = 1;
	AddXFields( 5, $IsFirst, 0, 0, $ResultCard, 1, 1 ); // AREA_Series
	if( !$IsFirst )
		$ResultCard .= ")";
	$IsFirst = 1;
	AddXFields( 6, $IsFirst, 0, 0, $ResultCard, 1, 1 ); // AREA_Comment
	$IsFirst = 1;
	AddXFields( 7, $IsFirst, 0, 1, $ResultCard, 1, 1 ); // AREA_ISBN
	if( $DocFldISBN != "" AND !is_null($DocFldISBN) )
		AddField( $DocFldISBN, " ISBN ", $IsFirst, $ResultCard );
	AddXFields( 7, $IsFirst, 1, 3, $ResultCard, 1, 1 ); // AREA_ISBN
	if( $DocFldISSN != "" AND !is_null($DocFldISSN) )
		AddField( $DocFldISSN, " ISSN ", $IsFirst, $ResultCard );
	$IsFirst = 1;
	AddXFields( 7, $IsFirst, 3, 0, $ResultCard, 1, 1 ); // AREA_ISBN
	$IsFirst = 1;
	AddXFields( 8, $IsFirst, 0, 0, $ResultCard, 1, 1 ); // AREA_Specific
	$IsFirst = 1;
	AddXFields( 9, $IsFirst, 0, 0, $ResultCard, 1, 1 ); // AREA_Specific
	if( $DocFldAnnotation != "" AND !is_null($DocFldAnnotation) )
		$ResultCard .= ".<br>" . $DocFldAnnotation;

$ResultCard = str_replace(". - ", ". – ", $ResultCard);
$ResultCard = str_replace(".- ", ". – ", $ResultCard);
//$ResultCard = str_replace(".-", ". – ", $ResultCard);
$ResultCard = str_replace(". . ", ". ", $ResultCard);
$ResultCard = str_replace(" . ", ". ", $ResultCard);
$ResultCard = str_replace(" , ", ", ", $ResultCard);
$ResultCard = str_replace(". .", ".", $ResultCard);
$ResultCard = str_replace(" .", ".", $ResultCard);
if( substr( $ResultCard, strlen($ResultCard)-2, 2 ) != ". " and substr( $ResultCard, strlen($ResultCard)-1, 1 ) != ".")
			$ResultCard .= ".";

}

// ----------------------------  AddField  --------------------------------------

function AddField( $Field, $Separator, &$IsFirst, &$Result )
{	if ($IsFirst)
	{	$IsFirst = 0;
		if( substr( $Result, strlen($Result)-1, 1 ) == ".")
			$Result .= " – ";
		else
			$Result .= ". – ";
	} 
    else
       {if(( substr( $Result, strlen($Result)-1, 1 ) == "." )and( substr( $Separator, 0, 1 ) == "."))
			$Separator = " ";
	$Result .= $Separator;}
    if ( $Field != "" AND !is_null($Field) )
       $Result .= $Field;
}


// ----------------------------  AddXFields  --------------------------------------

function AddXFields( $AreaCode, &$IsFirst, $MinValue, $MaxValue, &$ResultCard, $Ind, $GroupLead )
{	global 	$ViewMode, $xFldCount, $xFldDataType, $xFldRealArea, $xFldValue,
			$xFldNo, $xFldKod, $xFldSeparator, $xFldEndSeparator, 
            $xFldSuperField, $xFldMarcCodeTbl, $xFldAllowEdit, 
			$DocFldType, $DocTypeFld_Count, $DocTypeFld_DocTypeCode, $DocTypeFld_ColCode,
			$db1,$db2;
             
	if( $MaxValue == 0 ) $MaxValue = 100000;
	if( $Ind == 0 ) {$IsFirstInGroup = 0;}
		else {$IsFirstInGroup = 1;}
	$GroupEndSeparator = "";
	for( $xFldIdx=0; $xFldIdx < $xFldCount; $xFldIdx++ )
	{
       	if( $xFldDataType[$xFldIdx] != "GROUP" )
		{	$CurAreaCode = $xFldRealArea[ $xFldIdx ];
			if( $CurAreaCode == $AreaCode AND $xFldValue[$xFldIdx] != "" AND !is_null($xFldValue[$xFldIdx]) AND 
				$MinValue <= $xFldNo[$xFldIdx] AND $xFldNo[$xFldIdx] < $MaxValue )
			{
				for( $i=0; $i < $DocTypeFld_Count; $i++ )
				{	if( $DocTypeFld_DocTypeCode[$i] == $DocFldType AND $DocTypeFld_ColCode[$i] == $xFldKod[$xFldIdx] )
						break;
				}
				if( $i < $DocTypeFld_Count )
				{
//					$ResultCard .= "{Area: $CurAreaCode, No: $xFldNo[$xFldIdx], Kod: $xFldKod[$xFldIdx], Value: $xFldValue[$xFldIdx]}"; 
					if( $IsFirst)
					{	$IsFirst = 0;
						if( substr( $ResultCard, strlen($ResultCard)-1, 1 ) == ".")
							$ResultCard .= " – ";
						else
							$ResultCard .= ". – ";

						if( $CurAreaCode == 5 ) // Area_series
							$ResultCard .= "(";

						$StartSeparator = ""; $EndSeparator = "";
						if( $GroupLead)
						if( $xFldSeparator[$xFldIdx] != "" AND $xFldEndSeparator[$xFldIdx] != "" )
						{	$StartSeparator = $xFldSeparator[$xFldIdx];
							$EndSeparator   = $xFldEndSeparator[$xFldIdx];
						}
					}
					else
					{	$StartSeparator = $xFldSeparator[$xFldIdx];
						$EndSeparator   = $xFldEndSeparator[$xFldIdx];
//						if( $StartSeparator == "" )
//							$StartSeparator = " ";
						if( $StartSeparator == "//" )
							$StartSeparator = " // ";
//						if( $StartSeparator == "/" and $Ind == 0 )
//							$StartSeparator = " ;";
						if( $StartSeparator == "=" )
							$StartSeparator = " = ";
						if( $StartSeparator == "/" )
							$StartSeparator = " / ";
						if( $StartSeparator == ":" )
							$StartSeparator = " : ";
						if( $StartSeparator == ";" )
							$StartSeparator = " ; ";
						if( $xFldNo[$xFldIdx] == "31" )
							$StartSeparator = " : захищена ";
						if( $xFldNo[$xFldIdx] == "32" )
							$StartSeparator = " : затв. ";
						if( $StartSeparator == ".-" or $StartSeparator == ". -")
						{	if( substr( $ResultCard, strlen($ResultCard)-1, 1 ) == ".")
								$StartSeparator = " – ";
							else
								$StartSeparator = ". – ";
						}
						if( ($StartSeparator == "." or $StartSeparator == ". ") and substr( $ResultCard, strlen($ResultCard)-1, 1 ) == ".")
								$StartSeparator = " ";
					}

					if( $IsFirstInGroup and $GroupLead )
					{
						if( $xFldSuperField[ $xFldIdx ] != 0 )
						{
							for( $i=0; $i < $xFldCount; $i++ )
							{	if( $xFldKod[$i] == $xFldSuperField[ $xFldIdx ] )
									break;
							}
							if( $xFldKod[$i] == $xFldSuperField[ $xFldIdx ] )
							{	$GroupEndSeparator = $xFldEndSeparator[$i];
								$ResultCard .= $xFldSeparator[$i];
								if( $xFldSeparator[$i] != "" )
									$StartSeparator = "";
							}
						}
						$IsFirstInGroup = 0;
					}
/*					if( $xFldMarcCodeTbl[$xFldIdx] != "" AND $xFldAllowEdit[$xFldIdx] == 0 )
					{                        
						$Res = sqlsrv_query(
							" select name from " . $xFldMarcCodeTbl[$xFldIdx] .
							" where code = '" . $xFldValue[$xFldIdx] . "' and (stat <> 'D' or stat is null)" ,$db2);
						//if (DB::isError($Res)) {die ($Res->getMessage());}
//                        echo " select name from " . $xFldMarcCodeTbl[$xFldIdx] .
//							" where code = '" . $xFldValue[$xFldIdx] . "' and (stat <> 'D' or stat is null)";
						if( $row = mssql_fetch_row($Res) )
							$ResultCard .= $StartSeparator . $row[0] . $EndSeparator;
						else
							$ResultCard .= $StartSeparator . $xFldValue[$xFldIdx] . $EndSeparator;
						 mssql_free_result($Res);
					}
					else*/
						$ResultCard .= $StartSeparator .' '. $xFldValue[$xFldIdx] . $EndSeparator;
				}
			}
       	}
   	}
	if( $GroupEndSeparator != "" )
		$ResultCard .= $GroupEndSeparator;
}

// ----------------------------  GetAreaCode  --------------------------------------

function GetAreaCode( $xFldIdx )
{	global $xFldArea, $xFldSuperField, $xFldCount, $xFldKod;

	while (1)
	{	if ( $xFldArea[ $xFldIdx ] == -1)	// Area_hidden
			return 0;                   	// Area_none
		if ( $xFldArea[ $xFldIdx ] != 0)	// Area_none
			return $xFldArea[ $xFldIdx ];
		if ( $xFldSuperField[ $xFldIdx ] == 0)
			return 0;                    	// Area_none
		for( $i=0; $i < $xFldCount; $i++ )
		if ( $xFldKod[$i] == $xFldSuperField[ $xFldIdx ] )
		{	$xFldIdx = $i;
			break;
		}	
	}
}

function NavigationBar()
{
	global $Language,$Extended, $sMainPageURL;

	echo "<img src='../img/razd3.gif' width='6' height='10'> ";
	echo "<font size=-1><a href='$sMainPageURL'>". Translate("MainPage") ."</a> ";
	echo "<img src='../img/razd3.gif' width='6' height='10'> ";
	//echo "<a href='page_lib.php?lang=$Language&ext=$Extended'>".Translate("SearchEngine")."</a> "; 
	echo "<a href='page_lib.php?lang=$Language&ext=$Extended&mode=form'>".Translate("SearchEngine")."</a> "; 
	echo "<img src='../img/razd3.gif' width='6' height='10'> ";
	echo Translate("FoundDoc");
	echo "</font>"; 
}

function InitDictionary()
{	global $Dictionary;
	$Dictionary = array(
		'MainPage'       => array('Головна сторінка','Главная страница','Main page'),
		'SearchEngine'   => array('Електронний каталог','Электронный каталог','El. catalogue'),
		'MainPageHTM'    => array('main.htm','mainrus.htm','maineng.htm'),
		'USH_Lib'        => array('Інформаційно-пошукова система<br>"УФД/Бібліотека"','Информационно-поисковая система<br>"УФД/Библиотека"','Information system<br>"USH/Library"'),
		'USH'            => array('Український Фондовий Дім','Украинский Фондовий Дом','Ukranian Stock House'),
		'Except'         => array('За винятком','За исключением','Not include'),
		'ResultPage'     => array('Сторінка з результатами: ','Страница с результатами: ','Result page: '),
		'FoundQty'       => array('від загального числа ','от общего числа ',' of '),
		'DocPresent'     => array('Результати ','Результаты ','Results '),
		'FoundDoc'       => array('Відібрані документи','Отобранные документы','Found documents')
	);
}

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
