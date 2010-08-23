<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* IMPORTANT: DEPENDENCIES NOTE
 * This library works with the WYBC recording system, and requires
 * config items:
 * 'recording_listener_fifo' -- location of the named pipe the daemon is listening to
 */

class Recording
{
    protected $ci;
    
    public function __construct()
    {
    	  $fifo = $this->config->item('recording_listener_fifo');
        if(empty($fifo))
        {
            show_error("DEX Error: you must set the recording_listener_fifo config item");
        }
        $this->ci =& get_instance();
    }
    
    /**
     *	Starts a recording.
     * 	This function makes you give a duration even though the recording 
     *	backend has it optional.
     *
     *	@param $url full URL to the streaming audio resource (HTTP, RTSP, among others work)
     *	@param $filename filename (with extension) to write to
     *	@param $duration an associative array with 'hours', 'minutes', and 'seconds' set specifying length to record
     *	@return TRUE on success
     */
    public function record($url, $filename, $duration, $codec = NULL)
    {
        if (is_array($duration))
        {
            $timespec = sprintf("%02d:%02d:%02d", $duration['hours'], $duration['minutes'], $duration['seconds']);
        }
        else
        {
            $timespec = $duration; // accept as-is...
        }
        $fp = fopen($this->config->item('recording_listener_fifo'), "w");
        if ($fp)
        {
            flock($fp, LOCK_EX);
            fprintf($fp, "url %s\nfilename %s\nduration %s\n", $url, $filename, $duration);
            if ($codec)
            {
                fprintf($fp, "codec %s\n", $codec);
            }
            fprintf($fp, "done\n");
            flock($fp, LOCK_UN);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     *	Maps a resource name to a URL.
     *	to use this function you have to set the recording_url_maps 
     *	configuration item to an associative array, like thus:
     * 	$config['recording_url_maps'] = array("generic_name" => "http://specific/url/", ...);
     *
     * 	@param $resource generic resource name
     * 	@return specific URL, or NULL if the configuration array isn't set
     */
    public function whatis($resource)
    {
        $maps = $this->config->item('recording_url_maps');
       
        if(empty($maps))
        {
            return NULL;
        }
        else
        {
            return $maps[$resource];
        }
    }
}
?>