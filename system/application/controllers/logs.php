<?php

class Logs extends Controller {

	var $data;

	function __construct()
	{
		parent::__construct();
		$this->auth->restrict('dj');
		$this->load->model('logs_model');
		$this->data['js'] = array();
		$this->data['css'] = array();
		$this->data['js'][] = "jquery-form.js";
		$this->data['js'][] = "jquery-datatables.php";
		
		$this->data['css'][] =  "smoothness/jquery-ui.css";
		$this->data['css'][] = "datatables.css";
	}
	function index()
	{
		$this->data['title']="Engineering Logs";
		$this->load->view('header', $this->data);
		$this->load->view('logs/index', $this->data);
		$this->load->view('footer', $this->data);
	}
	function tickets()
	{
		if( $this->uri->segment(3) == "unresolved" )
		{
			$filter = 'unresolved';
			$this->data['title']="Unresolved Tickets";
			$this->data['headline'] = "Unresolved Tickets";
		}
		elseif( $this->uri->segment(3) == "x" )
		{
			$filter = 'x';
			$this->data['title']="Tickets from the X";
			$this->data['headline'] = "Tickets from the X";
		}
		else //( $this->uri->segment(3) == "all" )
		{
			$filter = 'all';
			$this->data['title']="All Tickets";
			$this->data['headline'] = "View All Tickets";
		}
		
		$this->data['tickets'] = $this->logs_model->load_tickets($filter);
		$this->load->view('header', $this->data);
		$this->load->view('logs/tickets', $this->data);
		$this->load->view('footer', $this->data);
	}
	function ticket()
	{
		if ( $this->uri->segment(3) == "edit" )
		{
			if(empty($_POST))
				$this->_edit_ticket();
			else
				$this->_new_response();
		}
		elseif ( $this->uri->segment(3) == "new" )
		{
			$this->_new_ticket();
		}
	}
	function ajaxData( $method )
	{
		switch($method)
		{
			case "disable_ticket":
				$this->db->where('ticket_id', $_POST['ticket_id'])->update('logs_tickets', array("disabled"=>1));
				break;
		}
	}
	function _edit_ticket()
	{
		
		$this->data['js'][] = 'colorbox.js';
		$this->data['css'][] = 'colorbox.css';
		$this->data['title'] = "View & Edit Ticket";
		$info = $this->logs_model->load_ticket($this->uri->segment(4));
		$this->data['ticket'] = $info['ticket'];
		$this->data['responses'] = $info['responses'];
		$this->load->view('header', $this->data);
		$this->load->view('logs/ticket', $this->data);
		$this->load->view('footer', $this->data);
	}
	function _new_ticket()
	{
		$this->data['title'] = "New Ticket";
		$this->data['headline'] = "New Ticket";
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->data['admin'] = TRUE;
		$this->load->view('header', $this->data);
		$this->load->view('help/ticket', $this->data);
		$this->load->view('footer', $this->data);
	}
	function _new_response()
	{
		$this->logs_model->new_response();
		$this->_edit_ticket();
	}
	
}