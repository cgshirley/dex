<?php

class User extends Controller {

	var $data;

	function __construct()
	{
		parent::__construct();
	}
	function login()
	{
		if(!empty($_POST))
		{			
			if($this->auth->login())
			{
				redirect('');
			}
			else
			{
				$this->_login_form( "Incorrect email/password combination.", $_POST['email'] );
			}
		}
		else
		{
			$this->_login_form();
		}
	}
	function logout()
	{
		$this->auth->logout();
		redirect('goodbye');
	
	}
	function goodbye()
	{
		$this->data['title'] = "Goodbye!";
		$this->load->view('header', $this->data);
		$this->load->view('user/logout', $this->data);
	}
	function restricted()
	{
		$this->data['title'] = "Access Restricted";
		$this->load->view('header', $this->data);
		$this->load->view('restricted');
	}
	function _login_form( $error = NULL, $email = NULL )
	{
		if ( !empty($error)) $this->data['error'] = $error;
		if ( !empty($email)) $this->data['email'] = $email;
		$this->data['title']="Login";
		$this->load->view('header', $this->data);
		$this->load->view('user/login', $this->data);
	}
}
?>