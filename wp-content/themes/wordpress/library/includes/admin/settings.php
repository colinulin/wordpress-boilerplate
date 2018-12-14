<?php

/**
 * SETTINGS PAGE
 *
 */

if( function_exists('acf_add_options_page') ) {
    $parent = acf_add_options_page(array(
    	'page_title' => 'Settings',
    	'menu_title' => 'Config',
    	'menu_slug'  => 'cu-settings',
    	'capability' => 'manage_options',
    	'icon_url'   => 'dashicons-admin-settings',
    	'redirect'   => false
    ));
}