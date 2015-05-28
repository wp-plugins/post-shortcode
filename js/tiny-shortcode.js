(function() {
    tinymce.PluginManager.add('pcs_tc_button', function( editor, url ) {
        editor.addButton( 'pcs_tc_button', {
            text: 'Post Shortcode',
            icon: "pcsicon",
            onclick: function(e) {
               e.stopPropagation();
               editor.windowManager.open( {
                   title: 'Post Shortcode',
                   body: [
                   {
                       type: 'textbox',
                       name: 'classes',
                       label: 'Additional classes'
                   },
                   {
                       type: 'textbox',
                       name: 'postcount',
                       label: 'Post per page'
                   },
                   {
                       type: 'listbox', 
                       name: 'sizes', 
                       label: 'Post Type', 
                       'values': [  {text: 'post', value: 'post'},
                           {text: 'page', value: 'page'},
                           {text: 'products', value: 'products'},]
                   },
                   {
                       type: 'listbox', 
                       name: 'pagination', 
                       label: 'Post Pagination', 
                       'values': [
                           {text: 'False', value: 'false'},
                           {text: 'True', value: 'true'},
                       ]
                   },
                   {
                       type: 'listbox', 
                       name: 'category', 
                       label: 'Post category', 
                       'values': get_allpost_array()
                   }],
                   onsubmit: function( e ) {
                       editor.insertContent( '&#91;ss_button title="' + e.data.title + '" title2="' + e.data.title1 + '" style="' + e.data.level + '" class="'+ e.data.classes +'"  size="'+ e.data.sizes +'" color="'+e.data.color+'" link="'+e.data.link+'"&#93;');
                   }
               });
           }  
        });
    });
})();