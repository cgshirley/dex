<?php

class Admin extends Controller {

var $data;

function Admin()
	{
		parent::Controller();
		$this->load->helper('url');
		$this->auth->restrict(100);
	}
	function index()
	{
		$this->data['title']="Admin";
		$this->load->view('header', $this->data);
		$this->load->view('admin/index', $this->data);
	}
	function pages( $method = NULL, $id = NULL )
	{
		if($method=="edit"&&!empty($id))
		{
			$query = $this->db->where('id', $id)->get('page_content');
			$this->data['content'] = $query->row();
			$this->data['type'] = $this->data['content']->group;
			$this->data['title'] = "Editing ".$this->data['content']->title;
			$this->data['ckeditor'] = TRUE;
			$this->load->view('header', $this->data);
			$this->load->view('admin/pages/edit', $this->data);
		}
		elseif($method == "save")
		{
			$data = array("body"=>$_POST['body']);
			if(!empty($_POST['subject'])) $data['subject'] = $_POST['subject'];
			$this->db->where('id', $_POST['id'])->update('page_content', $data);
			$this->session->set_flashdata('success', 'Content updated successfully.');
			redirect('admin/pages');
		}
		else
		{
			if(!empty($method))
				$query = $this->db->where('group',$method)->get('page_content');
			else
				$query = $this->db->get('page_content');
			$this->data['pages'] = $query->result();
			$this->data['title'] = "Manage Page Content";
			$this->data['js'][] = "jquery-datatables.php";
			$this->data['css'][] = "datatables.css";			
			$this->load->view('header', $this->data);
			$this->load->view('admin/pages/list', $this->data);
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/settings.php */