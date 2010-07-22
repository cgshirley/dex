<?php

class Help extends Controller {

var $data;

function __construct()
	{
		parent::__construct();
		$this->auth->restrict('dj');
	}
	function index()
	{
		$this->data['title']="WYBC DJ Central";
		$this->load->view('header', $this->data);
		$this->load->view('help/index', $this->data);
	}
	function ticket()
	{	
		$this->load->model('logs_model');
		if( !empty($_POST))
		{
			$this->logs_model->add_ticket();
			$this->_ticket_success();
		}
		else
		{
			$this->_ticket_form();
		}	
	}
	function tickets()
	{
		$this->data['title'] = "Unresolved Tickets";
		$this->data['headline'] = "Unresolved Tickets";
		$this->data['admin'] = FALSE;
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('header', $this->data);
		$this->load->view('help/tickets', $this->data);		
	}
	function _ticket_form()
	{
		$this->data['js'][] = 'jquery-validate.php';
		$this->data['title'] = "Get Help Now";
		$this->data['headline'] = "Get Help Now";
		$this->data['admin'] = FALSE;
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->load->view('header', $this->data);
		$this->load->view('help/ticket', $this->data);
	}
	function _ticket_success()
	{
		$this->data['title'] = "Ticket Successfully Submitted";
		$this->load->view('header', $this->data);
		$this->load->view('help/ticket_success', $this->data);
	}
}