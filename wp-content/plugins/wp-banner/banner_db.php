<?php
// if (!file_exists('../../../wp-config.php')) die ('wp-config.php not found');
// require_once('../../../wp-config.php');


function banner_clients()
{
   global $wpdb, $table_prefix;
    
    $query = "SELECT banner_clientname FROM ". $table_prefix."banner";
    $result = $wpdb->get_results($query);
//     echo json_encode($result);
    return(json_encode($result));
}
 function banner_update()
 {
   global $wpdb, $table_prefix, $start_date, $end_date;

   if ($_POST['banner_type'] != "Text")
      bannerCheckImageType();
   
   $cli =  $_POST['client_name'];
   
   $query= "UPDATE ".$table_prefix."banner SET banner_clientname='".$cli."', banner_clickurl='".$_POST['click_url']."', banner_impurchased='".$_POST['impressions_purchased']."', banner_startdate='".$_POST['banner_startdate']."', banner_enddate='".$_POST['banner_enddate']."',banner_active='   ".$_POST['banner_enabled']."', banner_url='".$_POST['banner_url']."', banner_size='".$_POST['banner_size']."',banner_type='".$_POST['banner_type']."',banner_position='".$_POST['banner_position']."',banner_price='".$_POST['banner_price']."', banner_rate='".$_POST['banner_rate']."', banner_sticky='".$_POST['banner_sticky']."' WHERE banner_id='".$_POST['eid']."' ";
  
   $wpdb->query($query);
 }
 
 function banner_new()
 {
    global $wpdb,  $table_prefix, $start_date, $end_date;
    
    if ($_POST['banner_type'] != "Text")
      bannerCheckImageType();
    
    $cli =  $_POST['client_name'];
    
    $query = "INSERT INTO ".$table_prefix."banner VALUES(0, '".$cli."', '".$_POST['click_url']."', '".$_POST['impressions_purchased']."', '$start_date', '$end_date', '".$_POST['banner_enabled']."', 0, 0, '".$_POST['banner_url']."','".$_POST['banner_size']."','".$_POST['banner_type']."','".$_POST['banner_position']."','".$_POST['banner_price']."' ,'".$_POST['banner_rate']."','".$_POST['banner_sticky']."')";
       $wpdb->query($query);
 }
 
 function bannerGetData()
 {
    global $wpdb, $table_prefix;
    
    $query = "SELECT * FROM ". $table_prefix."banner";
    $result = $wpdb->get_results($query, ARRAY_A);
    
   if ( is_array($result)){   return $result;} else{  return false;}
 }

 
 function bannerGetClientData($client)
 {
        global $wpdb, $table_prefix;
        $query = "SELECT * FROM ". $table_prefix."banner WHERE banner_clientname =\"$client\"";
        $result = $wpdb->get_row($query, ARRAY_A);
        
         if ( is_array($result)){   return $result;} else{  return false;}
 }
 
 function bannerGetPosts()
 {
   global $wpdb, $table_prefix;
   $query = "SELECT ID FROM ". $table_prefix."posts WHERE post_status=\"publish\" AND post_type=\"post\" ORDER BY ID LIMIT 0,6";
   $result = $wpdb->get_results($query, ARRAY_A);
   if ( is_array($result)){   return $result;} else{  return false;}
 }
 
 function bannerDelete()
 {
    global $wpdb, $table_prefix;
    
   $query = "DELETE FROM ".$table_prefix."banner WHERE banner_id =  \"".$_POST['eid']."\"";
   $wpdb->query($query);
 }
 
 
?>