<?php

/**
 * Enable Theme Support for Custom Image Sizes
 * 
 */
add_theme_support('post-thumbnails');

// overwrite the default 'thumbnail' image setting.
add_image_size('thumbnail', 200, 200, true);


/**
 * Add Custom Image Sizes
 *
 */
// add_image_size( string $name, int $width, int $height, bool|array $crop = false )

/**
 * Remove Featured Images Meta Box from Pages and Post
 *
 */
function cu_remove_image_meta_boxes()
{
    remove_meta_box('postimagediv', 'page', 'side');
}
add_action('do_meta_boxes', 'cu_remove_image_meta_boxes');
