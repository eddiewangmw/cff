tinymce.PluginManager.add('bannerplugin', function(editor, url){
   
   editor.addButton('bannerlistbox',{
         type: 'listbox',
         text: 'WPBanner',
         icon: false,
         context: 'tools',
         onselect: function(e){
             
            editor.insertContent(this.value())
            ed = tinymce.activeEditor.settings.banner_listbox;
             console.log(ed);
         },
          values: getValues(),

   })
 
   function getValues()
   {
      var values = [];
      var lb = tinymce.activeEditor.settings.banner_listbox;
      
     for (i=0; i < lb.length; i++)
     {
        values[i] = {};
        values[i].text = lb[i]['banner_clientname'] ;
        values[i].value = '[wpbanner client="' + lb[i]['banner_clientname'] + '"]';
     }
    return values;
   }

});
