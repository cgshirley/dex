<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*	DEX specific configuration options are configured via this file. 
*/

$config['url_root'] = "http://localhost/wybc/";
$config['url_img'] = "http://localhost/wybc/assets/images/";
$config['path_root'] = "/Applications/XAMPP/xamppfiles/htdocs/wybc/";
$config['path_img'] = "/Applications/XAMPP/xamppfiles/htdocs/wybc/assets/images/";

// must be set (mbs) - path to the named pipe that the recording program listens on
$config['recording_listener_fifo'] = "/bzzz/wrong";
// optional - map generic names to urls for the recording library
// invoking the "Go Live" feature uses "go_live_default" to figure out its
// url
$config['recording_url_maps'] = array("go_live_default" => "http://SET/ME");

/* End of file dj.php */
/* Location: ./system/application/config/dj.php */
