<?php
 
/**
 * Examples CPT
 *
 * Register the custom post type.
 *
 */
function init_cu_examples()
{
    register_post_type(
        'cu_examples',
        array(
            'labels' => array(
                'name'               => 'Examples',
                'singular_name'      => 'Example',
                'all_items'          => 'All Examples',
                'add_new'            => 'Add New',
                'add_new_item'       => 'Add New Example',
                'edit'               => 'Edit',
                'edit_item'          => 'Edit Example',
                'new_item'           => 'New Example',
                'view_item'          => 'View Example',
                'search_items'       => 'Search Examples',
                'not_found'          => 'No posts were found in the Database.',
                'not_found_in_trash' => 'No posts were found in the Trash',
                'parent_item_colon'  => ''
            ),
            'description'         => 'Examples posts.',
            'public'              => true,
            'menu_icon'           => 'dashicons-lightbulb',
            'rewrite'             => array('slug' => 'examples'),
            'has_archive'         => true,
            'capability_type'     => 'page',
            'supports'            => array('editor', 'excerpt', 'title')
        )
    );
}
add_action('init', 'init_cu_examples');

/**
 * Create Taxonomies
 *
 */
function cu_create_examples_taxonomies()
{
    // Categories
    $labels = array(
        'name'               => 'Categories',
        'singular_name'      => 'Category'
    );
    $args = array(
        'labels'            => $labels,
        'rewrite'           => array('slug' => 'examples/category'),
        'popular_items'     => NULL
    );
    register_taxonomy( 'cu_examples_category', array( 'cu_examples' ), $args );
}
add_action( 'init', 'cu_create_examples_taxonomies', 0 );


