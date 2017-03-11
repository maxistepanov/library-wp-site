<?php
/*
Plugin Name: Library Managment
Description: Description
Plugin URI: http://#
Author: Maxi
Author URI: http://#
Version: 1.0
*/


require __DIR__ . '/functions.php';


    add_action( 'wp_enqueue_scripts', 'hneu_scripts' );

    
// for form question
    add_action('wp_ajax_wp_ajax_questions_query', 'wp_ajax_questions_query');
    

    
    


// for last questions
   // add_action('wp_ajax_last_week_question', 'wp_ajax_last_week_question');

    add_action( 'the_content', 'my_action_javascript' );

    add_action( 'wp_ajax_last_week_question', 'last_week_question' );
    



// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.style.unmin.css');
  wp_enqueue_style('admin-styles-awesome', get_template_directory_uri().'/css/font-awesome-essentials.min.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


  


?>