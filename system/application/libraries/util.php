<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util
{
	// Basic properties
	protected $ci;
	

	public function __construct()
	{
		$this->ci =& get_instance();
	}
	
	function setting ( $item )
	{
		$q = $this->ci->db->where('name', $item)->get('settings');
		$r = $q->row();
		return $r->value;
	}
	function page ( $item )
	{
		$q = $this->ci->db->where('name', $item)->get('page_content');
		$r = $q->row();
		if(!empty($r))
			return $r->body;
		else
			return false;
	}
	function email ( $name, $type = 'body')
	{
		$q = $this->ci->db->where('name', $name)->get('page_content');
		$r = $q->row();
		if(!empty($r))
		{
			if($type=="body")
			{
				return $r->body;
			}
			elseif($type=="subject")
			{
				return $r->subject;
			}
		}
		else
		{
			return false;	
		}
	}
	function do_post_request($url, $data, $optional_headers = null,$getresponse = false) 
	{
      		$params = array('http' => array(
                   'method' => 'POST',
                   'content' => $data
                ));
      		if ($optional_headers !== null) 
      		{
        		 $params['http']['header'] = $optional_headers;
      		}
      		$ctx = stream_context_create($params);
      		$fp = @fopen($url, 'rb', false, $ctx);
     		if (!$fp) 
     		{
        		return false;
      		}
		if ($getresponse)
		{
			$response = stream_get_contents($fp);
			return $response;
		}
      		return true;
	}
}
