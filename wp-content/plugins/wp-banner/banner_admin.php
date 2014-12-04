 <?php
 require_once(ABSPATH . WPINC."/pluggable.php");
 require_once("banner_db.php");
 
 if(! is_user_logged_in())
 {
   auth_redirect();
 }
 define("WP_BANNER_PATH",WP_PLUGIN_URL .'/wp-banner');
 
 $language = get_bloginfo("language");
 $lang = $language[3].$language[4];

 if ($_POST['banner_position'] == "divTag")
 {
     $_POST['banner_position'] = "divTag,".$_POST['banner_layoutpos'].",".$_POST['banner_childpos'].",".$_POST['banner_leftpos'];
     unset($_POST['banner_layoutpos'],$_POST['banner_childpos'],$_POST['banner_leftpos']);
      
 }

   //global $bannerData;
 if($_POST['createbanner'] )
 {
   $_POST['banner_startdate'] =    strtotime($_POST['banner_startdate']);
   $_POST['banner_enddate'] =    strtotime($_POST['banner_enddate']);
     if ($_POST['eid'] != "")
     {
           banner_update();   
     }else{
          banner_new();
     }
    
}

 if (isset($_POST['deletebanner']))  { bannerDelete(); }
 
 banner_admin();
 
 function banner_admin()
 {
   global $wpdb, $bannerData, $clientData, $bannerSize, $bannerType, $bannerPosition;
   
 	$bannerType = array('Image','Flash','Text');
 	$bannerPosition = array('divTag','widget');
   
   $bannerData = bannerGetData();
   
   if ($_POST['banner_client'])
   {
        $clientData = bannerGetClientData($_POST['banner_client']);
        $_POST['eid'] = $clientData['banner_id'];
        
        if (substr($clientData['banner_position'],0,6) == "divTag")
        {
         list($clientData['banner_position'],$clientData['banner_layoutpos'],$clientData['banner_childpos'],$clientData['banner_leftpos']) = explode(",",$clientData['banner_position']);
        }
        
        if(substr($clientData['banner_position'],0,6) == "sticky")
        {
            list($clientData['banner_position'],$clientData['bannerSticky']) = explode(",",$clientData['banner_position']);
        }
   }
    
 }
 
 function bannerCheckImageType()
 {
    $url = $_POST['banner_url'];
    $fh = fopen($url,"r");
    $MagicNumber = fread($fh,3);
    fclose($fh);
    if($MagicNumber == "FWS" or $MagicNumber == "CWS")
    {
        $_POST['banner_type'] = "Flash";
    }else{
        $_POST['banner_type'] = "Image";
    }
 }
 
 function bannerFormatDate($date)
 {
   global $lang;
   
   $date ? $td = getdate($date) : $td = getdate();
   
   if ($lang != "US")
   {
      $fetcha = $td['mday'].'.'.$td['mon'].'.'.$td['year'];
   }else{
      $fetcha = $td['mon'].'/'.$td['mday'].'/'.$td['year'];
   }
   
   return $fetcha;
 }
 
 function getThemeIds()
 {
   $url = get_option("home");
   $fh = fopen($url,"r");
   $struc = array("body");
   $xTags = array("embed","object");
   
   if($fh)
   {
     
      while(! feof($fh))
      {
	
         $line = trim(fgets($fh));
	 
         preg_match_all("/<(\w+) [^>]* *id=\"(.+)\"[^>]*>/U",$line,$match,PREG_SET_ORDER);
      
         
         foreach($match as $tag)
         {
            if (in_array(strtolower($tag[1]),$xTags)) continue;
            if (count($tag[2]) > 0)
            {
               if(substr($tag[2],0,6) != "banner" )
                     if(substr($tag[2],2,6) != "banner" )
                        $struc[] =  $tag[2];
            }
         }
	 
      }
   
      return $struc;
   }
   
 }
 
 function banner_calc($price, $val)
 {
  $isComma = FALSE;
  
   if(substr($price,-3,1) == ",")
   {
       $price[strlen($price)-3] = ".";
       $isComma = TRUE;
   }
   
   (float) $prod = (float)$price * $val;
       
  if ($isComma)
   $prod = number_format($prod,2,",",".");
  else 
   $prod = number_format($prod,2,".",",");
  
   return $prod;
 }
 
 ?>
 
 <div id="ad_banner">
 <form id="bannerform" method="post" action="">
 <?php

    if (is_array($clientData))
    {
        _e ("<h3>Update Banner</h3>", "banner");
    }else{
        _e ("<h3>Create New Banner</h3>", "banner");
    }
?>
<fieldset class="ui-corner-all banner-fieldset">
<legend>&nbsp;<?php _e ("Client Data", "banner"); ?>&nbsp;</legend>
<table class="banner-maintable">
<tr>
<td>
<?php _e("Existing&nbsp;client", "banner"); ?>
</td>
<td><select name="banner_client"  onChange="document.forms[0].submit();">
<option><?php _e("(clear)", "banner"); ?></option>
<?php
       
    if ($bannerData)
    {
        foreach ( $bannerData as $key)
        {
            if ($key['banner_clientname'] == $_POST['banner_client'])
            {
                echo "<option selected=\"selected\">".stripslashes($key['banner_clientname'])."</option>";
             }else{
                echo "<option>".stripslashes($key['banner_clientname'])."</option>";
             }
        }
    }else{
           _e( "<option>No Data</option>", "banner");
    }
?>
</select> 
<div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Select a banner to edit","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
</td></tr>
<tr id="bannerclientname"><td><?php _e ("Client&nbsp;name", "banner"); ?></td>
<td>
   <p class="banner-nospace"><input type="text" size="30" maxlength="100" name="client_name" class="required" value="<?php echo $clientData['banner_clientname']; ?>"></p>
   <input type="hidden" name="eid" value="<?php echo $clientData['banner_id']; ?>">
   <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Give your banner a name","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
</td>   
</tr>

</table>
</fieldset>


<?php
   if($clientData['banner_url']) {
      if ($clientData['banner_type'] != "Flash")
      {
	 echo '<div id="showBanner" title="'.$clientData['banner_clientname'].'">';
	 echo '<img src="'.$clientData['banner_url'].'" id="bannerImage">';
	 echo '</div>';
      }else{
	 list($width,$height) = explode("x",$clientData['banner_size']);
	 echo '<div id="showBanner" title="'.$clientData['banner_clientname'].'">';
	 echo '<OBJECT codeBase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 width="'.$width.'" height="'.$height.'">
		<PARAM NAME="movie" VALUE="'.$clientData['banner_url'].'">
		<PARAM NAME="quality" VALUE="high">
		<EMBED src='.$clientData['banner_url'].'"quality="high" width="'.$width.'" height="'.$height.'" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
		</OBJECT>';
	 echo '</div>';
      }
   }
?>

<fieldset class="ui-corner-all banner-fieldset">
<legend>&nbsp;<?php _e ("Contract Data", "banner"); ?>&nbsp;</legend>
<table class="banner-maintable">
   <tr>
   <td><?php _e("Price","banner")?></td>
   <td><p class="banner-nospace"><input name="banner_price" type="text" size="10" maxlength="10" value="<?php echo $clientData['banner_price']?>"></p>&nbsp;&nbsp;per&nbsp;&nbsp;
         <span id="bannerprice">
         <input type="radio" name="banner_rate" id="bannerclick" value="click" <?php if ($clientData['banner_rate'] == "click") echo "checked='checked'";?>/><label for="bannerclick"><?php _e("click","banner"); ?></label>
         <input type="radio" name="banner_rate" id="bannerview" value="view" <?php if ($clientData['banner_rate'] == "view") echo "checked='checked'";?>/><label for="bannerview"><?php _e("view","banner"); ?></label>
         <input type="radio" name="banner_rate" id="bannermonth" value="month" <?php if ($clientData['banner_rate'] == "month") echo "checked='checked'";?>/><label for="bannermonth"><?php _e("month","banner"); ?></label>
         </span>
         <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Select your contract type<p>you are payed for each</p><ul>
                                                                                      <li>* click <i>or</i></li>
                                                                                      <li>* view <i>or</i></li>
                                                                                      <li>* month</li>
                                                                                      </ul>","banner");?>"><span class="ui-icon ui-icon-help"></span></div>
   </td>
   </tr>
   <tr>
      <td><?php _e("Impressions Purchased", "banner");?></td>
      <td><p class="banner-nospace">
         <input type="text" title="<?php _e("0 = unlimited", "banner"); ?>" size="10" maxlength="10" name="impressions_purchased" value="<?php echo (isset($clientData['banner_impurchased'])) ? $clientData['banner_impurchased'] : 0; ?>"></p>
         <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("If you have have a limited pay per view contract put max views here","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
      </td>
   </tr>
   <tr>
      <td><?php _e("Start Date", "banner");?></td>
      <td>
     <div class="banner-nospace">
      <?php
           
          ($clientData['banner_startdate'] > 0) ? $date = bannerFormatDate($clientData['banner_startdate']) : $date = bannerFormatDate(null);
         
         echo '<input type="text" name="banner_startdate" readonly id="startdate" size="10" maxlength="10" value="'.$date.'">';
      ?>
      </div>
       <div class="banner-space" ><?php _e("End Date", "banner"); ?></div>
      <div class="banner-nospace">
      <?php
  
         $date = bannerFormatDate($clientData['banner_enddate']);
   
         if ($clientData['banner_enddate'] > 0)
         {  
            echo '<input type="text" readonly name="banner_enddate" id="enddate" size="10" maxlength="10" value="'.$date.'">';
         }else{
            echo '<input title="'.__("0 = no limit", "banner").'" type="text" readonly name="banner_enddate" id="enddate" size="10" maxlength="10" value="0">';
         }
       ?>
       </div>
       <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Select a period of time where the banner is shown.<br> If end date is <i>0</i> the period is unlimited","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
</td>
</tr>
<tr>
<td>
<?php _e("Active", "banner"); ?>
</td>
<td>

   <div id="banner_active">
      <input id="banner_enabled" name="banner_enabled" type="radio" value="1" <?php if($clientData['banner_active'] == 1) echo "checked"?> ><label for="banner_enabled"><?php  _e("Yes", "banner"); ?></label>
      <input id="banner_disabled" name="banner_enabled" type="radio" value="0" <?php if(! $clientData['banner_active'] == 1) echo "checked"?> ><label for="banner_disabled"><?php _e("No", "banner"); ?></label>
   </div>
   <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Activate or deactivate your banner","banner")?>"><span class="ui-icon ui-icon-help"></span></div>

</td>
</tr>
<?php if ($clientData['banner_clientname']): ?>
<tr>
   <td><?php _e("Statistics","banner");?>:</td>
   <td><span><?php _e("Clicks","banner");?>: <?php echo " " . $clientData['banner_clicks'] . "&nbsp;&nbsp;" ?></span><span><?php _e("Views","banner");?>: <?php echo " " .$clientData['banner_impressions'] ?></span>
   <span>
      <?php _e(" Earnings","banner") ?>: 
         <?php if($clientData["banner_rate"] == "month" ) echo $clientData["banner_price"] . _e("per month","banner"); 
               elseif ($clientData["banner_rate"] == "view") { echo banner_calc($clientData["banner_price"],$clientData["banner_impressions"]);}
               elseif ($clientData["banner_rate"] == "click") echo banner_calc($clientData["banner_price"],$clientData["banner_clicks"]);
         ?>
   </span></td>
</tr>
<?php endif;?>
</table>
</fieldset>
<fieldset class="ui-corner-all banner-fieldset">
<legend>&nbsp;<?php _e ("Ad Banner Config", "banner"); ?>&nbsp;</legend>
<table cellspacing="0" class="banner-maintable">
<tr>
   <td><?php _e("Select Ad media type","banner")?></td>
   <td><div id="banner_mediatype">
   <input type="radio" name="banner_type" id="bannertext" value="Text" <?php if($clientData['banner_type'] == "Text")  echo 'checked="checked"'?>><label for="bannertext">Text</label>
   <input type="radio" name="banner_type" id="bannerpic" value="URL" <?php if($clientData['banner_type'] == "Image")  echo 'checked="checked"'?>><label for="bannerpic">URL</label>
   </div>
   <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Choose a link to your banner image or insert the ad text","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
   </td>
</tr>
<tr id="bannerurl">
<td><?php _e ("Media type", "banner"); ?><span></span></td>
<td><p class="banner-nospace">
   <input type="text" size="45"  class="required" id="banner_url" name="banner_url" title="" value="<?php echo $clientData['banner_url']; ?>">
  <button id="showButton"></button>
  <button id="bannerMedia" title="open WP Media Library"></button>
   </p>
   
</td>
</tr>
<tr id="bannersize">
<td><?php _e ("Banner Size", "banner"); ?></td>
<td>
    <p class="banner-nospace">
   <input type="text" size="10" id="banner_size" name="banner_size" title="<?php _e ("necessary when using Flash", "banner"); ?>" value="<?php echo $clientData['banner_size']?>" readonly />
   </p>
 
</td>
</tr>
<tr id="clickurl">
<td><?php _e ("Click URL", "banner"); ?></td>
<td><p class="banner-nospace">
  <input type="text" size="50"  class="url" name="click_url" value="<?php echo $clientData['banner_clickurl'] ?>">
  </p>
  <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Link to your ad counter or your ad provider","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
</td>
</tr>
<tr>
   <td><?php _e('Position', "banner");?></td>
   <td>
      <div id="banner_radiopos">
	<?php
      echo '<input id="banner_widget" type="radio" name="banner_position" value="widget"';
      if ("widget" == $clientData['banner_position']) echo "  checked";
      echo ">";
      echo '<label for="banner_widget">'.__("in a widget", "banner").'</label>';
      
      echo '<input id="banner_sticky" type="radio" name="banner_position" value="sticky"';
      if ("sticky" == $clientData['banner_position']) echo "  checked";
      echo ">";
      echo '<label for="banner_sticky">'.__("Sticky", "banner").'</label>';
      
      echo '<input id="banner_div" type="radio" name="banner_position" value="divTag"';
      if ("divTag" == $clientData['banner_position']) echo "  checked";
      echo ">";
      echo '<label for="banner_div">'.__("Expert mode", "banner").'</label>';
      
	?>
      </div>
      <div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("Choose where you want to place your ad.","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
      <!--Sticky mode -->
      <div class="ui-corner-all banner-sticky" id="bannerSticky-form" title="<?php _e("Select post for sticky banner","banner")?>">
          <input type="radio" name="banner_sticky" id="banner1p" value="1" <?php echo ($clientData['banner_sticky'] == "1") ? "checked=checked" : ""; ?>><?php _e("First post","banner");?><br/>
         <input type="radio" name="banner_sticky" id="banner2p" value="2" <?php echo ($clientData['banner_sticky'] == "2") ? "checked=checked" : ""; ?> ><?php _e("Second post","banner");?><br/>
         <input type="radio" name="banner_sticky" id="banner3p" value="3" <?php echo ($clientData['banner_sticky'] == "3") ? "checked=checked" : ""; ?>><?php _e("Third post","banner");?><br/>
      </div>
     <!--Expert mode --> 
    <div class="ui-corner-all banner-inlayout">
	 <table class="banner-table">
	 <tr><td colspan="2"><?php _e("Place your ad on your blog", "banner");?></td></tr>
	 <tr style="background-color:#DBE8FF;">
        <td>
         <div id="banner_layout">
            <?php _e("Div ID", "banner");?>
            
         </div>
        </td>
	    <td>
	     <select name="banner_layoutpos" id="banner_layoutpos">
         <?php
            $layoutOptions = getThemeIds();
            foreach ($layoutOptions as $option)
            {
               echo "<option";
               if ($clientData['banner_layoutpos'] == "$option") echo " selected";
               echo ">$option</option>";
            }
       
         ?>
         </select>
		  
	     </td>
	 </tr>
	 <tr><td valign="top" >
	 <div id="adcontainer">
      <div class="banner-radiopos-tb"></div>
         <div class="banner-radiopos-content">
           <div id="banner-radiopos-container">
            <div class="banner-radiopos"></div>
            <div class="banner-radiopos banner-radiopospad"></div>
            <div class="banner-radiopos"></div>
          </div> 
          </div>
       <div class="banner-radiopos-side"></div>
      <div class="banner-radiopos-tb banner-radiopos-bottom"></div>
    </div>
	 </td>
	 <td valign="top">
      <div id="ad_position">
	    <input type="radio"  name="banner_childpos"  id="cpap" value="append" <?php if($clientData['banner_childpos'] == 'append' || ! $clientData['banner_childpos']) echo "checked"?>> <label for="cpap"><?php _e("Append", "banner");?></label>
	    <input type="radio"  name="banner_childpos" id="cppr" value="prepend" <?php if($clientData['banner_childpos'] == 'prepend') echo 'checked'?>> <label for="cppr"><?php _e("Prepend", "banner");?></label>
	    <input type="radio"  name="banner_childpos" id="cpaf" value="after" <?php if($clientData['banner_childpos'] == 'after') echo 'checked'?>> <label for="cpaf"><?php _e("After", "banner");?></label>
	    </div>
	 </td>
	 </tr>
	 <tr>
      <td><div id="slider-horizontal" style="float:right;"></div></td>
      <td><input id="banneramount" readonly name="banner_leftpos" type="text" maxlength="3" size="3" 
           <?php if(isset($clientData['banner_leftpos'])){ echo "value=\"". $clientData['banner_leftpos']."\"";} else{ echo " value=\"25\"";}?>><?php _e("in <b>%</b>", "banner");?></td>
	 </tr>
	 <tr>
      <td colspan="2"><b><?php _e("This is not your real layout! <br/> This is only an abstract view", "banner");?></b><div class="banner-help-icon ui-state-default ui-corner-all" title="<?php _e("You should only use this option if you have knowledge of your theme layout!","banner")?>"><span class="ui-icon ui-icon-help"></span></div>
	 </td>
	 </tr>
	 </table>
    </div>
   </td>
</tr>
</table>

</fieldset>
<table class="banner-maintable">
<tr>
   <?php
    if (is_array($clientData))
    {
            echo "<td style=\"text-align:center\" ><input class=\"button\" onclick=\"return confirm('".__("really delete this banner?", "banner")."');\" style=\"background:#997777;\" type=\"submit\" name=\"deletebanner\" value=\"";
            _e("Delete Banner", "banner");
            echo "\"></td>";   
    }
 ?>
    <td style="text-align:center" >
      <input class="button" type="submit" name="createbanner" value="<?php _e("Update Banner", "banner");?>">
   </td>
   
 </tr> 
</table>


</form>
</div>
<div id="banner-layout">
 <!--iframe src="http://localhost/~manni/wordpress/" width="100%" height="100%"></iframe-->
</div>
<!-- Image map-->
<map name="wpbannermap">
<area shape="rect" coords="4,1,148,48" alt="3:1 Rectangle 300X100" onclick="wpBannerSize('300X100')" href="#" />
<area shape="rect" coords="216,1,578,46" alt="Leaderboard 728x90" onclick="wpBannerSize('728x90')" href="#" />
<area shape="rect" coords="3,57,233,85" alt="Full Banner 468x60" onclick="wpBannerSize('468x60')" href="#" />
<area shape="rect" coords="2,90,357,237" alt="Pop-Under 720x300" onclick="wpBannerSize('720x300')" href="#" />
<area shape="rect" coords="244,57,357,84" alt="Half Banner 234x60" onclick="wpBannerSize('234x60')" href="#" />
<area shape="rect" coords="366,54,423,173" alt="Vertical Banner 120x240" onclick="wpBannerSize('120x240')" href="#" />
<area shape="rect" coords="433,56,578,179" alt="Medium Rectangle 300x250" onclick="wpBannerSize('300x250')" href="#" />
<area shape="rect" coords="365,181,422,224" alt="Button 1 120x90" onclick="wpBannerSize('120x90')" href="#" />
<area shape="rect" coords="367,233,425,259" alt="Button 2 120x60" onclick="wpBannerSize('120x60')" href="#" />
<area shape="rect" coords="462,185,577,383" alt="Vertical Rectangle 240x400" onclick="wpBannerSize('240x400')" href="#" />
<area shape="rect" coords="0,246,148,543" alt="Half Page Ad 300x600" onclick="wpBannerSize('300x600')" href="#" />
<area shape="rect" coords="156,247,232,544" alt="Wide Skyscraper 160x600" onclick="wpBannerSize('160x600')" href="#" />
<area shape="rect" coords="242,246,298,544" alt="Skyscraper 120x600" onclick="wpBannerSize('120x600')" href="#" />
<area shape="rect" coords="317,246,360,261" alt="Micro Bar 88x31" onclick="wpBannerSize('88x31')" href="#" />
<area shape="rect" coords="307,277,428,398" alt="Square Pop-Up 250x250" onclick="wpBannerSize('250x250')" href="#" />
<area shape="rect" coords="305,406,472,543" alt="Large Rectangle 336x280" onclick="wpBannerSize('336x280')" href="#" />
<area shape="rect" coords="491,406,578,479" alt="Rectangle 180x150" onclick="wpBannerSize('180x150')" href="#" />
<area shape="rect" coords="519,483,578,544" alt="Square Button 125x125" onclick="wpBannerSize('125x125')" href="#" />
</map>
<div id="bannersizemap">
   <img src="<?php echo WP_BANNER_PATH?>/images/banneradsizes.png" width="580" height="545" border="0" usemap="#wpbannermap" />
</div>
<script type="text/javascript">



jQuery(function() {

	 <?php
	 $marginL = (isset($clientData['banner_leftpos']) ? $clientData['banner_leftpos'] : "25" );
	 $divParam = "id='rpred' class='banner-ad' style='margin-left:$marginL%;";
	 echo 'jQuery("#rpred").detach();';
	
	   switch($clientData['banner_childpos']){
	       case "append":	    
		     echo 'jQuery("#banner-radiopos-container").append("<div '.$divParam.'\'>Ad</div>");';
		     break;
	       case "prepend":
		     echo 'jQuery("#banner-radiopos-container").prepend("<div '.$divParam.' margin-bottom:5px; \'>Ad</div>");';
		     break;
	       case "after":
		    echo 'jQuery("#banner-radiopos-container").after("<div '.$divParam.'\'>Ad</div>");';
		    break;
	    }
	 ?>
	 
	 
	if (jQuery("input[name=client_name]").val() == "")
	{
	    jQuery("input[name=createbanner]").val("<?php _e("Create New", "banner");?>");
	}
	jQuery("input[value=divTag]")
	    .click(function () {
          jQuery("#bannerSticky-form").slideUp("slow");
	       jQuery(".banner-inlayout").slideDown("slow");
	       
	    })
	    .attr("checked",function(){
	       if (this.checked ) jQuery(".banner-inlayout").slideDown("slow");
	     });
	jQuery("input[value=widget],input[value=sticky]")
	    .click(function(){
		     jQuery(".banner-inlayout").slideUp("slow");
		     jQuery("select[name=banner_layoutpos] option:selected").attr("selected",false);
		     
		     if(jQuery(this).val() == "sticky")
            jQuery("#bannerSticky-form").slideDown("slow");
            else
               jQuery("#bannerSticky-form").slideUp("slow");
	     })
	     .attr("checked",function(){
            if(jQuery(this).val() == "sticky" && this.checked)
            jQuery("#bannerSticky-form").slideDown("slow");
	     });
	
	jQuery("input[value=append]")
	    .click(function(){
	       jQuery("#rpred").detach();
	       jQuery("#banner-radiopos-container").append('<div id="rpred" class="banner-ad">Ad</div>');
	     });
	jQuery("input[value=prepend]")
	    .click(function(){
	       jQuery("#rpred").detach();
	       jQuery("#banner-radiopos-container").prepend('<div id="rpred" class="banner-ad">Ad</div>');
	     });
	jQuery("input[value=after]")
	    .click(function(){
	       jQuery("#rpred").detach();
	       jQuery("#banner-radiopos-container").after('<div id="rpred" class="banner-ad">Ad</div>');
	     });
	 
	jQuery("#enddate").click(function(){jQuery(this).val("")});
	var lang = <?php echo ($lang != "US") ?  '"d.m.yy"' :  '" "'; ?>;
	jQuery("#startdate").datepicker({
	    showOn: 'button',
	    minDate: '0',
	    buttonText: '<?php _e("Date of campaign start", "banner");?>',
	    dateFormat: lang
	    });
	jQuery("#enddate").datepicker({
	    showOn: 'button',
	    minDate: '0',
	    buttonText: '<?php _e("Date of campaign end. Leave field empty if its a never ending story", "banner");?>',
	    dateFormat: lang
	    }).next(".ui-datepicker-trigger").addClass("ui-banner-button");
	    
	jQuery('button.ui-datepicker-trigger').button({
        text: false,
        icons: {
            primary: 'ui-icon-calendar',
        }
    });
	    
	jQuery("#bannerform").validate({
					  onkeyup: false,
					  onclick: false,
					  errorClass: "error",
					  highlight: function(element, errorClass){
							  jQuery(element).closest("p").attr("class",errorClass);
						     },
					  submitHandler: function(form) {
					  form.submit();
					  }
				       });
	
	jQuery("#slider-horizontal").slider({
			
			range: "min",
			min: 0,
			max: 100,
			value: <?php if(isset($clientData['banner_leftpos'])){  echo $clientData['banner_leftpos'];} else{ echo "25";} ?>,
			slide: function(event, ui) {
				jQuery("#banneramount").val(ui.value);
				jQuery("#rpred").css("margin-left",ui.value + "%")
			}
		});
	
	jQuery("#bannerclientname").bind("dialogbeforeclose", function(event, ui) {alert("close")});
	jQuery("[title]").tooltip({
      content: function (){return jQuery(this).prop('title');}
	});
	
	jQuery("#showBanner").dialog({ autoOpen: false,
				       width: function(){
						return document.getElementById('bannerImage').width + 30;
					     }
				    });
	

	
	/**
	* bannersize Dialog open
	*
	**/
	
	jQuery("#banner_size").click(function(){
      jQuery("#bannersizemap").dialog("open");
	});

	jQuery("#bannersizemap").dialog({
      modal:true,
      autoOpen: false,
      height: 595,
      width: 610
      });
   
  

  /**
  * Create radio Buttons
  *
  **/
      
	jQuery("#banner_radiopos").buttonset();
	jQuery("#banner_active").buttonset();
	
   jQuery("#banner_mediatype").buttonset();
   
   jQuery("#bannerprice").buttonset();
   
//    jQuery("#banner_layout").buttonset();
   
   jQuery("#showButton").button({
      icons:{primary: "ui-icon-newwin"},
      disabled: true,
      text: false
   })
   .click(function(){
                if (! jQuery("#showBanner").dialog("isOpen"))
                {
                   jQuery(this).attr("title","<?php _e("close Banner-Window", "banner");?>");
                   jQuery("#showBanner").dialog("open");
                   return false;
                }else{
                   jQuery(this).attr("title","<?php _e("open Banner-Window", "banner");?>");
                   jQuery("#showBanner").dialog("close");
                   return false;
                }
               });
   /**
   *  open WP Media Library
   *
   **/
   jQuery("#bannerMedia").button({
      icons:{primary: " ui-icon-image"},
      text: false
   }).click(function(){
      var mediaList = wp.media({
                              title: "WP-Banner Media Selector",
                              library: {
                                          type: 'image'
                                       },
                              button: {
                                       //Button text
                                       text: "select"
                                      },
                                         //Do not allow multiple files, if you want multiple, set true
                                       multiple: false
                                    });
        mediaList.on('select',function(){
         var attachment = mediaList.state().get('selection').first().toJSON();
         jQuery('#banner_url').val(attachment.url);
         
        });
        mediaList.open(jQuery(this));
        return false;
   });
   
    var url = ""; //buffer for url when switching from url to text and vice versa
    var txt = "";
  
   jQuery("#bannertext").click(function(){
      
         switchMediaType("Text");
   });
   
   jQuery("#bannerpic").click(function(){
      
         switchMediaType("URL");
   });
  
   if (jQuery("#bannertext").attr("checked") == "checked")
      showMediaType("Text");
      
   if (jQuery("#bannerpic").attr("checked") == "checked")
   {
      
      showMediaType("URL");
   }
   
   
   
   function switchMediaType(type)
   {
            
      if (type == "Text")
      {        
         url = jQuery("#banner_url").val();
         jQuery("#banner_url").val(txt);
         jQuery("#bannersize").hide();
//          jQuery("#showButton").button("enable");
          jQuery("#showButton").hide();
          jQuery("#bannerMedia").hide();
         
      }
      
      if (type == "URL")
      {            
         txt = jQuery("#banner_url").val();
         jQuery("#banner_url").val(url);
         jQuery("#bannersize").show();
         jQuery("#showButton").show();
         if (url.length > 0)
            jQuery("#showButton").button("option","disabled",false);
        
      }
      
      jQuery("#bannerurl").show().find("span").html(" " + type);
   }
   
   
   function showMediaType(type)
   {
      if(type == "URL")
      {
         url = jQuery("#banner_url").val();
         jQuery("#showButton").button("option","disabled",false);
         jQuery("#bannersize").show();
         
      }
      
      if (type == "Text")
      {
         jQuery("#bannersize").fadeOut("slow");
        // jQuery("#showButton").button("disable");
        jQuery("#showButton").hide();
        jQuery("#bannerMedia").hide();
         txt = jQuery("#banner_url").val();
      }
      jQuery("#bannerurl").show().find("span").html(" "+type);
   }
   
   /**
   * bannersize Dialog close
   *
   **/

   function wpBannerSize(size)
   {
      jQuery("#banner_size").val(size);
      jQuery("#bannersizemap").dialog("close");
   }
   
   /**
   * vertical bannerset defined in bannerAdmin.js
   * 
   **/
   
    jQuery("#ad_position").buttonsetv({width:"80"});
 
})

</script>