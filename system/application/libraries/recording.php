<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recording
{
	
	protected $ci;
	var $port = 10500;
	var $address = "10.13.40.3"; //gethostbyname('starscream.wybc.com');
	var $errors = array();
	
	var $inputs = array (		"x"=>0,
						"moon"=>1,
						"am"=>2,
						"auto"=>3 );
	var $outputs = array (	"x"=>0,
						"am"=>1,
						"aux1"=>2,
						"aux2"=>3 );

	
	public function __construct()
	{
		$this->ci =& get_instance();
	}
	public function bias( $command, $output, $input, $length )
	{
		$data = "ROUTES ".$command." ".$output." ".$input." ".$length." BIAS\r\n";
		$this->tcp($this->address, $this->port, $data);
	}
	function tcp( $address, $port, $data )
	{
		
		$return = '';
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($socket === false)
		{
			$this->errors[] = "socket_create() failed: reason: " . socket_strerror(socket_last_error());
			return false;
		}
		$result = socket_connect($socket, $address, $port);
		
		if ($result === false)
		{
			$this->errors[] = "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket));
			return false;
		}
		
		socket_write($socket, $data, strlen($data));
		while ($out = socket_read($socket, 2048)) 
		{
			echo $out;
		}
		socket_close($socket);
		return true;
	}
	
	function record( $input, $outputs, $files, $episode_id = NULL)
	{
		// Validate inputs and outputs
		if(!isset($this->inputs[$input]))
			$this->errors[] = "Invalid Input: ".$input;
			
		foreach ( $outputs as $val )
		{
			if(!isset($this->outputs[$val]))
				$this->errors[] = "Invalid Output: ".$val;
		}
		
		if ( count($this->errors)>0)
		{
			print_r($this->errors);
			return false;
		}
		$cmd = "ROUTES ";
		$cmd .= "dev:".$this->inputs[$input]." ";
		foreach ($outputs as $val)
		{
			$cmd .= "dev:".$this->outputs[$val]." ";
		}
		
		foreach ($files as $val)
		{
			if ( $val=="auto") $val = $this->filename($episode_id);
			$data = array ( "episode_id"=>$episode_id, "created"=>date("Y-m-d H:i:s"), "filename"=>$val);
			$this->ci->db->insert('archives', $data);
			$cmd .= "file:".$val.".raw ";
		}
		$cmd .= "\r\n";
		$this->tcp($this->address, $this->port, $cmd);
		print_r($this->errors);
	}
	function filename( $episode = NULL )
	{
		if(empty($episode)) $episode = $this->ci->uri->segment(3);
		$query = $this->ci->db->where('episode_id', $episode)->order_by('id', 'desc')->get('archives');
		if ( $query->num_rows > 0 )
		{
			$answer = $query->row();
			$old = $answer->filename;
			$bits = explode("-",$old);
			echo $bits[1];
			if(empty($bits[1])) $ext = "1";
			else $ext = $bits[1] + 1;
			return $episode."-".$ext;
		}
		return $episode;
	}
		
	/*
	ROUTES CMD ARG 1... ARG n \r\n
	
	200 ok
	300 illegal param
	301 not enough params
	302 not a routes request
	403 device busy / try again
	500 fatal error
	
	start( input device, output device n, output device n+1...[] )
	
	routes/1.1 200 ok
	pid: [process number]
	exec-str: [command string used to execute command]
	
	
	stop( input device ) // which input device to silence. stops both output and recordings.
	
	routes/1.1 200 ok
	
	
	query( device ) // reports process id, string used to execute command (drop first three words, look at rest)
	
	200 ok
	dev:0
	pid: [process number]
	exec-str: [command string used to execute command]
	dev:1
	pid: [process number]
	exec-str: [command string used to execute command]
	
	
	
	
	stoprecs( input device ) // stops just the recordings from this input device
	
	routes/1.1 200 ok
	


	dev:0 or dev:1 or dev:2 or dev:3
	file:example
	
	
	
	
	
	
	
	
	
		*/
}