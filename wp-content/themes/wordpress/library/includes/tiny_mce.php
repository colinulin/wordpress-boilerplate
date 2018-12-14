<?php
/**
 * Update Toolbar Buttons
 *
 * Add custom plugins to the toolbar, then list them either in the
 * first or second row of buttons.
 */
function cu_mce_external_plugins($plugins)
{
    // add anchor link plugin
    // $plugins['example_plugin'] = get_template_directory_uri() . '/library/js/admin/tinymce/plugins/example_plugin.js';

    return $plugins;
}
add_filter('mce_external_plugins', 'cu_mce_external_plugins');

// first row of buttons
function cu_mce_buttons($buttons)
{
    return array(
        'formatselect','styleselect','bold','italic','underline','bullist','numlist',
        'alignleft','aligncenter','alignright',
        'link','unlink',
        'blockquote',
        'hr','removeformat','undo','redo'
   );
}
add_filter('mce_buttons', 'cu_mce_buttons');

// second row of buttons
function cu_mce_buttons_2($buttons)
{
    return array(
        
    );
}
add_filter('mce_buttons_2', 'cu_mce_buttons_2');

// update rows for ACF WYSIWYG editor as well
function cu_acf_toolbars( $toolbars )
{
    $toolbars[ 'Basic' ] = array();
    $toolbars[ 'Basic' ][1] = array(
        'formatselect','styleselect',
        'bold','italic','underline','alignleft','aligncenter',
        'link','unlink','removeformat'
    );

    $toolbars[ 'Full' ] = array();
    $toolbars[ 'Full' ][1] = array(
        'formatselect','styleselect','bold','italic','underline','bullist','numlist',
        'alignleft','aligncenter','alignright',
        'link','unlink',
        'blockquote',
        'hr','removeformat','undo','redo'
   );
    $toolbars[ 'Full' ][2] = array(
        
    );

    // return $toolbars - IMPORTANT!
    return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'cu_acf_toolbars'  );


/**
 * TinyMCE Formatting
 *
 * Add additional custom style options for the WYSIWYG editor.
 * Add 'styleselect' to mce_buttons_2 to have the custom styles available.
 *
 * This will cause the classes to stack cumulatively:
 *   'classes' => 'text-icon-phone'
 *
 * This ensures that each class will be replaced before applying the new one:
 *   'attributes' => ['class' => 'text-icon-phone']
 */
function cu_tiny_mce_before_init($init_array)
{
    $style_formats = array(
        
    );
    $init_array['style_formats'] = json_encode($style_formats);

    // allow attributes
    $init_array['extended_valid_elements'] .= "*[*]";
    $init_array['valid_elements'] .= "*[*]";
    $init_array['preview_styles'] .= ' background-color color';
    
    return $init_array;
}
add_filter('tiny_mce_before_init', 'cu_tiny_mce_before_init');

// add the css file for TinyMCE
function cu_add_editor_style()
{
	add_editor_style('library/css/editor-style.css');
}
add_action('admin_init', 'cu_add_editor_style');


/**
 * Disable 4.3 Formatting Shortcuts
 *
 * Remove the wptextpattern plugin.
 */
function cu_disable_wptextpattern($opt)
{
    if (isset($opt['plugins']) && $opt['plugins'])
    {
        $opt['plugins'] = explode(',', $opt['plugins']);
        $opt['plugins'] = array_diff($opt['plugins'], array('wptextpattern'));
        $opt['plugins'] = implode(',', $opt['plugins']);
    }
    return $opt;
}

add_filter('tiny_mce_before_init', 'cu_disable_wptextpattern');

