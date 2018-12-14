<?php

/**
 * Register Customizable Navigation Menus
 *
 * These navigation lists will now be available in the Admin
 * under Appearance > Menus.
 */
register_nav_menus(
    array(
        'main-navigation'    => 'Main Navigation',
        'footer-navigation'  => 'Footer Navigation'
    )
);


/**
 * Functions to Retrieve and Output Nav Menus
 *
 */
function cu_get_main_navigation()
{
    cu_build_cpt_breadcrumbs();
    wp_nav_menu(array(
        'depth'           => 0,
        'container'       => 'div',
        'container_class' => 'main-navigation-links',
        'menu_class'      => 'navigation clearfix',
        'theme_location'  => 'main-navigation',
        'fallback_cb'     => false,
        'walker'          => new ColinUlin_Walker_Nav_Menu
    ));
}
function cu_get_footer_navigation()
{
    wp_nav_menu(array(
        'depth'           => 0,
        'container'       => 'div',
        'container_class' => 'footer-navigation',
        'menu_class'      => 'navigation clearfix',
        'theme_location'  => 'footer-navigation',
        'fallback_cb'     => false,
        'walker'          => new ColinUlin_Walker_Nav_Menu
    ));
}

/**
 * Get breadcrumb information for single CPT posts
 *
 */
function cu_build_cpt_breadcrumbs() {
    global $post, $cu_cpt_breadcrumbs, $wp_query;

    $cpts = [
        'cu_examples' => ['template'=>'page-custom.php'],
    ];
    
    foreach ( $cpts AS &$cpt ) {
        if ( !$cpt['archive'] )
            $cpt['archive'] = cu_get_page_with_template($cpt['template']);
    }

    $menu = wp_get_nav_menu_items('main-menu');
    $term = $wp_query->get_queried_object();

    if ( $menu ) {
        foreach ( $menu AS $page ) {
            foreach ( $cpts AS &$cpt ) {
                if ( $page->object_id == $cpt['archive']->ID )
                    $cpt['menu_item'] = $page;
            }
        }
    }
    if ( get_post_type() ) {
        if ( array_key_exists(get_post_type(), $cpts) && $cpts[get_post_type()]['menu_item'] ) {
            $cu_cpt_breadcrumbs = cu_get_breadcrumb_id_array($cpts[get_post_type()]['menu_item']);
        }
    }
}

/**
 * Custom Navigation Walker
 * 
 */
class ColinUlin_Walker_Nav_Menu extends Walker_Nav_Menu
{
    // add main/sub classes to li's and links
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $post, $cu_cpt_breadcrumbs;
        
        // custom parent items
        if ( $cu_cpt_breadcrumbs ) {
            if ( in_array($item->ID, $cu_cpt_breadcrumbs) ) {
                $item->classes[] = "current-menu-ancestor current-page-ancestor current-page-parent current-menu-parent";
            }
        }

        $item->classes[] = 'menu-depth-'.$depth;

        // call parent method
        parent::start_el($output, $item, $depth, $args, $id);
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) 
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}
