<?php 


function hneu_scripts() {
 wp_enqueue_script( 'easy-auto-js', plugins_url( '/EasyAutocomplete/jquery.easy-autocomplete.js', __FILE__ ), array( 'jquery' ),null);  

    wp_enqueue_style( 'easy-auto', plugins_url( '/EasyAutocomplete/easy-autocomplete.min.css', __FILE__ ) );
      wp_enqueue_style( 'easy-auto-theme', plugins_url( '/EasyAutocomplete/easy-autocomplete.themes.min.css', __FILE__ ) );

    wp_enqueue_script( 'hneu-js', plugins_url( '/js/library-hneu-js.js', __FILE__ ), array( 'jquery' ),null);
    wp_enqueue_script( 'bootstrap', plugins_url( '/bootstrap4/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ),null);  
    wp_enqueue_style( 'hneu-css', plugins_url( '/css/library-hneu-css.css', __FILE__ ) );
    wp_enqueue_style( 'bootstrap-theme', plugins_url( '/bootstrap4/css/bootstrap-reboot.min.css', __FILE__ ) );
    wp_enqueue_style( 'bootstrap-css', plugins_url( '/bootstrap4/css/bootstrap.min.css', __FILE__ ) );
        wp_enqueue_style( 'bootstrap-grid', plugins_url( '/bootstrap4/css/bootstrap-grid.min.css', __FILE__ ) );

   wp_enqueue_script( 'bootstrap-datepicker', plugins_url( '/bootstrap-datepicker/js/bootstrap-datepicker.min.js', __FILE__ ), array( 'jquery' ),null);  
     wp_enqueue_style( 'bootstrap-datepicker-css', plugins_url( '/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css', __FILE__ ) );

 wp_enqueue_script( 'bootstrap-datepicker-uk', plugins_url( '/bootstrap-datepicker/locales/bootstrap-datepicker.uk.min.js', __FILE__ ), array( 'jquery' ),null);  


    
    
    wp_localize_script( 'hneu-js', 'hneu', array( 'url' => admin_url( 'admin-ajax.php')));

    }

  include 'bdconnectionconfig.php';
// function get_connection()
// {
// 	// $serverName = "DESKTOP-IJOBITJ\SQLEXPRESS"; 
// 	// $connectionInfo = array( "Database"=>"library", "CharacterSet" => "UTF-8");
// 	// $conn = sqlsrv_connect( $serverName, $connectionInfo);

	
// // $serverName = "10.2.81.252";
// // $connectionInfo = array( "Database"=>"library",'UID'=>'Chitatel', 'PWD'=>'katalog', "CharacterSet" => "UTF-8");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);
	
// 	return $conn;
// }
 
function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    return $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    return $y;
  }
}
// Insert date to db
    function wp_ajax_questions_query(){
        $name = $_POST['dname'];
        $question = $_POST['dquestion'];
        //$today = date("d/m/y"); 
        echo $name;
        global $wpdb;
        $wpdb->insert( 
            'library_question', 
            array( 
                'fio' => $name,
                'question' => $question,
                'check_answer' => 0,
                'date_question' => current_time('mysql', 1)
            ), 
            array( 
                '%s',
                '%s',
                '%d',
                '%s'
            ) 
        );

       
		

		die();
		return true;
	}


	
 // request last questions 
//
function my_action_javascript($content) { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
		if($("div").is(".list-question")){ 
				var data = {'action': 'last_week_question'};

				jQuery.ajax({
		 		type: 'POST',
		 		url: hneu.url, 
		 		data,
		 		beforeSend: function(){
					jQuery("#wrapper-question").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();
					});
				},
		 		success: function(response){
		 			jQuery("#cssload-pgloading").fadeOut(300);
		 			jQuery("#wrapper-question").fadeIn();
					//alert('Got this from the server: ' + response);

						var obj = jQuery.parseJSON(response);
					var	table = `
						 <table class="tg table table-striped" style="undefined;table-layout: fixed; width: 100%">
										 <colgroup>
											 <col style="width: 5%">
											 <col style="width: 15%">
											 <col style="width: 20%">
											 <col style="width: 20%">
											 <col style="width: 20%">
										 </colgroup>
									 <tr>
										 <th class="tg-yw4l">№ </th>
										 <th class="tg-yw4l">ПІБ</th>
										 <th class="tg-yw4l">Питання</th>
										 <th class="tg-yw4l">Дата</th>
										 <th class="tg-yw4l">ВІДПОВІДЬ</th>
									</tr>
									<tr>

					`;
					for (var i = 0; i < obj.length ; i++) {
						table+="<tr>"
			  		table+= '<td class="tg-yw4l">' + obj[i].id +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].fio +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].question + '</td>';
				    table+='<td class="tg-yw4l">' + obj[i].date_question+'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].answear+'</td>';

				    table+="</tr>"
					}
					

					$('.list-question').html(table);
				
					$('.other-way').html(`
						<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Оновити" />
						<br>
						<a id="question-last-week" href="/new_question/">Задати нове питання</a>
						`);

		 		},
		 		error: function(){
		 			alert("last week error");
		 		}
		 	});


		}
	});
	

	</script> 
	<?php
	return $content;
}



	
// response with result
	function last_week_question() {
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_question WHERE YEAR(`date_question`) = YEAR(NOW()) AND WEEK(`date_question`, 1) = WEEK(NOW(), 1)" );
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}


// Insert date to db
    function wp_ajax_udk_query(){
    	 $fio = $_POST['dfio'];
         $kod = $_POST['dkod'];
         $name = $_POST['dname'];
         $notat = $_POST['dnotat'];
         $blogtime = current_time( 'mysql' ); 
        global $wpdb;
        $wpdb->insert( 
            'library_udk', 
            array( 
                'fio' => $fio,
                'name' => $name,
                'notat' => $notat,
                'kod' => $kod,
                'date_udk' => $blogtime
            ), 
            array( 
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            ) 
        );
  
		
       
		die();
		return true;
	}


// for udk form
    add_action('wp_ajax_wp_ajax_udk_query', 'wp_ajax_udk_query');




// request all udk
//
function action_get_udk($content) { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
		
		if($("div").is(".list-udk")){ 
			 
				var _this = $(this);
				var per_page = 10;
				var data = {
				'action': 'get_udk_by_page',
				'page' : '1',
				'per_page': per_page
			};

				jQuery.ajax({
		 		type: 'POST',
		 		url: hneu.url, 
		 		data,
		 		beforeSend: function(){
					jQuery("#wrapper-udk").fadeOut(300, function(){
						jQuery("#cssload-pgloading").fadeIn();
					});
				},
		 		success: function(response){
		 			jQuery("#cssload-pgloading").fadeOut(300);
		 			jQuery("#wrapper-udk").fadeIn();
					//alert('Got this from the server: ' + response);
					var obj = jQuery.parseJSON(response);
					console.log(obj);
					var	table = `
						 <table class="tg table table-striped" style="undefined;table-layout: fixed; width: 100%">
										 <colgroup>
											 <col style="width: 5%">
											 <col style="width: 15%">
											 <col style="width: 250px">
											 <col style="width: 200px">
										 </colgroup>
									 <tr>
										 <th class="tg-yw4l">№ </th>
										 <th class="tg-yw4l">Дата</th>
										 <th class="tg-yw4l">Автор, назва документа</th>
										 <th class="tg-yw4l">Індекс УДК</th>
									</tr>
									<tr>

					`;
					for (var i = 0 ; i < obj.length-1; i++) {
						table+="<tr>"
			  		table+= '<td class="tg-yw4l">' + obj[i].id +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].date_udk +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].fio +' ,' +obj[i].name+ '</td>';
				    table+='<td class="tg-yw4l">' + obj[i].answear_kod+'</td>';
				    table+="</tr>"
					}
					
					jQuery('.list-udk').html(table);
				/*	$('.list-udk').html(response);*/
					jQuery('.other-way').html(`
						<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Оновити" />
						<br>
						<a id="question-last-week" href="/add-udk/"> Подати новий запит</a>
						`);
					$total_rows = obj[obj.length-1].count;
					console.log(obj['count']);
					$per_page = 10;
					$num_pages = Math.ceil( $total_rows / $per_page );
					$page_list = ' ';
					
					$page_list+='<ul class="pagination">';
					for( $i = 1; $i <= $num_pages; $i++) {
  						$page_list+= '<li class="page-item"><a class="page-link btn-page-udk" href="'+ $i 	+'" data-page="' + $i +'">' + $i  +'</a></li> \n';
  					}
  					$page_list+='</ul>';
					jQuery('.pagination-wrapper').html($page_list);




		 		

		 		},
		 		error: function(){
		 			alert("last week error");
		 		}
		 	});

				


		}


	});
	

	</script> 
	<?php
	return $content;
}




// response with result
	function get_all_udk() {
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_udk" );
		

		echo json_encode($myrows);
		
		
	
		wp_die(); 
}

// action for WP

  add_action( 'the_content', 'action_get_udk' );

    add_action( 'wp_ajax_get_all_udk', 'get_all_udk' );
    

	function get_udk_by_page() {
		//access to the database
				//получаем номер страницы и значение для лимита 
		$cur_page = 1;
		$per_page = 20;
		if (isset($_POST["page"]) && !empty($_POST["page"])) {
			$cur_page = $_POST["page"]; }
		if (isset($_POST["per_page"]) && !empty($_POST["per_page"])) {
			$per_page = $_POST["per_page"]; }
		
		
		
		$start = ($cur_page - 1) * $per_page;

		global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_udk LIMIT $start, $per_page"  );
/*		echo json_encode($myrows);
*/		$count = $wpdb->get_results( "SELECT COUNT(library_udk.id) as count FROM library_udk" );
/*		echo json_encode($count);
*/		$res = array_merge($myrows,$count);
		echo json_encode($res);
	
		wp_die(); 
}

add_action( 'wp_ajax_get_udk_by_page', 'get_udk_by_page' );

	function get_count_udk() {
		//access to the database
		
		
		global $wpdb; 
		$count = $wpdb->get_results( "SELECT COUNT(library_udk.id) as count FROM library_udk" );
		echo json_encode($count);
	
		wp_die(); 
}

add_action( 'wp_ajax_get_count_udk', 'get_count_udk' );

// response with result
	function wp_ajax_get_question_by_id() {
		 $num = $_POST['num'];
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_question WHERE id =". $num);
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_get_question_by_id', 'wp_ajax_get_question_by_id' );


// response with result
	function wp_ajax_get_udk_by_id() {
		 if (isset($_POST['num'])) $num = $_POST['num'];
		 
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_udk WHERE id = " . $num);
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_get_udk_by_id', 'wp_ajax_get_udk_by_id' );


	function wp_ajax_get_udk_stat() {

		 
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "SET @@lc_time_names='uk_UA'");
		$myrows = $wpdb->get_results( "SELECT  DATE_FORMAT( `date_udk`, '%M' ) AS 'Місяць' ,COUNT(`date_udk`) as 'Кількість' FROM 	`library_udk` GROUP BY MONTH(`date_udk`)");
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_get_udk_stat', 'wp_ajax_get_udk_stat' );

// response with result
	function wp_ajax_reload_questions() {
		 	global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_question LIMIT 0,20" );
			echo '<table class="tg wp-list-table widefat fixed striped posts">';
			echo '<tr>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-cb check-column sortable desc">№ </th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-primary sortable desc">ПІБ</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-primary sortable desc">ПИТАННЯ</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-date sortable desc">ДАТА</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-primary sortable desc">ВІДПОВІДЬ</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-date sortable desc"></th>';
			echo "</tr>"; 
			  foreach ( $myrows as $page ){
			  		echo "<tr>";
			  		echo '<td style="text-align: center;" class="title column-title has-row-actions column-cb check-column">'. $page->id .'</td>';
				    echo '<td class="title column-title has-row-actions column-primary page-title">'. $page->fio .'</td>';
				    echo '<td class="title column-title has-row-actions column-primary page-title">'. custom_echo($page->question,100) .'</td>';
				    echo '<td class="title column-title has-row-actions column-date page-title">'. $page->date_question .'</td>';
				    echo '<td class="title column-title has-row-actions column-primary page-title">'. custom_echo($page->answear,250) .'</td>';
				    echo '<td class="title column-title has-row-actions column-date page-title">
								
								<div class="btn-block btn-group-xs">
					  <button   type="button"  class="btn btn-info btn-edit btn-block"   data-target="#editQuestionForm" data-id="'.$page->id.'">Редагувати</button>
					  
					  <button  type="button"  class="btn btn-danger btn-del btn-block"   data-target="#deleteQuestionForm" data-id="'.$page->id.'">Видалити</button>

					
								</div>
				    	  </td>';
				    echo "</tr> ";
			}
			
			   
			

		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_reload_questions', 'wp_ajax_reload_questions' );

// response with result
	function wp_ajax_reload_udk() {
		 	global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_udk LIMIT 0,5" );
			echo '<table class="tg wp-list-table widefat fixed striped posts">';
				
			echo '<tr>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-cb check-column sortable desc">№ </th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-date  sortable desc">Дата запиту</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-primary sortable desc">ПІБ та назва</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-primary sortable desc">Анотація</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-primary sortable desc">Відповідь</th>';
				echo '<th scope="col" style="text-align: center" id="title" class=" manage-column column-title column-date sortable desc">Керування</th>';
			echo "</tr>"; 
			  foreach ( $myrows as $page ){
			  		echo "<tr>";
			  		echo '<td class="title column-title has-row-actions column-cb check-column" style="text-align: center">'. $page->id .'</td>';
			  		echo '<td class="title column-title has-row-actions column-date page-title">'. $page->date_udk .'</td>';
				    echo '<td class="title column-title has-row-actions column-primary page-title">'. $page->fio .', '.$page->name .'</td>';
				    echo '<td class="title column-title has-row-actions column-primary page-title">'. custom_echo($page->notat,100) .'</td>';
				    echo '<td class="title column-title has-row-actions column-primary page-title">'. $page->answear_kod.'</td>';
				    echo '<td class="title column-title has-row-actions column-primary page-title">
								
								<div class="btn-block btn-group-xs">
					  <button  type="button"  class="btn btn-info btn-edit-udk btn-block"   data-target="#editUdkForm" data-id="'.$page->id.'">Редагувати</button>
					  <button  type="button"  class="btn btn-danger btn-del-udk btn-block"   data-target="#deleteUdkForm" data-id="'.$page->id.'">Видалити</button>

					
								</div>
				    	  </td>';
				    echo "</tr> ";
	    
			}
			 echo wp_ajax_get_pagintaion($start = 1, $end = 1);
}

add_action( 'wp_ajax_wp_ajax_reload_udk', 'wp_ajax_reload_udk' );


function wp_ajax_get_pagintaion($start, $end){

		 return  '<nav aria-label="Page navigation example">
  <ul class="pagination">

    <li class="page-item">
 		<a class="page-link btn-page-udk" href="1" data-page="1">1</a>
    </li>
    <li class="page-item">
 		<a class="page-link btn-page-udk" href="2" data-page="2">2</a>
    </li>
    <li class="page-item">
 		<a class="page-link btn-page-udk" href="3" data-page="3">3</a>
    </li>

  </ul>
</nav>';
}

add_action( 'wp_ajax_wp_ajax_get_pagintaion', 'wp_ajax_get_pagintaion');

// response with result
	function wp_ajax_delete_question_by_id() {
		 $num = $_POST['num'];
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "DELETE  FROM library_question WHERE id =". $num);
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}
add_action( 'wp_ajax_wp_ajax_delete_question_by_id', 'wp_ajax_delete_question_by_id' );


// response with result
	function wp_ajax_delete_udk_by_id() {
		 $num = $_POST['num'];
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "DELETE  FROM library_udk WHERE id =". $num);
		echo "ok delete udk";
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}
add_action( 'wp_ajax_wp_ajax_delete_udk_by_id', 'wp_ajax_delete_udk_by_id' );

// response with result
	function wp_ajax_save_answear_by_id() {
		 $num = $_POST['num'];
		 $answear = $_POST['answear'];
		 
		 $blogtime = current_time( 'mysql' ); 
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "UPDATE library_question SET answear = '". $answear ."' , check_answer = '". $blogtime ."' where id = '". $num ."'");
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_save_answear_by_id', 'wp_ajax_save_answear_by_id' );


// response with result
	function wp_ajax_get_search_result() {
		$dt = $_POST['data'];
		$current_page = $_POST['current_page'] ? $_POST['current_page']: 1;
		parse_str($dt, $get_array);
		global $wpdb; 
			$per_page = $get_array['per_page'];
			$obj->per_page = $per_page;
			$obj->current_page = $current_page;
$conn = get_connection();
if( $conn ) {

  $sql2 = "DECLARE @PageSize INT,
        @Page INT

SELECT  @PageSize = ". $per_page .",
        @Page = ". $current_page ."

;WITH PageNumbers AS(
		SELECT 
		ROW_NUMBER() OVER(order by [document].[name]) row_id,
  		total_count = COUNT(*) OVER(),
  	   [doc_type]
      ,[document].[name]
      ,[device_kod]
      ,[in_date]
      ,[attr]
      ,[document].[doc_id]
      ,[filename]
      ,[author_type]
      ,[udk]
      ,[isbn]
      ,[bbk]
      ,[author_mark]
      ,[issn]
      ,[lang]
      ,[lang_kod]
      ,[document].[cipher]
      ,[status]
      ,[is_parent]
      ,[type_kod]
      ,[name_prefix]
      ,[long_filename]
      ,[parent_type]
      ,[author]
      ,[sizem]
      ,[publ_year]
      ,[publisher]
      ,[col008]
      ,[col009]
      ,[col018]
  FROM [library].[dbo].[document]
  INNER JOIN [library].[dbo].[docxfield_value] ON [library].[dbo].[document].[doc_id] = [library].[dbo].[docxfield_value].[doc_id]
  WHERE author like '%". $get_array['author'] ."%' 
  			and name like '%". $get_array['namedoc'] ."%'
  			" ;
  		/*  */
$date = "and publ_year >= '". $get_array['dateFrom'] ."' and publ_year <= '". $get_array['dateTo'] ."'";
$el_copy = " and  long_filename IS NOT NULL and long_filename !=''";
$lang = " and lang_kod = '" . $get_array['lang'] . "'";
$doc_type = " and doc_type  = '" . $get_array['doctype'] . "'"; 
$discipline = " and '". $get_array['discipline'] ."' in (select dscp_id from [library].[dbo].[doc_dscp] where doc_id = document.doc_id)"; 

if ($get_array['dateFrom']!=null) $sql2.=$date;
if ($get_array['el_copy']!=null) $sql2.=$el_copy;
if ($get_array['lang']!=0) $sql2.=$lang;
if ($get_array['doctype']!=0) $sql2.=$doc_type;
if ($get_array['discipline']!=0) $sql2.=$discipline;

$sql2.= ")
SELECT  *
FROM    PageNumbers
WHERE   row_id  BETWEEN ((@Page - 1) * @PageSize + 1)
AND (@Page * @PageSize)";
	$stmt = sqlsrv_query( $conn, $sql2 );

	if( $stmt === false) {
	    echo [];
	}
	else {	
		$res_arr_values = array();
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
			array_push($res_arr_values, $row);
			$obj->total = $row['total_count'];
		}

		$obj->data = $res_arr_values;
		echo json_encode($obj);
	}

	
		

 	


}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
     echo sqlsrv_errors();
}
	
		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_get_search_result', 'wp_ajax_get_search_result' );
add_action( 'wp_ajax_nopriv_wp_ajax_get_search_result', 'wp_ajax_get_search_result' );
/*

*/

// response with result
	function wp_ajax_get_title() {
		$dt = $_POST['phrase'];
$conn = get_connection();

if( $conn ) {
    /* echo "Connection established.<br />";*/

  $sql2 = "SELECT TOP 10 [document].[name], author
  FROM [library].[dbo].[document]
  WHERE name like '%". $dt ."%' 
  order by name" ;


  			
	$stmt = sqlsrv_query( $conn, $sql2 );
	if( $stmt === false) {
	    echo sqlsrv_errors();
	    echo "error";
	}
	$res_arr_values = array();
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
		array_push($res_arr_values, $row);
	}
	echo json_encode($res_arr_values);

}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
     echo sqlsrv_errors();
}
	
		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_get_title', 'wp_ajax_get_title' );
add_action( 'wp_ajax_nopriv_wp_ajax_get_title', 'wp_ajax_get_title' );

// response with result
	function wp_ajax_get_author() {
		$dt = $_POST['phrase'];
$conn = get_connection();

if( $conn ) {
    /* echo "Connection established.<br />";*/

  $sql2 = "SELECT TOP 10 [document].[author]
  FROM [library].[dbo].[document]
  WHERE author like '%". $dt ."%' 
  group by author
  order by author
  " ;



  			
	$stmt = sqlsrv_query( $conn, $sql2 );
	if( $stmt === false) {
	    echo sqlsrv_errors();
	    echo "error";
	}
	$res_arr_values = array();
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
		array_push($res_arr_values, $row);
	}
	echo json_encode($res_arr_values);

}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
     echo sqlsrv_errors();
}
	
		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_get_author', 'wp_ajax_get_author' );
add_action( 'wp_ajax_nopriv_wp_ajax_get_author', 'wp_ajax_get_author' );

// response with result
	function wp_ajax_save_udk_by_id() {
		 $num = $_POST['num'];
		 $answear = $_POST['answear'];
	 $blogtime = current_time( 'mysql' ); 
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "UPDATE library_udk SET answear_kod = '". $answear ."' , date_answear = '". $blogtime . "' where id = '". $num ."'");

$to = 'pop@mailforspam.com';
$subject = 'The subject';
$body = 'The email body content';
$headers = array('Content-Type: text/html; charset=UTF-8');
 
wp_mail( $to, $subject, $body, $headers );
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_save_udk_by_id', 'wp_ajax_save_udk_by_id' );

/*====== MENU ======*/

// Hook for adding admin menus
add_action('admin_menu', 'lib_add_pages');

// action function for above hook
function lib_add_pages() {
    // Add a new submenu under Options:
    //add_options_page('Test Options', 'Test Options', 8, 'testoptions', 'lib_options_page');

    // Add a new submenu under Manage:
    //add_management_page('Test Manage', 'Test Manage', 8, 'testmanage', 'lib_manage_page');

    // Add a new top-level menu (ill-advised):
    add_menu_page('Керування бібліотекою', 'Керування бібліотекою', 8, __FILE__, 'lib_toplevel_page');

    // Add a submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Керування УДК', 'Керування УДК', 8, 'sub-page', 'lib_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Відповіді на питання', 'Відповіді на питання', 8, 'sub-page2', 'lib_sublevel_page2');
    // Add a second submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Статистика УДК', 'Статистика УДК', 8, 'sub-page3', 'lib_sublevel_page3');
}

// lib_options_page() displays the page content for the Test Options submenu
/*function lib_options_page() {
    echo "<h2>Test Options</h2>";
}

// lib_manage_page() displays the page content for the Test Manage submenu
function lib_manage_page() {
    echo "<h2>Test Manage</h2>";
}*/

// lib_toplevel_page() displays the page content for the custom Test Toplevel menu
function lib_toplevel_page() {
    echo "<h2>Управління електронними послугами</h2>";

}

// lib_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function lib_sublevel_page() {
    echo "<h2 style=\"margin:20px;\">Управління УДК</h2>";
  echo '<div>
			<button type="button" class="btn btn-primary">Запити без відповіді</button>
  		</div>
<!-- delete modal -->
 			<div class="modal fade" id="deleteUdkForm" tabindex="-1"  aria-labelledby="deleteLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="udk-fio" class="control-label">ПІБ:</label>
            <p id="udk-fio"></p> 
          </div>
           <div class="form-group">
            <label for="udk-name" class="control-label">Питання:</label>
           <p id="udk-name"></p> 
          </div>
          <div class="form-group">
            <label for="udk-answear_udk" class="control-label">Відповідь:</label>
           <p id="udk-answear_udk"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
        <button type="button" class="btn btn-danger success-delete-udk" >Видалити</button>
      </div>
    </div>
  </div>
  </div>
  <!-- end delete modal -->


  <!-- edit udk modal -->
 			<div class="modal fade" id="editUdkForm" tabindex="-1"  aria-labelledby="deleteLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
			<div class="form-group col-md-8">
            <label for="udk-fio" class="control-label">ПІБ:</label>
            <p id="udk-fio"></p> 
          </div>
          <div class="form-group col-md-4" >
            <label for="udk-date" class="control-label">Дата запиту:</label>
            <p id="udk-date"></p> 
          </div>
          </div>
           <div class="form-group">
            <label for="udk-name" class="control-label">Назва документу:</label>
           <p id="udk-name"></p> 
          </div>
          
           <div class="form-group">
            <label for="udk-notat" class="control-label">Анотація:</label>
           <p id="udk-notat"></p> 
          </div>
          <div class="form-group">
            <label for="udk-answear_udk" class="control-label">Відповідь:</label>
           <textarea name="" id="udk-answear_udk" cols="30" rows="10"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
        <button type="button" class="btn btn-success success-save-udk" >Зберігти</button>
      </div>
    </div>
  </div>
  </div>
  <!-- end edit udk modal -->
		

  		';

  		wp_ajax_reload_udk();
  		





}

// lib_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function lib_sublevel_page2() {
   print '  <h2 style="margin: 20px;">Керування питаннями</h2>

		<div>
			<button type="button" class="btn btn-primary">Питання без відповіді</button>

  		</div>
<!-- delete modal -->
 			<div class="modal fade" id="deleteQuestionForm" tabindex="-1"  aria-labelledby="deleteLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="user-fio" class="control-label">ПІБ:</label>
            <p id="user-fio"></p> 
          </div>
           <div class="form-group">
            <label for="user-question" class="control-label">Питання:</label>
           <p id="question-text"></p> 
          </div>
          <div class="form-group">
            <label for="answear-text" class="control-label">Відповідь:</label>
           <p id="answear-text"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
        <button type="button" class="btn btn-danger success-delete" >Видалити</button>
      </div>
    </div>
  </div>
  </div>
  <!-- end delete modal -->
<!--  edit modal -->
<div class="modal fade" id="editQuestionForm" tabindex="-1"  aria-labelledby="editLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="user-fio" class="control-label">ПІБ:</label>
            <p id="user-fio"></p> 
          </div>
           <div class="form-group">
            <label for="user-question" class="control-label">Питання:</label>
           <p id="question-text"></p> 
          </div>
          <div class="form-group">
            <label for="answear-text" class="control-label">Ответ:</label>
           <textarea name="" id="answear-text" cols="30" rows="10"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
        <button type="button" class="btn btn-success success-save" data-id >Сохранить</button>
      </div>
    </div>
  </div>
  </div>
 <!-- end edit modal -->
 <!-- loader -->
<div id="cssload-pgloading" ">
	<div class="cssload-loadingwrap">
		<ul class="cssload-bokeh" style="top:220px;">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>
<!-- end loader -->
';
  
   
wp_ajax_reload_questions();
	


}
function lib_sublevel_page3() {
	echo "<h2 style=\"padding:20px;\">Статистика запитів УДК</h2>";
	print '  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		
       <div id="columnchart_material" style="width: 800px; height: 500px;"></div>';
}

remove_action('authenticate', 'wp_authenticate_username_password', 20);
add_filter('authenticate', 'decrypt_and_authenticate', 10, 3);

function decrypt_and_authenticate($user, $username, $password) {
    // firs check if password needs to be decrypted
    if ($_REQUEST['encryption_code']) {

        // Obtenemos la clave DES usando nuestra clave privada RSA
        $key = new RSA(get_option('le_rsa_modulus'), get_option('le_rsa_public_key'), get_option('le_rsa_private_key'));
        $code = $key->decrypt($_REQUEST['encryption_code']); 

        // Obtenemos la clave usando la clave DES
        $pass = des ($code, hexToString($password), 0, 0, null, null);
        preg_match("/^([\s\w]*)/", $pass, $res);
        $password = $res[1];
        $_REQUEST['encryption_code'] = "";
    }

    if ( is_a($user, 'WP_User') ) { return $user; }

    if ( empty($username) || empty($password) ) {
        $error = new WP_Error();

        if ( empty($username) )
            $error->add('empty_username', __('<strong>ERROR</strong>: The username field is empty.'));

        if ( empty($password) )
            $error->add('empty_password', __('<strong>ERROR</strong>: The password field is empty.'));

        return $error;
    }


/*Insert new user*/

$conn = get_connection();

if( $conn ) {
    /* echo "Connection established.<br />";*/


     
  $sql = "SELECT code , name FROM physical_person  where code = " . $password . " and name = '". $username . "'";
	$stmt = sqlsrv_query( $conn, $sql );
	if( $stmt === false) {
	    die( print_r( sqlsrv_errors(), true) );
	}

	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
 if (!is_null($row)){
 		
 		/*echo str2url($row['name']);*/
 		// Данные переданные в $_POST
	$userdata = array(
		'user_login' => str2url($username),
		'user_pass'  => $password,
		'user_email' => 'mailforspam.com',
		'first_name' => $username,
		'nickname'   => $username,
	);
		

	/**
	 * Проверять/очищать передаваемые поля не обязательно, 
	 * WP сделает это сам.
	 */

	$user_id = wp_insert_user( $userdata ) ;
	$username = $userdata['user_login'];
	

 	}


}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}




/*End*/



    $user = get_user_by('login', $username);

    if ( !$user )
        return new WP_Error( 'invalid_username', sprintf( __( '<strong>ERROR</strong>: Invalid username. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url() ) );

    if ( is_multisite() ) {
        // Is user marked as spam?
        if ( 1 == $user->spam )
            return new WP_Error( 'spammer_account', __( '<strong>ERROR</strong>: Your account has been marked as a spammer.' ) );

        // Is a user's blog marked as spam?
        if ( !is_super_admin( $user->ID ) && isset( $user->primary_blog ) ) {
            $details = get_blog_details( $user->primary_blog );
            if ( is_object( $details ) && $details->spam == 1 )
                return new WP_Error( 'blog_suspended', __( 'Site Suspended.' ) );
        }
    }

    $user = apply_filters('wp_authenticate_user', $user, $password);
    if ( is_wp_error($user) )
        return $user;

    if ( !wp_check_password($password, $user->user_pass, $user->ID) )
        return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong>  is incorrect. <a href="%2$s" title="Password Lost and Found">Lost your password</a>?' ),
        $username, wp_lostpassword_url() ) );

    return $user;
}

function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        'і' => 'i',	  'І' => 'I',	'є' => 'ye',
        'Э' => 'YE',   'ї' => 'ii', 'Ї' => 'ii',
    );
    return strtr($string, $converter);
}
function str2url($str) {
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}


/*========= END MENU =========*/


 /*=== END ===*/
add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');
 ?>
