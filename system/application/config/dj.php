<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*	DEX specific configuration options are configured via this file. 
*/

$config['url_img'] = "http://localhost/wybc/assets/images/";
$config['path_img'] = "/Applications/XAMPP/xamppfiles/htdocs/wybc/assets/images/";

// set the default language
$config['default_language'] = "en-us";

// configuration options for the recording listener. set these only if you are using
// the WYBC recording backend.
$config['use_recording'] = TRUE;
$config['recording_listener_fifo'] = "/bzzz/wrong";
$config['recording_url_maps'] = array("go_live_default" => "http://SET/ME");

// configuration for the podcasting system. set if you are going to use the WYBC podcasting
// backend
$config['use_wybc_podcasting'] = TRUE;
$config['wybc_podcasting_export_dir'] = '/set/me';

/* End of file dj.php */
/* Location: ./system/application/config/dj.php */

