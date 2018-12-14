<?php

/**
 * Setup Theme
 *
 * NOTE: everything is prefixed with "cu_" (ColinUlin) to prevent conflicts.
 */
function cu_setup_theme()
{
    // include template functions
    require_once(TEMPLATEPATH . '/library/admin.php');
    require_once(TEMPLATEPATH . '/library/helpers.php');
    require_once(TEMPLATEPATH . '/library/shortcodes.php');

    // include custom post types
    require_once(TEMPLATEPATH . '/library/cpt/cu_cpt_example.php');

    // include Settings
    require_once(TEMPLATEPATH . '/library/includes/admin/settings.php');
    
    // include navigation functions
    require_once(TEMPLATEPATH . '/library/navigation.php');
    
    // include TinyMCE functions
    require_once(TEMPLATEPATH . '/library/includes/tiny_mce.php');

    // include AJAX file
    require_once(TEMPLATEPATH . '/library/ajax.php');

    // if not the development environment
    // *add the following to wp-config.php if dev env: define('ACF_DEV_ENVIRONMENT', true);
    if ( ! defined('ACF_DEV_ENVIRONMENT'))
    {
        // hide ACF and load exported fields
        define('ACF_LITE', true);
        require_once(TEMPLATEPATH . '/library/includes/advanced_custom_fields_export.php');
    }
    
    // remove emojis support
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // enable custom image support
    require_once(TEMPLATEPATH . '/library/images.php');
}
add_action('after_setup_theme', 'cu_setup_theme');

// flush your rewrite rules for custom post types
function cu_flush_rewrite_rules()
{
	flush_rewrite_rules();
}
add_action('after_switch_theme', 'cu_flush_rewrite_rules');


/**
 * Clean up filenames
 *
 * Only allow letters, numbers, and dashes. Replace multiple 
 * dashes with a single dash, and then remove any at the 
 * beginning or end of the string.
 */
function cu_sanitize_file_name($filename)
{
    $ext = end(explode('.', $filename));
    $str = substr($filename, 0, -(strlen($ext) + 1));
    $str = preg_replace('/[^a-zA-Z0-9-]/', '-', $str);
    $str = preg_replace('/(-)+/', '-', $str);
    $str = preg_replace('/^(-+)/', '', $str);
    $str = preg_replace('/(-+)$/', '', $str);
    $str = (empty($str) ? 'file' . date('m-d-Y') : $str);
    $str = strtolower($str . '.' . $ext);
    return $str;
}
add_filter('sanitize_file_name', 'cu_sanitize_file_name', 10);
    

/**
 * Add Scripts & Style Sheets
 *
 */
function cu_scripts_and_styles()
{
    global $wp_styles;

    if ( ! is_admin())
    {
        $version = '1.00'; // simple cache busting trick
        
        // register main stylesheet
        wp_enqueue_style('cu-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), $version, 'all');
        wp_enqueue_style('cu-fancybox', get_stylesheet_directory_uri() . '/library/css/jquery.fancybox.min.css', array(), $version, 'all');
        
        // ie-only style sheet
        wp_register_style('cu-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '');
        $wp_styles->add_data('cu-ie-only', 'conditional', 'lt IE 9');
        wp_enqueue_style('cu-ie-only');
        
        // enqueue scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('cu-modernizr', get_stylesheet_directory_uri() . '/library/js/modernizr.js', array('jquery'), $version, true);
        wp_enqueue_script('cu-touchswipe', get_stylesheet_directory_uri() . '/library/js/jquery.touchSwipe.min.js', array('jquery'), $version, true);
        wp_enqueue_script('cu-fancybox', get_stylesheet_directory_uri() . '/library/js/jquery.fancybox.min.js', array('jquery'), $version, true);
        wp_enqueue_script('cu-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array('jquery'), $version, true);
    }

    // add javascript variables
    wp_localize_script('cu-js', 'cu_data', array(
        'admin_ajax' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'cu_scripts_and_styles', 999);


/**
 * Enabled $_SESSION
 *
 */
function cu_enabled_session()
{
    if ( ! session_id())
    {
        session_start();
    }
}
add_action('init', 'cu_enabled_session', 100);

