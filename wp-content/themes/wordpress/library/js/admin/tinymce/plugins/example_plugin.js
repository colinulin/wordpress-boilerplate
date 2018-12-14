(function() {
    tinymce.create('tinymce.plugins.Wptuts', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {
        
            // if the resource categories faq content editor
            if (ed.id.search('acf-field-resource_categories_faq') != -1) {
                
                ed.addButton('resource_categories_faq', {
                    id:    'resource_categories_faq_button',
                    title: 'FAQ Template',
                    cmd:   'resource_categories_faq',
                    image: false
                    //image: url + '/resource_categories_faq.jpg'
                });
            }
            
            ed.addCommand('resource_categories_faq', function() {
                var selected_text = ed.selection.getContent();
                
                var return_text =
                '<div class="question-header">' + 
                    '<strong>FAQ</strong> / <a href="/">VIEW ALL</a>' + 
                '</div>' +
                '<div class="question-left">' + 
                    '<p>' +
                        'Lorem ipsum dolor sit amet consectetur adipiscing elit mauris molestie ullamcorper turpis?' + 
                    '</p>' +
                    '<p>' + 
                        'Sit amet faucibus sem tristique vel. Donec rhoncus lorem ut eros dictum scelerisque. Nullam a vestibulum sapien eget eleifend sapien. ' + 
                        'Nam dignissim nibh id tortor gravida, id euismod orci finibus. In leo lorem aliquam a magna a facilisis maximus dolor.' + 
                    '</p>' + 
                '</div>' +
                '<div class="question-right">' + 
                    '<p>' + 
                        'Curabitur facilisis diam et sollicitudin lobortis fusce sit amet magna in arcu pulvinar sagittis mauris eu elementum velit?' + 
                    '</p>' +
                    '<p>' + 
                        'Dignissim nibh id tortor gravida, id euismod orci finibus. In leo lorem aliquam a magna a facilisis maximus dolor sit amet faucibus sem ' + 
                        'tristique vel. Donec rhoncus lorem ut eros dictum scelerisque. Nullam a vestibulum sapien eget eleifend sapien. ' + 
                    '</p>' + 
                '</div>';
                
                ed.execCommand('mceInsertContent', 0, return_text);
            });
        },
 
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'wptuts', tinymce.plugins.Wptuts );
})();
