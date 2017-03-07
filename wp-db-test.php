<meta charset="UTF-8">
<?php
$serverName = "MAXINOTE\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"library","CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);





 



?>
<div class="option-block">
<br>
<form action="" method="post">
	<span>Автор: </span><input name="author_fld" size="35" maxlength="250" style="font-size:9pt" value="<?php echo htmlspecialchars($_POST['author_fld']); ?>">
 <input type="submit"></input>
</form>

</div>

<div id="content-container">
<h2>Умови пошуку</h2>
<p>Автор містить слова, <?php echo htmlspecialchars($_POST['author_fld']); ?></p>
	<ul class="list">
	
			<?php 
							$sql = "SELECT TOP 20 name FROM document WHERE author LIKE '%Анохін%'";
				$stmt = sqlsrv_query( $conn, $sql );
				if( $stmt === false) {
				    die( print_r( sqlsrv_errors(), true) );
				}
				while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			      echo "<br>";
			      foreach ($row as $key => $value) {
			      	echo '	<li class="list-item">'.$value.' </li>';
			      }
			   }
sqlsrv_free_stmt( $stmt);
			 ?>
		
	</ul>
	
</div>


<div>
	

<ul class="list">
	
			<?php 
							 $sql = 
	"select doc_id, doc_type, cipher, author, author_type, name, 
			annot1, annot2, annot3, annot4, 
			publ_place, publisher, publ_year,
			item_qty, item_present,
			udk, isbn, bbk, issn, 
			author_mark, lang, sizem, 
			parent_id, is_parent, device_kod, long_filename, item_qty, filename, cdlabel
	from   document d 
	where  doc_id = 155296";
				$stmt = sqlsrv_query( $conn, $sql );
				if( $stmt === false) {
				    die( print_r( sqlsrv_errors(), true) );
				}
				while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			      echo "<br>";
			      foreach ($row as $key => $value) {
			      	echo '	<li class="list-item">'.$value.' </li>';
			      }
			   }
sqlsrv_free_stmt( $stmt);
			 ?>
		
	</ul>
</div>

