QTags.addButton( 'wpbanner_id', 'WPBanner', bannerAdbutton );
function bannerAdbutton() {
   var opts = "<option value=''>Client Name</option>";;
   var pos = jQuery("#qt_content_wpbanner_id").position();
   for (i in customer)
   {
      
      opts += "<option value='"+customer[i].banner_clientname+"'>"+customer[i].banner_clientname+"</option>\n";
   }
   // alert(pos.top + " : " + pos.left);
   pt = pos.top + 20;
  
   if(jQuery("#banner_cliName").length)
   {
      jQuery("#banner_cliName").detach();
    
   }else{
      jQuery("#qt_content_wpbanner_id").after("<div id='banner_cliName' style='left:"+pos.left+"px;top:"+pt +"px '><select id='banner_cliSelect'>"+opts+"</select></div>");
      
   
      jQuery("#banner_cliSelect").change(function(){
         if (jQuery("#banner_cliSelect option:selected").val() != "")
         {
            var insert = '[wpbanner client="'+jQuery("#banner_cliSelect option:selected").val()+'"]';
            QTags.insertContent(insert);
         }
      });
   }
  
}