<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
	// Basic properties
	protected $ci;
	var $u;
	var $errors;
	var $db;
	var $user_id;
	var $roles = array();
	var $level = 0;
	var $email;
	var $DB;
	
	
	// Access levels & roles
	
	// LOCAL INSTALL ROLES
	/*var $levels = array(		'1' => array('level' =>'0', 'name' =>'anonymous user'),
						'2' => array('level' =>'1', 'name' =>'authenticated user'),
						'3' => array('level' =>'10', 'name' =>'dj'),
						'4' => array('level' => '20', 'name'=>'editor'),
						'5' => array('level' => '100', 'name'=>'admin')
					);*/
	// LIVE SITE ROLES
	var $levels = array(		'1' => array('level' =>'0', 'name' =>'anonymous user'),
						'2' => array('level' =>'1', 'name' =>'authenticated user'),
						'3' => array('level' =>'10', 'name' =>'dj'),
						'4' => array('level' => '20', 'name'=>'editor'),
						'5' => array('level' => '100', 'name'=>'board of directors'),
						'6' => array('level' => '20', 'name'=>'Sports editor'),
						'9' => array('level' =>'10', 'name' =>'Sports Dept'),
						'10' => array('level' =>'10', 'name' =>'Records Dept'),
						'11' => array('level' =>'10', 'name' =>'Events Dept'),
						'12' => array('level' =>'100', 'name' =>'admin'),
						'13' => array('level' =>'100', 'name' =>'PD'),
						'14' => array('level' =>'100', 'name' =>'Super'),
					);
	
	public function __construct()
	{
		$this->ci =& get_instance();
		
		// Connect to drupal.
		$this->ci->load->library('drupal');
		$this->DB =  $this->ci->drupal->db();
	}
	
	public function register()
	{
	
	}
	public function login()
	{
		$this->email = $this->ci->input->post('email');
		$password = $this->ci->input->post('password');
		
		if($this->_verify_email($this->email,  $password, 'drupal'))
		{
			$this->new_session();
			return true;
		}
		else
		{
			return $this->errors;
		}
	}
	public function logout()
	{
		$this->ci->session->sess_destroy();
		//setcookie('ci_session');
		//redirect('goodbye');
	}
	
	protected function new_session()
	{
		$this->_set_level();
		
		$q = $this->ci->db->where('drupal_id', $this->user_id)->get('member_data');
		$r = $q->row();

		$userdata = array ( 	'logged_in' => TRUE,
						'roles'=>implode("&", $this->roles),
						'level'=>$this->level,
						'user_id'=>$this->user_id,
						'member_id'=>$r->member_id,
						'email'=>$this->email,
						'username' => $this->name
						);
		// Save to userdata array
		$this->ci->session->set_userdata($userdata);
		return TRUE;
	}
	protected function _set_level()
	{
		$roles = $this->ci->drupal->get_roles( $this->user_id);
		
		// UNCOMMENT TO REVERT TO LOCAL DRUPAL
		/*
		$roles = $this->DB->where('uid', $this->user_id)->get('users_roles');
		foreach($roles->result() as $val)
		*/
		
		// COMMENT OUT TO REVERT TO LOCAL DRUPAL
		foreach($roles as $val)
		// STOP HERE
		
		{
			if($this->level < $this->levels[$val->rid]['level'])
			{
				$this->level = $this->levels[$val->rid]['level'];
			}
			$this->roles[] = $val->rid;
		}
	}
	protected function _verify_email( $email, $password, $system)
	{
		if($system!="drupal") return false;
		
		// UNCOMMENT TO REVERT TO LOCAL DRUPAL
		/*
		//Query DB
		$where = array ( 'mail' => $email, 'pass' => md5($password));
		$query = $this->DB->where($where)->get('users');
		if($query->num_rows!=1) return false;
		*/
		
		// COMMENT OUT TO REVERT TO LOCAL DRUPAL
		$query = $this->ci->drupal->verify_user($email, md5($password));
		if ( !$query ) return false;	
		// STOP HERE
		
		
		//Pass
		else 
		{	
			// UNCOMMENT TO REVERT TO LOCAL DRUPAL
			//$row = $query->row();
			
			// COMMENT OUT TO REVERT TO LOCAL DRUPAL
			$row = $query[0];
			// STOP HERE
			$this->name = $row->name;
			$this->user_id = $row->uid;
			return true;
		}
	}
	/*
	*
	*	AUTHORIZATION FUNCTIONS
	*
	*/
	public function validate( $min = NULL )
	{
		if($this->ci->session->userdata('level')) $level = $this->ci->session->userdata('level');
		else $level = 0;
		
		if(!is_numeric($min))
		{
			foreach($this->levels as $key=>$val)
			{
				if($min==$val['name'])
				{
					$min = $val['level'];
					break;
				}
			}
		}
		if ( $level >= $min )
			return true;
		else
			return false;
	}
	public function restrict ($min = NULL, $redirect = 'login')
	{
		
		if($this->validate($min))
		{
			return true;
		}
		else
		{
			if($this->ci->session->userdata('level'))
			{
				redirect('user/restricted');
			}
			else
			{
				redirect($redirect);
			}
		}
		
	}
}
