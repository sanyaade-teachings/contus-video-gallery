<?php
/*
  Name: Wordpress Video Gallery
  Plugin URI: http://www.apptha.com/category/extension/Wordpress/Video-Gallery
  Description: AdsXML file for player.
  Version: 2.3
  Author: Apptha
  Author URI: http://www.apptha.com
  License: GPL2
 */
/* Used to import plugin configuration */
require_once( dirname(__FILE__) . '/hdflv-config.php');
## get the path url from querystring
$playlist_id        = $_GET['pid'];
global $wpdb;
$title              = 'hdflv Adslist';
$themediafiles      = array();
$limit              = '';
## Get video details from database
$selectPlaylist     .= "SELECT * FROM " . $wpdb->prefix . "hdflvvideoshare_vgads WHERE publish=1";
$adsFiles           = $wpdb->get_results($wpdb->prepare($selectPlaylist));
$themediafiles      = $adsFiles;
ob_clean();
header ("content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<ads >';
if (count($themediafiles) > 0) {
    foreach ($themediafiles as $rows) {
        $admethod   = $rows->admethod;
        if ($admethod == 'prepost') {       ## Allow only for preroll or post roll ads
        $postvideo  = $rows->file_path;
        echo    '<ad id="' . $rows->ads_id . '" url="' . $postvideo . '" >';
        echo    '<![CDATA[' . $rows->description . ']]>';
        echo    '</ad>';
        }
    }
}
echo '</ads>';
?>