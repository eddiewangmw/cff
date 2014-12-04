<?php
/*
Plugin Name: banner
Plugin URI: http://www.bibuweb.de/
Description: Advertise banner plugin
Version: 2.2.0
Author: Alfredo Cubitos
E-Mail: alfredocubitos@yahoo.com.mx
Author URI: http://www.bibuweb.de
*/

/*  Copyright 2013 Alfredo Cubitos

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    For a copy of the GNU General Public License, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
define("WP_BANNER_VERSION","2.2.0");
define("WP_BANNER_PATH",WP_PLUGIN_URL .'/wp-banner');
define("WP_PLUGIN",plugin_basename( __FILE__ ));
load_plugin_textdomain( 'banner', false, dirname( WP_PLUGIN ) . '/languages/' );
$ajaxurl = admin_url() .'/admin-ajax.php';
$count = 0; //setting count for content filter

function banner_add_style()
{
   wp_enqueue_script('jquery');
 //  wp_register_style('wpbannerstyle', WP_BANNER_PATH . '/styles/default.css');
 //  wp_enqueue_style('wpbannerstyle');
}

function banner_head()
{
   global $ajaxurl;
   //wp-banner set url for ajaxhandler
    echo '<script type="text/javascript">
           var ajaxurl ="'. $ajaxurl.'";' ; ?>
       
         function BannerClick(banner_id)
         {
            jQuery.ajax({
               url: ajaxurl,
               data: {action:"wpbanner","banner_id": banner_id},
               type : 'post',
               dataType: "html"
              
            })
            
         }
        
   <?php
   echo "</script>";

}

class WPbannerWidget extends WP_Widget 
{
    
    function WPbannerWidget() 
    {
        parent::WP_Widget(false, $name = __('WP Banner Widget', "banner"));
    }
    
    function widget($args, $instance) {	
	
        extract( $args );
        
        $title = $instance['title'];
        $client = $instance['client'];
        
         echo $before_widget;
         if ( $title )
	 {
            echo $before_title . $title . $after_title; 
	    echo getWidgetBannerUrl($client);
	 }
			
         echo $after_widget; 
        
    }
    
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['client'] = strip_tags($new_instance['client']);
        return $instance;
    }

   function form($instance) 
   {
      global $wpdb,$table_prefix;
      $title = esc_attr($instance['title']);
      $client = esc_attr($instance['client']);
      
      $default = __("Advertisement", "banner");

      $query = "SELECT * FROM ".$table_prefix."banner WHERE banner_active=1 AND (banner_startdate=0 OR banner_startdate<=".time().") AND (banner_enddate=0 OR banner_enddate>".time().") AND (banner_impurchased=0 OR banner_impressions<=banner_impurchased) AND banner_position='widget'";
      $banner = $wpdb -> get_results($query);
      
      echo '<label for="bannerTitle">'.__("Title:", "banner").' </label>';
      echo '<input id="bannerTitle" name="'.$this->get_field_name('title').'" type="text" size="15" value="'.(strlen($title) > 0 ? $title : $default ).'"><br />';
      echo '<label for="bannerClient">'.__("Client:", "banner").' </label>';
      echo '<select id="bannerClient" onchange="wpWidgets.save(jQuery(jQuery(this)).closest(\'div.widget\'), 0, 1, 0 );" name="'.$this->get_field_name('client').'">';
      echo "<option value='0'".($client == 0 ? " selected=\"selected\"" : "").">".__("No Ad", "banner")."</option>";
      echo "<option value='random'".($client == "random" ? " selected=\"selected\"" : "").">".__("Random", "banner")."</option>";
      foreach ($banner as $ad)
      {
	 echo "<option value='" .$ad->banner_id. "'"; 
	 if ( $client == $ad->banner_id) 
	 {
	    echo " selected='selected'";
	    $selected = $ad->banner_id;
	    $url = $ad->banner_url;
	    $name = $ad->banner_clientname;
	 }
	  
	  echo ">".$ad->banner_clientname.'</option>';
	
      }
      echo '</select>';
      
      
      if ($client == $selected)
      {
	 echo "<img src='$url' alt='$name' style='border:0;' />";
      }

   }
  

}


function getWidgetBannerUrl($id)
{
      global $wpdb,$table_prefix;
      
      if ($id == "random") {
		$query = "SELECT * FROM ".$table_prefix."banner WHERE (banner_startdate=0 OR banner_startdate<=".time().") AND (banner_enddate=0 OR banner_enddate>".time().") AND (banner_impurchased=0 OR banner_impressions<=banner_impurchased) AND banner_position='widget' ORDER BY RAND() LIMIT 1";
      }
      else {
		$query = "SELECT * FROM ".$table_prefix."banner WHERE banner_id=$id AND (banner_startdate=0 OR banner_startdate<=".time().") AND (banner_enddate=0 OR banner_enddate>".time().") AND (banner_impurchased=0 OR banner_impressions<=banner_impurchased) AND banner_position='widget'";
	}
      $client = $wpdb -> get_row($query);
      if($client)
      {
         if ($client->banner_type == "Flash")
         {
            list($width,$height) = explode("x",$client->banner_size);
            $url = "<a href=\"".$ad->banner_clickurl."\" TARGET=\"_blank\" onclick=\"BannerClick(".$client->banner_id.")\">
               <object codeBase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 width=\"$width\" height=\"$height\">
               <param name=\"movie\" value=\"".$client->banner_url."\">
               <param name=\"quality\" value=\"high\">
               <embed src=\"".$client->banner_url."\"quality=\"high\"width=\"$width\" height=\"$height\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"></embed>
               </object>
               </a>\n";
         }else{
            $url = "<a href=\"".$client->banner_clickurl."\" target=\"_blank\" id=\"bannerclient".$client->banner_id."\" onclick=\"BannerClick(".$client->banner_id.")\"> <img src=\"".$client->banner_url."\" alt=\"".$client->banner_clientname."\" style='border:0;' /></a>";
         }
         $wpdb->query("UPDATE ".$table_prefix."banner SET banner_impressions=banner_impressions+1 WHERE banner_id=\"".$client->banner_id."\"");
      }else{
         $url = "<div>".__("Place your Ad here", "banner")."</div>";
      }
      return ($url);
}

function banner_select($pos,$nr=NULL)
{
   global $wpdb,$table_prefix;
   
   if ($pos == "divTag")
   {
      $query = "SELECT * FROM ".$table_prefix."banner WHERE banner_active=1 AND (banner_startdate=0 OR banner_startdate<=".time().") AND (banner_enddate=0 OR banner_enddate>".time().") AND (banner_impurchased=0 OR banner_impressions<=banner_impurchased) AND banner_position like 'divTag%' ORDER BY RAND()";
      $banner = $wpdb -> get_results($query);   // return  multiple banner
   }elseif($pos == "sticky"){
      $query = "SELECT * FROM ".$table_prefix."banner WHERE banner_active=1 AND (banner_startdate=0 OR banner_startdate<=".time().") AND (banner_enddate=0 OR banner_enddate>".time().") AND (banner_impurchased=0 OR banner_impressions<=banner_impurchased) AND banner_position='$pos' AND banner_sticky='$nr' ORDER BY RAND()";
      $banner = $wpdb -> get_row($query);
   
   }else{
      $query = "SELECT * FROM ".$table_prefix."banner WHERE banner_active=1 AND (banner_startdate=0 OR banner_startdate<=".time().") AND (banner_enddate=0 OR banner_enddate>".time().") AND (banner_impurchased=0 OR banner_impressions<=banner_impurchased) AND banner_position='$pos' ORDER BY RAND()";
      $banner = $wpdb -> get_row($query);  // return a single banner
   }
   
   return $banner;
}

function banner()
{

   $banner = banner_select("divTag");
   
   if (sizeof($banner) > 0)
   {
      banner_expertMode($banner);
   }
   
   wp_register_script('bannerAdd', WP_BANNER_PATH . '/js/banner.js');
   wp_enqueue_script('bannerAdd');
}




function banner_expertMode($banner)
{
   global $wpdb,$table_prefix;
   
        
        $layoutid = array();
        /**
        * check if there are double position ids
        * and get rid of them
        **/
        foreach($banner as $ad)
        {
            list($tmp,$pos) = explode(",",$ad->banner_position);
            
             (! in_array($pos,$layoutid)) ? $layoutid[] = $pos :   array_shift($banner);
        }
        
        $divID = 0;
        foreach ($banner as $ad)
        {
            $wpdb->query("UPDATE ".$table_prefix."banner SET banner_impressions=banner_impressions+1 WHERE banner_id=\"".$ad->banner_id."\"");
            list($width,$height) = explode("x",$ad->banner_size);
       
            list($tmp,$pos,$jq,$left) = explode(",",$ad->banner_position);
       
       if ($ad->banner_type == "Flash")
       {
      
          $text .= "<div id=\"bannerdiv$divID\" style=\"padding-left:$left\"><a href=\"".$ad->banner_clickurl."\" TARGET=\"_blank\" onclick=\"BannerClick(".$ad->banner_id.")\">
      <OBJECT codeBase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 width=\"$width\" height=\"$height\">
      <PARAM NAME=\"movie\" VALUE=\"".$ad->banner_url."\">
      <PARAM NAME=\"quality\" VALUE=\"high\">
      <EMBED src=\"".$ad->banner_url."\"quality=\"high\"width=\"$width\" height=\"$height\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\"></EMBED>
      </OBJECT>
      </a>
      </div>\n";
       }else{
         $text .= "<div id=\"bannerdiv$divID\" banner_pos=\"$jq\" banner_tag=\"$pos\" style=\"padding-left:$left%;\"><a href=\"".$ad->banner_clickurl."\" TARGET=\"_blank\" id=\"bannerclient".$ad->banner_id."\"  onclick=\"BannerClick(".$ad->banner_id.")\"> <img src=\"".$ad->banner_url."\" alt=\"".$ad->banner_clientname."\" style=\"border:0;\" ></a></div>\n";
       }
         $divID++;
      }
        
        echo "$text";       
}

/**
* Filter for adding banner to one of first three posts
*
**/

function banner_content_filter($content)
{
   global $count;
    $count++;
    $banner = banner_select("sticky", $count);
    
    if (! sizeof($banner) > 0)
      return $content;
    
   switch ($count)
   {
      case 1:
         $content .= banner_sticky_content($banner,$count);
         break;
     case 2:
         $content .= banner_sticky_content($banner,$count);
         break;
     case 3:
         $content .= banner_sticky_content($banner,$count);
         break;
         
   }
   
   return $content;
}

function banner_sticky_content($banner,$count)
{
   $text = "";
   
   if ($banner->banner_type == "Flash")
   {
      
          $text = "<div id=\"banner_sticky$count\"><a href=\"".$ad->banner_clickurl."\" TARGET=\"_blank\" onclick=\"BannerClick(".$banner->banner_id.")\">
      <OBJECT codeBase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 width=\"$width\" height=\"$height\">
      <PARAM NAME=\"movie\" VALUE=\"".$banner->banner_url."\">
      <PARAM NAME=\"quality\" VALUE=\"high\">
      <EMBED src=\"".$banner->banner_url."\"quality=\"high\"width=\"$width\" height=\"$height\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\"></EMBED>
      </OBJECT>
      </a>
      </div>\n";
       }elseif(($banner->banner_type == "Text")){
         $text = "<div id=\"banner_sticky$count\"><a href=\"".$banner->banner_clickurl."\" TARGET=\"_blank\" id=\"bannerclient".$banner->banner_id."\"  onclick=\"BannerClick(".$banner->banner_id.")\"> $banner->banner_url </a></div>\n";
       }else{
         $text = "<div id=\"banner_sticky$count\"><a href=\"".$banner->banner_clickurl."\" TARGET=\"_blank\" id=\"bannerclient".$banner->banner_id."\"  onclick=\"BannerClick(".$banner->banner_id.")\"> <img src=\"".$banner->banner_url."\" alt=\"".$banner->banner_clientname."\" style=\"border:0;\" ></a></div>\n";
       }
    return $text;
}

if (!function_exists(banner_admin_init))
{
   function banner_admin_init()
   {
      
      wp_register_script('bannerDialogValidate', WP_BANNER_PATH . '/js/jquery.validate.min.js');
      wp_register_script('bannerAdmin', WP_BANNER_PATH . '/js/bannerAdmin.js');
      
      wp_register_style('banner-jQui', WP_BANNER_PATH . '/styles/jquery/humanity/jquery-ui.css');
      wp_enqueue_style('banner-jQui');
      wp_enqueue_style('jquery-ui-dialog');
      wp_register_style('bannerAdminCss', WP_BANNER_PATH . '/styles/banneradmin.css');
      wp_enqueue_style('bannerAdminCss');
      
   }

}

function banner_menu($wp_admin_bar)
{
   $url = get_option('siteurl' , $default );
   $url = $url . "/wp-admin/options-general.php?page=wp-banner/banner_admin.php";
   
   $args = array(
                  "parent"   => "appearance",
                  "id" => "BannerAdmin",
                  "title" => "Banner Admin",
                  "href" => admin_url("options-general.php?page=wp-banner/banner_admin.php")
                  
                  
                );
   $wp_admin_bar->add_node( $args );
}

function banner_settings_link($links)
{
   $settings_link = sprintf(__('%s Settings %s',TAPS_TEXTDOMAIN),'<a href="options-general.php?page=wp-banner/banner_admin.php">','</a>');
   $donate_link = sprintf(__('%s Donate %s',TAPS_TEXTDOMAIN),'<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RD6AZC63ARPX4">','</a>');
   array_unshift($links, $settings_link);
   array_unshift($links, $donate_link);
   return $links; 
}

/**
* Ajax handler
*
**/
function ajax_banner_clicks()
{
    global $wpdb,$table_prefix;
    
    $query = "UPDATE ".$table_prefix."banner SET  banner_clicks=banner_clicks+1 WHERE banner_id=".intval($_POST['banner_id']);
    $wpdb->query($query);
    exit;
}


/**
* shortcode handler
*
**/
function banner_ShortCodeHandler($atts)
{
   global $wpdb, $table_prefix;
   
   $query = "SELECT banner_clickurl, banner_url, banner_type, banner_id FROM ". $table_prefix."banner WHERE banner_clientname = '" . $atts['client'] ."'";
   $result = $wpdb->get_row($query,ARRAY_A);
    
    ob_start();
    
    if ($result['banner_type'] == "Image")
    {
      $content = "<img src='" .$result['banner_url']."'/>";
    }elseif($result['banner_type'] == "Flash"){
      $content = "<OBJECT codeBase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 width=\"$width\" height=\"$height\">
      <PARAM NAME=\"movie\" VALUE=\"".$result['banner_url']."\">
      <PARAM NAME=\"quality\" VALUE=\"high\">
      <EMBED src=\"".$result['banner_url']."\"quality=\"high\"width=\"$width\" height=\"$height\" TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\"></EMBED>
      </OBJECT>";
    }elseif($result['banner_type'] == "Text"){
      $content = "<div class='banner_text'><a href=\"".$banner->banner_clickurl."\" TARGET=\"_blank\" id=\"bannerclient".$banner->banner_id."\"  onclick=\"BannerClick(".$banner->banner_id.")\"> $banner->banner_url </a></div>\n";
    }else{
      $content = $result['banner_url'];
    }
      
    echo "<a href='".$result['banner_clickurl'] ."' target='_blank' onclick='BannerClick(\"".$result['banner_id']."\")'>$content</a>";
    
    $output_str = ob_get_contents();
    ob_end_clean();
    
    return $output_str;
}

/**
* editor plugin
*
**/

function banner_getClients()
{
   global $wpdb, $table_prefix;
   
   $query = "SELECT banner_clientname FROM ". $table_prefix."banner WHERE banner_active=1 AND (banner_startdate=0 OR banner_startdate<=".time().") AND (banner_enddate=0 OR banner_enddate>".time().") AND (banner_impurchased=0 OR banner_impressions<=banner_impurchased)";
    $result = $wpdb->get_results($query);
    
    return $result;
}

function banner_editor_plugin()
{
    return json_encode(banner_getClients());
}


/**
* tinymce plugin
*
**/

function banner_mce_plugin($plugin_array)
{
  
   $plugin_array['bannerplugin'] = plugins_url('js/', __FILE__) . "tinymce.banner_plugin.js";
   
   return $plugin_array;
}

function register_bannermce_button($buttons)
{
   
   array_push($buttons, "separator","bannerlistbox");
  
   return $buttons;
}

function banner_mce_init( $init_array ) {  
   // Define the style_formats array

   // Insert the array, JSON ENCODED, into 'style_formats'
   $init_array['banner_listbox'] = json_encode( banner_getClients() ) ;  
   
   return $init_array;  
  
} 


if (!function_exists(banner_admin_scripts))
{
   function banner_admin_scripts()
   {
      wp_enqueue_script('jquery-ui-core');
      wp_enqueue_script('jquery-ui-widget');
      wp_enqueue_script('jquery-ui-mouse');
      wp_enqueue_script('jquery-ui-datepicker');
      wp_enqueue_script('jquery-ui-dialog');
      wp_enqueue_script('jquery-ui-slider');
      wp_enqueue_script('jquery-ui-draggable');
      wp_enqueue_script('jquery-ui-resizable');
      wp_enqueue_script('jquery-ui-position');
      wp_enqueue_script('jquery-ui-tooltip');
      wp_enqueue_script('jquery-ui-button');
      
      wp_enqueue_script('bannerDialogValidate');
      wp_enqueue_script('bannerAdmin');
   }
}

if (!function_exists(banner_admin_menu))
{
    function banner_admin_menu()
    {
        add_submenu_page('options-general.php', 'Banner Menu', 'Banner Admin',9, '/wp-banner/banner_admin.php');
    }
}

function banner_add_quicktags()
{
   if (wp_script_is('quicktags'))
   {
      echo '<script>var customer='.banner_editor_plugin().'; </script>';
       echo '<script src="'. WP_BANNER_PATH . '/js/editorAdbutton.js"></script>';
   }
}

function banner_install()
  {
     global $wpdb, $table;
     $table = $wpdb->prefix."banner";
     
      $sql = "CREATE TABLE " . $table ."  (
  				banner_id int(10) unsigned NOT NULL auto_increment,
  				banner_clientname varchar(100) NOT NULL default '',
  				banner_clickurl varchar(150) NOT NULL default '',
  				banner_impurchased int(10) unsigned NOT NULL default '0',
  				banner_startdate int(10) unsigned NOT NULL default '0',
  				banner_enddate int(10) unsigned NOT NULL default '0',
  				banner_active tinyint(1) unsigned NOT NULL default '0',
  				banner_clicks int(10) unsigned NOT NULL default '0',
  				banner_impressions int(10) unsigned NOT NULL default '0',
  				banner_url text NOT NULL,
  				banner_size varchar(10) NOT NULL default '',
  				banner_type varchar(10) NOT NULL default '',
  				banner_position varchar(50)  NOT NULL default 'divTag',
  				banner_price varchar(10) NOT NULL default '',
            banner_rate varchar(10) NOT NULL default 'click',
            banner_sticky int(10) NULL default NULL,
  				PRIMARY KEY  (`banner_id`)
				);";
				
     
     	dbDelta($sql);
     
     $welcome_name = "WP Banner";
     $welcome_text = "Congratulations, you just completed the installation!";
     add_option("wpbanner_version",  WP_BANNER_VERSION); 
  }

  function banner_upgrade()
  {
       
    banner_install();
    update_option("wpbanner_version",  WP_BANNER_VERSION); 
  }
  
  
function banner_upgradeCheck()
{
   $version = get_option('wpbanner_version');

    if ( $version != WP_BANNER_VERSION) banner_upgrade(); 
}
  
	add_action('wp_print_styles','banner_add_style');
	add_action('wp_footer','banner');
	add_action('wp_head','banner_head');
	add_action('admin_bar_menu','banner_menu',999);
	add_action('admin_init', 'banner_admin_init');
	add_action('admin_enqueue_scripts', 'banner_admin_scripts' );
	add_action('admin_menu', 'banner_admin_menu');
	add_action ( 'admin_enqueue_scripts', function () {
        if (is_admin ())
            wp_enqueue_media (); //for getting "Add Media" button
    } );
	add_action('widgets_init', create_function('', 'return register_widget("WPbannerWidget");'));
	add_filter('mce_external_plugins', 'banner_mce_plugin');
	add_filter('mce_buttons_2', 'register_bannermce_button');
	// Attach callback to 'tiny_mce_before_init' 
   add_filter( 'tiny_mce_before_init', 'banner_mce_init' );
   add_filter('the_content','banner_content_filter');
	add_shortcode('wpbanner','banner_ShortCodeHandler');
	
	add_action('wp_ajax_wpbanner','ajax_banner_clicks');
	add_action('wp_ajax_nopriv_wpbanner','ajax_banner_clicks');
	
   add_filter("plugin_action_links_".WP_PLUGIN, 'banner_settings_link' );
   
	register_activation_hook(__FILE__,'banner_install');
 	add_action( 'plugins_loaded', 'banner_upgradeCheck' );
 	add_action( 'admin_print_footer_scripts', 'banner_add_quicktags' );
	
?>