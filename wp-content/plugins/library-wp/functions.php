<?php 


function hneu_scripts() {

    wp_enqueue_script( 'hneu-js', plugins_url( '/js/library-hneu-js.js', __FILE__ ), array( 'jquery' ),null);
    wp_enqueue_script( 'bootstrap', plugins_url( '/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ),null);  
    wp_enqueue_style( 'hneu-css', plugins_url( '/css/library-hneu-css.css', __FILE__ ) );
    wp_enqueue_style( 'bootstrap-theme', plugins_url( '/css/bootstrap-theme.min.css', __FILE__ ) );
    wp_enqueue_style( 'bootstrap-css', plugins_url( '/css/bootstrap.min.css', __FILE__ ) );

    
    wp_localize_script( 'hneu-js', 'hneu', array( 'url' => admin_url( 'admin-ajax.php')));

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
						 <table class="tg" style="undefined;table-layout: fixed; width: 900px">
										 <colgroup>
											 <col style="width: 50px">
											 <col style="width: 200px">
											 <col style="width: 200px">
											 <col style="width: 100px">
											 <col style="width: 300px">
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
					for (var i = obj.length - 1; i >= 0; i--) {
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
				var data = {'action': 'get_all_udk'};

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
					var	table = `
						 <table class="tg" style="undefined;table-layout: fixed; width: 900px">
										 <colgroup>
											 <col style="width: 40px">
											 <col style="width: 80px">
											 <col style="width: 250px">
											 <col style="width: 200px">
										 </colgroup>
									 <tr>
										 <th class="tg-yw4l">№ </th>
										 <th class="tg-yw4l">Дата подачі заяви</th>
										 <th class="tg-yw4l">Автор, назва документа</th>
										 <th class="tg-yw4l">Індекс УДК</th>
									</tr>
									<tr>

					`;
					for (var i = obj.length - 1; i >= 0; i--) {
						table+="<tr>"
			  		table+= '<td class="tg-yw4l">' + obj[i].id +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].date_udk +'</td>';
				    table+='<td class="tg-yw4l">' + obj[i].fio +' ,' +obj[i].name+ '</td>';
				    table+='<td class="tg-yw4l">' + obj[i].answer_kod+'</td>';
				    table+="</tr>"
					}
					
					$('.list-udk').html(table);
				/*	$('.list-udk').html(response);*/
					$('.other-way').html(`
						<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Оновити" />
						<br>
						<a id="question-last-week" href="/add-udk/"> Подати новий запит</a>
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
	function wp_ajax_save_answear_by_id() {
		 $num = $_POST['num'];
		 $answear = $_POST['answear'];
		 echo 0;
		 echo $answear;
		//access to the database
		global $wpdb; 
		$myrows = $wpdb->get_results( "UPDATE library_question SET answear = '". $answear ."' where id = '". $num ."'");
		
		/*$myrows = $wpdb->get_results( "SELECT * FROM library_question");*/
		echo json_encode($myrows);
			
			   
			

		wp_die(); 
}

add_action( 'wp_ajax_wp_ajax_save_answear_by_id', 'wp_ajax_save_answear_by_id' );

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
    add_menu_page('Управление библиотекой ', 'Управление библиотекой', 8, __FILE__, 'lib_toplevel_page');

    // Add a submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Управление УДК', 'Управление УДК', 8, 'sub-page', 'lib_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Ответы на вопросы', 'Ответы на вопросы', 8, 'sub-page2', 'lib_sublevel_page2');
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
    echo "<h2>Хээй Test Toplevel</h2>";

}

// lib_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function lib_sublevel_page() {
    echo "<h2>Управление УДК</h2>";
  echo '<div>
			<button>Запросы без ответа</button>
  		</div>

		
  		';





}

// lib_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function lib_sublevel_page2() {
   print '  <h2>Управление вопросами</h2>

		<div>
			<button>Вопросы без ответа</button>
			<br>
			<br>
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
            <label for="user-fio" class="control-label">ФИО:</label>
            <p id="user-fio"></p> 
          </div>
           <div class="form-group">
            <label for="user-question" class="control-label">Вопрос:</label>
           <p id="question-text"></p> 
          </div>
          <div class="form-group">
            <label for="answear-text" class="control-label">Ответ:</label>
           <p id="answear-text"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрить</button>
       <br> <br>
        <button type="button" class="btn btn-danger success-delete" >Удалить</button>
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
            <label for="user-fio" class="control-label">ФИО:</label>
            <p id="user-fio"></p> 
          </div>
           <div class="form-group">
            <label for="user-question" class="control-label">Вопрос:</label>
           <p id="question-text"></p> 
          </div>
          <div class="form-group">
            <label for="answear-text" class="control-label">Ответ:</label>
           <textarea name="" id="answear-text" cols="30" rows="10"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрить</button>
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
  
    	global $wpdb; 
		$myrows = $wpdb->get_results( "SELECT * FROM library_question" );
			echo '<table class="tg" style="undefined;table-layout: fixed; width: 850px">';
				echo '<colgroup>';
					echo '<col style="width: 50px">';
					echo '<col style="width: 200px">';
					echo '<col style="width: 200px">';
					echo '<col style="width: 100px">';
					echo '<col style="width: 300px">';
					echo '<col style="width: 130px">';
				echo '</colgroup>';
			echo '<tr>';
				echo '<th class="tg-yw4l">№ </th>';
				echo '<th class="tg-yw4l">ПІБ</th>';
				echo '<th class="tg-yw4l">ПИТАННЯ</th>';
				echo '<th class="tg-yw4l">ДАТА</th>';
				echo '<th class="tg-yw4l">ВІДПОВІДЬ</th>';
				echo '<th class="tg-yw4l"></th>';
			echo "</tr>"; 
			  foreach ( $myrows as $page ){
			  		echo "<tr>";
			  		echo '<td class="tg-yw4l">'. $page->id .'</td>';
				    echo '<td class="tg-yw4l">'. $page->fio .'</td>';
				    echo '<td class="tg-yw4l">'. $page->question .'</td>';
				    echo '<td class="tg-yw4l">'. $page->date_question .'</td>';
				    echo '<td class="tg-yw4l">'. $page->answear.'</td>';
				    echo '<td class="tg-yw4l">
								
								<div class="btn-group btn-group-xs">
					  <button  type="button"  class="btn btn-info btn-edit"   data-target="#editQuestionForm" data-id="'.$page->id.'">Редактировать</button>
					  <br>
					  <button  type="button"  class="btn btn-danger btn-del"   data-target="#deleteQuestionForm" data-id="'.$page->id.'">Удалить</button>

					
								</div>
				    	  </td>';
				    echo "</tr> ";
			}

	









}




/*========= END MENU =========*/


 /*=== END ===*/

 ?>
