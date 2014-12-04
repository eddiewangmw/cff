function placeBanner()
{
   jQuery("div[id^=bannerdiv]").attr("banner_pos",function(i,value){
      var tagname = jQuery(this).attr("banner_tag");
      tagname != "body" ? tagname = "#"+tagname : tagname;
      
      func = "jQuery(\""+tagname+"\")."+value+"(jQuery(\"#"+jQuery(this).attr("id")+"\"))";
      eval(func);
   });
}
 
placeBanner();