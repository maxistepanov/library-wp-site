
<?php
/**
	Template Name: Детальная інформація
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package GeneratePress
 */
 

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			
			<?php do_action('generate_before_main_content'); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
				
				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

			<?php do_action('generate_after_main_content'); ?>
			<!--   my custom code block-->

			<article id="post-158" class="post-158 page type-page status-publish" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
	<div class="inside-article">
					<header class="entry-header">
					</header><!-- .entry-header -->
				
				<div class="entry-content" itemprop="text">
					<?php 

  $conn = get_connection();      
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$DocId = $_GET['id'];

$sql = 
	"select doc_id, doc_type, cipher, author, author_type, name, 
			annot1, annot2, annot3, annot4, 
			publ_place, publisher, publ_year,
			item_qty, item_present,
			udk, isbn, bbk, issn, 
			author_mark, lang, sizem, 
			parent_id, is_parent, device_kod, long_filename, item_qty, filename, cdlabel
	from   document d 
	where  doc_id = ".$DocId;

$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false) {
     print_r( sqlsrv_errors(), true);
}
else {
	$row  = sqlsrv_fetch_array($stmt);

	$DocTypeCode  = $row['doc_type'];
	$Cipher       = $row['cipher'];
	$Author       = $row['author'];
	$AuthTypeCode = $row['author_type'];
	$Name         = $row['name'];
	$PublPlace    = $row['publ_place'];
	$Publisher    = $row['publisher'];
	$PublYear     = $row['publ_year'];
	$UDC          = $row['udk'];
	$BBC          = $row['bbk'];
	$ISBN         = $row['isbn'];
	$ISSN         = $row['issn'];
	$AuthorMark   = $row['author_mark'];
	$Lang         = $row['lang'];
	$Size         = $row['sizem'];
	$ParentId     = $row['parent_id'];
	$IsParent     = $row['is_parent'];
	$DeviceCode   = $row['device_kod'];
	$DocURL       = $row['long_filename'];
	$ItemQty      = $row['item_qty'];
	$file_name    = $row['filename'];
	$CDlabel      = $row['cdlabel'];

	$Annotation = $row['annot1'];
if( !is_null($row['annot2'] ) ) $Annotation .= $row['annot2'];
if( !is_null($row['annot3'] ) ) $Annotation .= $row['annot3'];
if( !is_null($row['annot4'] ) ) $Annotation .= $row['annot4'];

if( $Author == "" )
   $AuthTypeName = "";
elseif( $AuthTypeCode == 0 )
   $AuthTypeName = Translate('AuthorPerson');
elseif( $AuthTypeCode == 1 )
   $AuthTypeName = Translate('AuthorOrg');
elseif( $AuthTypeCode == 2 )
   $AuthTypeName = Translate('AuthorEvent');
else
   $AuthTypeName = "";


echo "
<b><font size='+1'>$Author</font></b><br> 
<b><font size='+2'>$Name</font></b><br><br>";
}

$FieldLine = "";



PrintField( SelectWord($Language, "Вид документа", "Вид документа", "Type of document"), $DocTypeName, $FieldLine );

PrintLine($FieldLine);

PrintField( SelectWord($Language, "Рiк видання", "Год издания", "Year of publikation"), $PublYear, $FieldLine );
PrintField( SelectWord($Language, "Мiсце видання", "Место издания", "Publikation plase"), $PublPlace, $FieldLine );
PrintField( SelectWord($Language, "Видавництво", "Издательство", "Publisher"), $Publisher, $FieldLine );
PrintLine($FieldLine);

PrintField( SelectWord($Language, "Автор", "Автор", "Author"), $Author, $FieldLine );
PrintField( SelectWord($Language, "Авторський знак", "Авторский знак", "Authors mark"), $AuthorMark, $FieldLine );
PrintField( SelectWord($Language, "Вид автора", "Вид автора", "Author type"), $AuthTypeName, $FieldLine );
PrintLine($FieldLine);

PrintField( SelectWord($Language, "Мова", "Язык", "Languadge"), $Lang, $FieldLine );
PrintField( SelectWord($Language, "Обсяг", "Объём", "Volume"), $Size, $FieldLine );
PrintLine($FieldLine);

PrintField( SelectWord($Language, "Шифр", "Шифр", "Cipher"), $Cipher, $FieldLine );
PrintField( SelectWord($Language, "УДК", "УДК", "UDC"), $UDC, $FieldLine );
PrintField( SelectWord($Language, "ББК", "ББК", "BBC"), $BBC, $FieldLine );
PrintField( "ISBN", $ISBN, $FieldLine ); 
PrintField( "ISSN", $ISSN, $FieldLine );
PrintLine($FieldLine);

if( $Annotation <> "" and !is_null($Annotation) )
	echo "<table border=0 width=700><tr><td valign='top'><b>Аннотацiя:</b></td><td>".$Annotation."</td></tr></table>";

//PrintField( "Аннотацiя", $Annotation, $FieldLine );
//PrintLine($FieldLine);
/* - Вывод ссылки на электронную копию - */
if($DeviceCode == 28670 and trim($DocURL) <> "" and !is_null($DocURL) )
 {/* просто выводим ссылку на ХТТП или ФТП */
 echo "<p>". SelectWord($Language, "Електронна версія документа", "Электронная версия", "Elektronic copy") .": <a href=$DocURL>$DocURL</a></p>\n";}
 elseif($DeviceCode == 28671){
/* просто выводим фразу про локальный СД */
 echo "<p>". SelectWord($Language, "Електронна версія документа на локальному CD", "Электронная версия на локальном CD", "Elektronic copy on local CD") . ": \"$CDlabel \"</p>\n\n";}


 elseif($DeviceCode == 28668){
/* просто выводим ссылку в локальную сеть... а долльше пусть сами разбираются */
 echo "<p>". SelectWord($Language, "Електронна версія документа в локальній мережі", "Электронная версия в локальной сети", "Elektronic copy in localNET") .": <a href=$DocURL>$DocURL</a></p>\n";
 }
elseif($DeviceCode == 28669){

 echo "<p>Електронна версія документа: <a href=Download/page_Download.php?DocId=$DocId&filename=$file_name>Зберегти</a></p>\n";

 } else{/*-- інше --*/};


 // table
$sql = "select ";
$xFieldCount = 0;
$Result = sqlsrv_query($conn,
		"select   kod, name, superfield, stype, marc_codetbl, allowtextedit, author_level
		 from     docxfield_list dfl, doctype_field dtl
		 where    dtl.col_kod = dfl.kod and dtl.doctype_kod = ".$DocTypeCode."
		 order by dfl.norder ");
$test = sqlsrv_fetch_array($Result);
while( $row = sqlsrv_fetch_array($Result) )
{	$xFieldKod[$xFieldCount]         = $row['kod'];
	$xFieldName[$xFieldCount]        = $row['name'];
	$xFieldSuperField[$xFieldCount]  = $row['superfield'];
	$xFieldMarcCodeTbl[$xFieldCount] = $row['marc_codetbl'];
	$xFieldAuthorLevel[$xFieldCount] = $row['author_level'];
	$xFieldAllowEdit[$xFieldCount]   = $row['allowtextedit'];
	if( $bNewDBStruct )
		$xFieldDataType[$xFieldCount] = $row['stype'];
	else
		$xFieldDataType[$xFieldCount] = $row['type'];

	$xFieldColName[$xFieldCount] = $xFieldKod[$xFieldCount];
	if( $xFieldKod[$xFieldCount] < 100 )
		$xFieldColName[$xFieldCount] = "0" . $xFieldColName[$xFieldCount];
	if( $xFieldKod[$xFieldCount] < 10 )
		$xFieldColName[$xFieldCount] = "0" . $xFieldColName[$xFieldCount];
	$xFieldColName[$xFieldCount] = "col" . $xFieldColName[$xFieldCount];
	if( $xFieldCount > 0 )
		$sql .= ", ";
	$sql .= $xFieldColName[$xFieldCount];
	$xFieldCount++;
}

$sql .= " from docxfield_value where doc_id = ".$DocId;
//echo $sql;

$Result = sqlsrv_query($conn,$sql);
//$row = $Result->fetchRow();
$row = sqlsrv_fetch_array($Result);

for( $xFieldIdx = 0; $xFieldIdx < $xFieldCount; $xFieldIdx++ ) 
	$xFieldValue[$xFieldIdx] = $row[$xFieldIdx];

$CurGroupCount = 0;
$AddFields = "";

//echo "<table border=1 width=700>\n";
for( $xFieldIdx = 0; $xFieldIdx < $xFieldCount; $xFieldIdx++ )
{
	if( !empty($xFieldValue[$xFieldIdx]) and !is_null($xFieldValue[$xFieldIdx]) and 
		($xFieldAuthorLevel[$xFieldIdx] == 0 or $xFieldAuthorLevel[$xFieldIdx] == $AuthTypeCode + 1 ) )
	{
        // ------- get NewGroupPath ---------------
		$NewGroupCount = 0;
		$CurSuperField = $xFieldSuperField[$xFieldIdx];
		while( 1 )
		{
			for( $i=0; $i < $CurGroupCount; $i++ )
				if( $CurGroupPath[$i] == $CurSuperField )
					break;
			$CurGroupPathSplit = $i;               // Начиная с CurGroupPathSplit в CurGroupPath и 
			$NewGroupPathSplit = $NewGroupCount;   // NewGroupPathSplit в NewGroupPath и до конца пути совпадают
			if( $i >= $CurGroupCount )
			{
				$NewGroupPath[$NewGroupCount] = $CurSuperField;
				if( $CurSuperField == 0 )
				{
					$NewGroupName[$NewGroupCount] = "Add field";
					break;
				}
				else
				{
					$Result = sqlsrv_query($conn,"select superfield, name from docxfield_list where kod = $CurSuperField" );
					$row = sqlsrv_fetch_array($Result);
					$CurSuperField = $row[0];
					$NewGroupName[$NewGroupCount] = $row[1];
				}
				$NewGroupCount++;
			}
			else
			{
				for( $j=$i; $j < $CurGroupCount; $j++ )
				{
					$NewGroupPath[$NewGroupCount] = $CurGroupPath[$j];
					$NewGroupName[$NewGroupCount] = $CurGroupName[$j];
					$NewGroupCount++;
				}
				break;
			}
		}

		for( $i=$NewGroupPathSplit-1; $i >= 0; $i-- )
		{
			$AddFields .= str_repeat( ' ', ($NewGroupCount-$i-1)*4 );
			$AddFields .= "<b>".$NewGroupName[$i]."</b>\n";
			echo "<table style='margin-bottom: 8px;' border='0' width='700'><tr>";
			for( $j=0; $j < $NewGroupCount-$i-1; $j++ )
				echo "<td width='20'>&nbsp;</td>";
			echo "<td><b>".$NewGroupName[$i]."</b><td></tr></table>\n";
		}

		for( $i=0; $i <= $NewGroupCount; $i++ )
		{
			$CurGroupPath[$i] = $NewGroupPath[$i];
			$CurGroupName[$i] = $NewGroupName[$i];
		}
		
		$CurGroupCount = $NewGroupCount;
		$AddFields .= str_repeat( ' ', $NewGroupCount*4 ); 
		$AddFields .= "<b>".$xFieldName[$xFieldIdx]."</b>:".$xFieldValue[$xFieldIdx]."\n";
		
		echo '<table style= "margin-bottom: 8px;" border="0" width="700"><tr>';
		
		echo "<td width='200' nowrap='1'><b>".$xFieldName[$xFieldIdx]."</b>:</td><td valign='top'>".$xFieldValue[$xFieldIdx]."</td></tr></table>\n";
	} 
}

 // end table
 


 // таблица наличия

$sql = 
	"select name, c.card_id from ref_doc rd, cards c 
	where rd.doc_id = ".$DocId." and rd.card_id = c.card_id"; 
$Result = sqlsrv_query( $conn,$sql);
$ThemeCount = 0;
while( $row = sqlsrv_fetch_array($Result) )
{
	if( $ThemeCount == 0 )
		echo "<b>" . SelectWord($Language, "Теми документа", "Темы документа", "Document chemes") . "</b><ul style='margin:0'>";
	$ThemeName = $row[0];
	$ThemeCode = $row[1]; 
	echo $ThemeName . ' / ' ;
	$ThemeCount++;
}
if( $ThemeCount > 0 )
	echo "</ul>";

$Result = sqlsrv_query($conn,"select count(*) from doc_item di, storage_list sl where doc_id = ".$DocId." and device_kod = sl.kod and sl.stype is null");

$row =  sqlsrv_fetch_array($Result);
if( $row[0] > 0 )
{
echo "
<p>
<table border='1' cellpadding='5'>
<tr><td colspan='5' align='center'><b>" . SelectWord($Language, "Примірники", "Экземрляры", "Items") . "</b></td></tr>
<tr>
    <td><b>". SelectWord($Language, "Місце збереження", "Место сохранения", "Storage plase") . "</b></td>
    <td><b>". SelectWord($Language, "Інвентарний номер", "Инвентарный номер", "Item number")."</b></td>
	<td><b>". SelectWord($Language, "Номер", "Номер", "Number")."</b></td>
	<td><b>". SelectWord($Language, "Кількість", "Количество", "Quantity")."</b></td>
	<td><b>". SelectWord($Language, "Видано", "Выдано", "Given")."</b></td>
</tr>
";
	$sql = "
		select name, item_no, item_number, qtyall, delivered 
		from doc_item di, storage_list sl 
		where doc_id = ".$DocId." and device_kod = sl.kod and sl.stype is null 
		order by name, item_no, item_number ";

$all_qtyall=0;
$all_delivered=0;
$Result = sqlsrv_query($conn, $sql );
while( $row = sqlsrv_fetch_array($Result) )
{
echo "
<tr><td>".$row['name']."</td>
	<td>".$row['item_no']."&nbsp;</td>
	<td>".$row['item_number']."&nbsp;</td>
	<td>".$row['qtyall']."</td>
	<td>".$row['delivered']."</td>
</tr>";			
		$all_qtyall=$all_qtyall+$row[DBSelectExpression('qtyall')];
		$all_delivered=$all_delivered+$row[DBSelectExpression('delivered')];
}
echo "
<tr><td><b>Загальна кількість</b></td>
	<td colspan='2'><b>".($all_qtyall-$all_delivered)."</b></td>
	<td>".$all_qtyall."</td>
	<td>".$all_delivered."</td>
</tr>";	
echo "
</table>
</p>";
}

function PrintField( $FldName, $FldValue, &$Line )
{
	$FldValue = trim($FldValue);
	if( $FldValue <> "" and !is_null($FldValue) )
	{	if( $Line <> "" and !is_null($Line) )
			$Line .= "&nbsp;";
		$Line .= "<b>".$FldName.":</b>&nbsp;".$FldValue;
	}
}

function PrintLine( &$Line )
{
	if( $Line <> "" and !is_null($Line) )
		$Line .= "<br>";
	echo "$Line\n";
	$Line = "";
}

function SelectWord( $Language = 'ukr' , $Ukr, $Rus, $Eng)
{	
	$Language = 'ukr';
	if ($Language == "ukr") $SelectWord = $Ukr;
	elseif ($Language == "rus" ) $SelectWord = $Rus;
	elseif ($Language == "eng" ) $SelectWord = $Eng;
	else    $SelectWord == "";
	return $SelectWord;
}

function DBSelectExpression($key){$key = strtolower($key);return $key;}




	 ?>







						</div><!-- .entry-content -->
			</div><!-- .inside-article -->
</article>
<script>
jQuery(document).ready(function(){

	console.log('document ready');

})
</script>

<!-- end  my custom code block-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 

do_action('generate_sidebars');
get_footer();