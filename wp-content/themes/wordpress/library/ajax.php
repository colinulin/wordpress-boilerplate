<?php
/**
 * AJAX Requests File
 *
 */

// example ajax request function
function cu_example_ajax_callback() {
	echo 'success';
	die();
}
add_action( 'wp_ajax_cu_example_ajax', 'cu_example_ajax_callback' );
add_action( 'wp_ajax_nopriv_cu_example_ajax', 'cu_example_ajax_callback' );

