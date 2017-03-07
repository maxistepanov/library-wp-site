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
    function wp_ajax_hneu_query(){
        $name = $_POST['dname'];
        $question = $_POST['dquestion'];
        //$today = date("d/m/y"); 
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



	
 // response after insert

function my_action_javascript($content) { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {

		var data = {
			'action': 'last_week_question'
		};

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
					$('.list-question').html(response);
					$('.other-way').html(`
						<input style="margin:10px;" id="update" onClick="window.location.reload()" name="update" type="button" value="Оновити" />
						<br>
						<a id="question-last-week" href="/?page_id=110">Задати нове питання</a>
						`);

		 		},
		 		error: function(){
		 			alert("last week error");
		 		}
		 	});

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
			echo '<table class="tg" style="undefined;table-layout: fixed; width: 758px">';
				echo '<colgroup>';
					echo '<col style="width: 50px">';
					echo '<col style="width: 200px">';
					echo '<col style="width: 200px">';
					echo '<col style="width: 100px">';
					echo '<col style="width: 300px">';
				echo '</colgroup>';
			echo '<tr>';
				echo '<th class="tg-yw4l">№ </th>';
				echo '<th class="tg-yw4l">ПІБ</th>';
				echo '<th class="tg-yw4l">ПИТАННЯ</th>';
				echo '<th class="tg-yw4l">ДАТА</th>';
				echo '<th class="tg-yw4l">ВІДПОВІДЬ</th>';
			echo "</tr>"; 
			  foreach ( $myrows as $page ){
			  		echo "<tr>";
			  		echo '<td class="tg-yw4l">'. $page->id .'</td>';
				    echo '<td class="tg-yw4l">'. $page->fio .'</td>';
				    echo '<td class="tg-yw4l">'. $page->question .'</td>';
				    echo '<td class="tg-yw4l">'. $page->date_question .'</td>';
				    echo '<td class="tg-yw4l">'. $page->answer .'</td>';
				    echo "</tr>";
			}
			echo "</ul>";
			   
			

		wp_die(); 
}








    
 ?>
