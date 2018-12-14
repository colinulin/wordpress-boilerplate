<?php

/**
 * Remove default dashboard widgets
 *
 */
function cu_disable_dashboard_widgets() {  
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
}  
add_action('wp_dashboard_setup', 'cu_disable_dashboard_widgets');

/**
 * Add Scripts & Style Sheets
 *
 */
function cu_admin_enqueue_scripts_and_styles()
{
    wp_register_script('cu-admin-scripts', get_stylesheet_directory_uri() . '/library/js/admin/scripts.js');
    wp_enqueue_script('cu-admin-scripts');
           
   // add javascript variables
    wp_localize_script('cu-admin-scripts', 'cu_data', array(
        'theme_directory_uri' => get_stylesheet_directory_uri() . '/'
    ));
}
add_action('admin_enqueue_scripts', 'cu_admin_enqueue_scripts_and_styles');


/**
 * Update WP Settings
 *
 */
function cu_update_wp_settings() {
    update_option( 'image_default_align', 'none' );
    update_option( 'image_default_link_type', 'none' );
    update_option( 'image_default_size', 'full' );
}
add_action( 'after_setup_theme', 'cu_update_wp_settings' );


/**
 * Remove Comments
 *
 */
function cu_remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
add_action('init', 'cu_remove_comment_support', 100);


/**
 * Customize Admin Login Page
 *
 */
function cu_login_css()
{
    wp_enqueue_style('cu-login-css', get_template_directory_uri() . '/library/css/login.css', false);
}
add_action('login_enqueue_scripts', 'cu_login_css', 10);

// change the logo link to this sites url
function cu_login_url()
{
    return home_url();
}
add_filter('login_headerurl', 'cu_login_url');

// change the logo alt text to this sites name
function cu_login_title()
{
    return get_option('blogname');
}
add_filter('login_headertitle', 'cu_login_title');


/**
 * Custom Admin fullscreenter
 *
 */
function cu_custom_admin_fullscreenter()
{
    echo 'Built with <a href="https://wordpress.org" target="_blank">Wordpress</a> ';
}
add_filter('admin_fullscreenter_text', 'cu_custom_admin_fullscreenter');


/**
 * Customize the Admin Menu
 *
 */
 
// reorder the menu items
function cu_custom_menu_order()
{
    return array(
        'index.php',                                // Dashboard
        'cu-settings',                              // Site Settings
        'separator1',                               // First separator
        'edit.php?post_type=page',                  // Pages
        'edit.php?post_type=cu_examples',           // Example
        'upload.php',                               // Media
        'separator2',                               // Second separator
        'themes.php',                               // Appearance
        'plugins.php',                              // Plugins
        'users.php',                                // Users
        'tools.php',                                // Tools
        'options-general.php',                      // Settings
        'separator-last',                           // Last separator
    );
}
add_filter('custom_menu_order', 'cu_custom_menu_order');
add_filter('menu_order', 'cu_custom_menu_order');

// remove links from admin menu
function cu_remove_admin_menus()
{
    remove_menu_page('edit.php'); // Posts
    remove_menu_page('edit-comments.php'); // Comments
    remove_submenu_page('options-general.php', 'options-discussion.php'); // Settings > Discussion
}
add_action('admin_menu', 'cu_remove_admin_menus');


/**
 * Customize the Admin Bar
 *
 */
function cu_admin_bar_render()
{
    global $wp_admin_bar;
    
    // remove Updates, Posts & Comments
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('new-post');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wpseo-menu');
    
    // add Menus link
    $wp_admin_bar->add_node(array(
        'id'    => 'menus',
        'title' => 'Menus',
        'href'  => '/wp-admin/nav-menus.php'
    ));
}
add_action('wp_before_admin_bar_render', 'cu_admin_bar_render');

/**
 * Hide options in menu GUI
 *
 */
// output a bit of styling to hide menu options
function cu_nav_menus_styles()
{
    global $post_type;

    echo '<style type="text/css">';
        echo '.add-post-type-post, .add-category { display:none; } ';
    echo '</style>';

    return;
}
add_action('admin_head-nav-menus.php', 'cu_nav_menus_styles');


/**
 * Make all links relative
 *
 * http://www.deluxeblogtips.com/2012/06/relative-urls.html
 *
 */

add_action( 'template_redirect', 'rw_relative_urls' );

function rw_relative_urls() {
    if ( is_feed() || get_query_var( 'sitemap' ) )
        return;

    $filters = array(
        'post_link',
        'post_type_link',
        'page_link',
        'attachment_link',
        'get_shortlink',
        'post_type_archive_link',
        'get_pagenum_link',
        'get_comments_pagenum_link',
        'term_link',
        'search_link',
        'day_link',
        'month_link',
        'year_link',
    );
    foreach ( $filters as $filter )
    {
        add_filter( $filter, 'wp_make_link_relative' );
    }
}

/**
 * Simply enable option in Gravity Forms to hide labels and sub-labels on fields
 *
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/**
 * Move Yoast SEO to bottom
 *
 */
function cu_yoast_to_bottom(){
    // Yoast SEO
    return 'low';
}
add_filter('wpseo_metabox_prio', 'cu_yoast_to_bottom');


