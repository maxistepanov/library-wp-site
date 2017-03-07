<?php
/*
Plugin Name: Library Managment
Description: Description
Plugin URI: http://#
Author: Author
Author URI: http://#
Version: 1.0
*/


require __DIR__ . '/functions.php';


    add_action( 'wp_enqueue_scripts', 'hneu_scripts' );


    add_action('wp_ajax_wp_ajax_hneu_query', 'wp_ajax_hneu_query');
    
    add_action('wp_ajax_nopriv_wp_ajax_hneu_query', 'wp_ajax_hneu_query');

    add_action('wp_ajax_last_week_question', 'wp_ajax_last_week_question');

    add_action( 'the_content', 'my_action_javascript' );

    add_action( 'wp_ajax_last_week_question', 'last_week_question' );
    



  


?>