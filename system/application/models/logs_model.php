<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_model extends Model
{
	
	protected $ci;
	
	public function __construct()
	{
		$this->ci =& get_instance();
	}
	public function add_ticket()
	{
		$description = $_POST['description'];
		$summary = $_POST['summary'];
		$author_id  = $_POST['author_id'];
		if ( !empty( $_POST['urgent']) )
			$priority = 10;
		else $priority = NULL;
		$created = date("Y-m-d H:i:s", time());
		$studio = $_POST['studio'];
		$data = array ( "description" => $description,
					"summary"=>$summary,
					"author_id"=>$author_id,
					"priority"=>$priority,
					"created"=>$created,
					"studio"=>$studio);
		$this->db->insert("logs_tickets",$data);
	}
	public function load_tickets( $filter )
	{
		$where = array();
		switch ( $filter )
		{
			case "unresolved":
				$where['resolution_id'] = NULL;
				break;
			case "x":
				$where['studio'] = 'X';
				break;
		}
		$where['disabled'] = 0;
		$q = $this->ci->db->where($where)->get('logs_tickets');
		$r = $q->result_array();
		return $q->result_array();
	}
	function load_ticket ( $id )
	{
		$ticket_q = $this->ci->db->where('ticket_id', $id)->get("logs_tickets");
		$responses_q = $this->ci->db->where('ticket_id', $id)->get("logs_responses");
		$responses = $responses_q->result_array();
		$ticket = $ticket_q->row_array();
		$responses_f = array();
		
		$author_q = $this->db->select("first_name, last_name")->where('drupal_id', $ticket['author_id'])->get("member_data");
		$author_r = $author_q->row_array();
		$ticket['author'] = $author_r['first_name']." ".$author_r['last_name'];
		
		foreach($responses as $key=>$val)
		{
			$author_q = $this->db->select("first_name, last_name")->where('drupal_id', $val['author_id'])->get("member_data");
			$author_r = $author_q->row_array();
			$val['author'] = $author_r['first_name']." ".$author_r['last_name'];
			$responses_f[] = $val;
		}
		return array("ticket"=>$ticket, "responses"=>$responses_f);
	}
	function new_response()
	{
		$data = array(	"author_id"=>$this->session->userdata('user_id'),
					"created"=>date("Y-m-d H:i:s"),
					"ticket_id"=>$_POST['ticket_id'],
					"response"=>$_POST['response']);
		if(!empty($_POST['resolution'])) $data['resolution']="1";
		$this->db->insert('logs_responses', $data);
		if(!empty($_POST['resolution']))
			$this->db->where('ticket_id', $_POST['ticket_id'])->update('logs_tickets',array('resolution_id'=>$this->db->insert_id()));
	
	}
}