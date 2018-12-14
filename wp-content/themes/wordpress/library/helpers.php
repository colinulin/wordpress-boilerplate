<?php

/**
 * Helper Functions
 *
 */

function prnt($val)
{
    echo '<pre>' . print_r($val, true) . '</pre>';
}

// get favicon html
function cu_get_favicon_html( $path )
{
    echo '<link rel="apple-touch-icon" sizes="57x57" href="'.$path.'apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="'.$path.'apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="'.$path.'apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="'.$path.'apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="'.$path.'apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="'.$path.'apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="'.$path.'apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="'.$path.'apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="'.$path.'apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="'.$path.'android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="'.$path.'favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="'.$path.'favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="'.$path.'favicon-16x16.png">
        <link rel="manifest" href="'.$path.'manifest.json">
        <meta name="msapplication-TileImage" content="'.$path.'ms-icon-144x144.png">';
}

// get array of breadcrumb page id's
function cu_get_breadcrumb_id_array( $menu_item, $menu_name = 'main-navigation' ) {
    $menu_breadcrumb = new Menu_Breadcrumb( $menu_name );
    $breadcrumb_array = $menu_breadcrumb->generate_trail( $menu_item );

    $crumbs = [];
    if ( $breadcrumb_array ) {
        foreach ( $breadcrumb_array AS $crumb ) {
            $crumbs[] = $crumb->ID;
        }
    }

    return $crumbs;
}

// get parent menu page
function cu_get_menu_parent_page( $menu_item = false ) {
    global $post;

    if ( !$menu_item )
        $menu_item = $post;

    $menu = new Menu_Breadcrumb( 'main-navigation' );
    $current = $menu->get_current_menu_item_object( $menu_item );
    $parent = $menu->get_parent_menu_item_object( $current )->object_id;

    return $parent;
}

// get the excerpt by post id
function cu_get_the_excerpt( $post_id = null, $num_words = 55 ) {
    $post = $post_id ? get_post( $post_id ) : get_post( get_the_ID() );
    $text = get_the_excerpt( $post );
    if ( ! $text ) {
        $text = get_post_field( 'post_content', $post );
    }
    $generated_excerpt = wp_trim_words( $text, $num_words );
    return apply_filters( 'get_the_excerpt', $generated_excerpt, $post );
}

// get current page children
function cu_get_page_children( $page_id, $post_type = 'page' ) {
    $custom_wp_query = new WP_Query();
    $all_wp_pages    = $custom_wp_query->query( array( 'post_type' => $post_type, 'posts_per_page' => -1 ) );

    $page_children = get_page_children( $page_id, $all_wp_pages );

    return $page_children;
}

// get current page
function cu_get_current_page()
{
    global $post, $cu_current_page;
    
    if (isset($cu_current_page))
    {
        return $cu_current_page;
    }
    
    // if a Page
    if ($post->post_type == 'page')
    {
        $cu_current_page = $post;
        return $cu_current_page;
    }
    
    return null;
}

// get parent most page
function cu_get_parent_page()
{
    global $cu_parent_page;
    
    if (isset($cu_parent_page))
    {
        return $cu_parent_page;
    }
    
    if ($page = cu_get_current_page())
    {
        // if a Page
        if ($page->post_type == 'page')
        {
            // if parent most page
            if ($page->post_parent === 0)
            {
                $cu_parent_page = $page;
                return $cu_parent_page;
            }
            
            // else, get parent most page
            else
            {
                $ancestors = get_post_ancestors($page->ID);
                if (count($ancestors))
                {
                    $ancestors = array_reverse($ancestors);
                    $cu_parent_page = get_post($ancestors[0]);
                    return $cu_parent_page;
                }
            }
        }
    }
    
    return null;
}

// get social links
function cu_get_social_html()
{
    $social_html = '';

    $social_html .= '<ul>';
        // DISPLAY YOUTUBE ICON
        if($youtube_src = get_field('youtube_src', 'options')) {
            $social_html .= '<li><a href="'.$youtube_src.'" target="_blank" class="youtube-icon"><img src="' . get_template_directory_uri() . '/library/images/icon-youtube2.png" alt="Youtube" /></a></li>';
        }

        // DISPLAY FACEBOOK ICON
        if($facebook_src = get_field('facebook_src', 'options')) {
            $social_html .= '<li><a href="'.$facebook_src.'" target="_blank" class="facebook-icon"><img src="' . get_template_directory_uri() . '/library/images/icon-facebook2.png" alt="Facebook" /></a></li>';
        }

        // DISPLAY TWITTER ICON
        if($twitter_src = get_field('twitter_src', 'options')) {
            $social_html .= '<li><a href="'.$twitter_src.'" target="_blank" class="twitter-icon"><img src="' . get_template_directory_uri() . '/library/images/icon-twitter2.png" alt="Twitter" /></a></li>';
        }
    $social_html .= '</ul>';

    echo $social_html;
}

// get parent most page title
function cu_get_page_title()
{
    if ($page = cu_get_parent_page())
    {
        if ($page->post_title)
        {
            echo '<h1 class="page-title">';
                echo $page->post_title;
            echo '</h1>';
        }
    }
}

// pagination
// ie: << 1 2 3 4 >>
function cu_pagination($max_pages = false)
{
    global $wp_query;
    
    $max_num_pages = $wp_query->max_num_pages;
    if ($max_pages)
    {
        $max_num_pages = $max_pages;
    }
    
    if ($max_num_pages <= 1)
    {
        return;
    }
    
    $bignum = 999999999;
    echo '<div class="pagination">';
        echo '<div class="pagination-emunerate clearfix">';
            echo paginate_links(array(
                'base'         => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
                'format'       => '',
                'current'      => max(1, get_query_var('paged')),
                'total'        => $max_num_pages,
                'prev_text'    => '&larr;',
                'next_text'    => '&rarr;',
                'type'         => 'list',
                'end_size'     => 1,
                'mid_size'     => 3
            ));
        echo '</div>';
    echo '</div>';
}

// pagination
// ie: Previous | Next
function cu_pagination_previous_next($previous = 'Previous', $next = 'Next')
{
    global $wp_query;
    
    $bignum = 999999999;
    if ($wp_query->max_num_pages <= 1) return;
    
    $current = max(1, get_query_var('paged'));
    $links = paginate_links(array(
        'base'               => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
        'format'             => '',
        'current'            => $current,
        'total'              => $wp_query->max_num_pages,
        'prev_next'          => false,
        'type'               => 'array',
        'show_all'           => true,
        'before_page_number' => '--',
        'after_page_number'  => '--'
    ));
    
    if (count($links))
    {
        echo '<div class="pagination">';
            echo '<div class="pagination-previous-next clearfix">';
                if ($current > 1)
                {
                    $replace = '--' . ($current - 1) . '--';
                    echo '<div class="pagination-previous">';
                        echo str_replace($replace, $previous, $links[($current - 2)]);
                    echo '</div>';
                }
                
                if ($current < count($links))
                {
                    $replace = '--' . ($current + 1) . '--';
                    echo '<div class="pagination-next">';
                        echo str_replace($replace, $next, $links[$current]);
                    echo '</div>';
                }
            echo '</div>';
        echo '</div>';
    }
}

// find the first page with a specific template (use filename of template)
function cu_get_page_with_template($template = '')
{
    global $cu_page_templates;
    
    if ( ! isset($cu_page_templates))
    {
        $cu_page_templates = array();
    }
    
    if ($cu_page_templates[$template])
    {
        return $cu_page_templates[$template];
    }
    
    $pages = get_posts(array(
        'post_type'  => 'page',
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template
    ));
    if (count($pages))
    {
        $cu_page_templates[$template] = $pages[0];
        return $cu_page_templates[$template];
    }
    
    return null;
}

// shorten string and add an ellipsis
function cu_shorten( $str = '', $len = 40 )
{
    if (strlen($str) > ($len + 10))
    {
        $str = substr($str, 0, $len) . '...';
    }
    
    return $str;
}

// shorten html content
function cu_shorten_html( $str = '', $length = 50 )
{
    $str = preg_replace("/(\t)/", '', $str);            // clear any unwanted tabbing
    $str = preg_replace("/(\r|\n)/", '', $str);         // clear any unwanted newlines
    $str = preg_replace("/<p[^>]*>/", '', $str);        // remove opening p tag
    $str = preg_replace("/<\/p>/", '', $str);           // clear closing p tag
    $str = preg_replace("/(<br>|<br \/>)/", '', $str);  // clear line breaks
    $str = strip_tags($str);                            // strip all tags
    $arr = explode(' ', $str);                          // create array of words
    $str = join(' ', array_slice($arr, 0, $length));    // get first 50 (or length) words
    if (count($arr) > ($length - 2)) $str .= ' ...';    // add ellipsis if words cut off
    return $str;
}

