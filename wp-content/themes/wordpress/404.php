<?php
/*
 Template Name: Error Page
 *
 * 404 Page
 *
 * The 404 Not Found template. Used when WordPress cannot
 * find a post or page that matches the query.
*/

    // get the page using this template
    if ($post = cu_get_page_with_template('404.php'))
    {
        global $wp_query; 

        // inject this page into the Loop
        $wp_query = new WP_Query('page_id=' . $post->ID);
    }
?>

<?php get_header(); ?>

<?php get_template_part('partials/body'); ?>

<?php get_footer(); ?>
