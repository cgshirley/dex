<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notify
{
	
	protected $ci;
	
	var $from_address;
	var $from_name;
	var $to;
	var $subject;
	var $body;
	var $user_id;
	var $template;
	var $u;
	var $view_dir;
	var $view;
	var $data;
	
	var $site_url;
	var $member_data;
	
	
	/*
	Fields to parse:
	{site_url}
	{name}
	{member_id}
	{revision_id}
	*/
	var $config = array (
				"dj_profile_updated" => array (
						"service"=>"roster",
						"title"=>"DJ Profile Updated",
						"message"=>"{name} updated their DJ Profile.",
						"url"=>"{site_url}/roster/revisions/{revision_id}",
						"email_alert"=>array(),
						"email_digest"=>array("sm")
				),
				"member_data_edited" => array(
						"service"=>"roster",
						"title"=>"Member Data Edited",
						"message"=>"Admin edited {name}'s member data.",
						"url"=>"{site_url}/roster/edit/{member_id}",
						"email_alert"=>array(),
						"email_digest"=>array()
				),
				"member_self_update"=>array(
						"service"=>"roster",
						"title"=>"Member Data Self-Update",
						"message"=>"{name} updated their member data.",
						"url"=>"{site_url}/roster/revisions/{revision_id}",						
						"email_alert"=>array(),
						"email_digest"=>array("sm")
				),
				"member_squad_addition"=>array(
						"service"=>"roster",
						"title"=>"Member Added to Squad",
						"message"=>"Admin added {name} to {squad_name}",
						"email_alert"=>array('squad_leader'),
						"email_digest"=>array("sm"),
						"parameter_one"=>"team_id"
				),
				"member_squad_removal"=>array(
						"service"=>"roster",
						"title"=>"Member Removed from Squad",
						"message"=>"Admin removed {name} from {squad_name}",
						"email_alert"=>array('squad_leader'),
						"email_digest"=>array("sm"),
						"parameter_one"=>"team_id"
				),
				"member_squad_self_addition"=>array(
						"service"=>"roster",
						"title"=>"Member Squad Self-Addition",
						"message"=>"{name} added himself to {squad_name}",
						"email_alert"=>array('squad_leader'),
						"email_digest"=>array("sm"),
						"parameter_one"=>"team_id"
				),
				"member_squad_self_removal"=>array(
						"service"=>"roster",
						"title"=>"Member Squad Self-Removal",
						"message"=>"{name} removed himself from {squad_name}",
						"email_alert"=>array('squad_leader'),
						"email_digest"=>array("sm"),
						"parameter_one"=>"team_id"
				),
				"new_application"=>array(
						"service"=>"roster",
						"title"=>"New Application",
						"message"=>"{name} submitted a new application.",
						"url"=>"{site_url}/roster/edit/{member_id}",			
						"email_alert"=>array("trainee"),
						"email_digest"=>array("sm", "training")
				),
				"new_member"=>array(
						"service"=>"roster",
						"title"=>"New Member",
						"message"=>"An admin added {name} as a member.",
						"url"=>"{site_url}/roster/edit/{member_id}",			
						"email_alert"=>array(),
						"email_digest"=>array("sm", "training")
				),
				"new_squad"=>array(
						"service"=>"roster",
						"title"=>"New Squad",
						"message"=>"New squad \"{squad_name}\" created.",
						"url"=>"{site_url}/roster/squads",
						"email_alert"=>array(),
						"email_digest"=>array("sm","gm"),
						"parameter_one"=>"team_id"
				),
				"request_update"=>array(
						"service"=>"roster",
						"title"=>"Data Updates Requested",
						"message"=>"Admin requested updates from {count} members.",
						"email_alert"=>array(),
						"email_digest"=>array("sm"),
						"parameter_one"=>"count",
						"parameter_two"=>"member_list"
				),
				"revision_approved"=>array(
						"service"=>"roster",
						"title"=>"Revision Approved",
						"message"=>"Admin approved a revision to {name}'s {type}.",
						"email_alert"=>array(),
						"email_digest"=>array("sm"),
						"parameter_one"=>"revision_id",
						"parameter_two"=>"type"
				),
				"revision_rejected"=>array(
						"service"=>"roster",
						"title"=>"Revision Rejected",
						"message"=>"Admin rejected a revision to {name}'s {type}.",
						"email_alert"=>array(),
						"email_digest"=>array("sm"),
						"parameter_one"=>"revision_id",
						"parameter_two"=>"type"
				),
				"squad_deleted"=>array(
						"service"=>"roster",
						"title"=>"New Squad",
						"message"=>"New squad \"{squad_name}\" created.",
						"url"=>"{site_url}/roster/squads",
						"email_alert"=>array(),
						"email_digest"=>array("sm","gm"),
						"parameter_one"=>"team_id"					
				),
				"squad_edited"=>array(
						"service"=>"roster",
						"title"=>"Squad Edited",
						"message"=>"Squad \"{squad_name}\" edited.",
						"url"=>"{site_url}/roster/squads",
						"email_alert"=>array(),
						"email_digest"=>array(),
						"parameter_one"=>"team_id"					
				),
				"status_updated"=>array(
						"service"=>"roster",
						"title"=>"Status Updated",
						"message"=>"{name}'s Status Updated to \"{status}\"",
						"email_alert"=>array(),
						"email_digest"=>array(),
						"parameter_one"=>"status"		
				)
				
	);
	
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('util');
		$this->site_url = $this->ci->util->setting('url');
	}

	/*
	function notifications( $type, $member_id, $otherdata = NULL )
	{
		$this->load->library('notify');
		$update = TRUE;
		if(!empty($member_id)) $member_data = $this->member_management->member_data( $member_id );
		switch($type)
		{
			case "dj_profile_updated":
				$update_data['title'] = "DJ Profile Updated";
				$update_data['message'] = $member_data['first_name']." ".$member_data['last_name']." updated their DJ profile.";
				
				// Send email
				$subject = $member_data['first_name']." ".$member_data['last_name']." has updated their data";
				$message = $member_data['first_name']." ".$member_data['last_name']." has edited their data. It is awaiting your review. You may view it at " . $this->util->setting('url')."/roster/edit/" . $member_id;
		
				$email[]= array(	"to"=>$this->util->setting('email_station_manager'),
								"subject"=>$subject,
								"message"=>$message);
				break;
			
			case "squads_updated":
				$update_data['title'] = "Squads Updated";
				$message = $member_data['first_name']." ".$member_data['last_name']." has updated their squads.";


			case "member_data_edited":
				$update_data['title'] = "Member Data Updated";
				$update_data['message'] = "An admin updated ".$member_data['first_name']." ".$member_data['last_name']."'s data.";
				
				break;
			
			case "member_self_update":
				$update_data['title'] = "Member Self-Update";
				$update_data['message'] = $member_data['first_name']." ".$member_data['last_name']." updated their own data.";
				
				// Send email
				$subject = $member_data['first_name']." ".$member_data['last_name']." has updated their data";
				$message = $member_data['first_name']." ".$member_data['last_name']." has edited their data. It is awaiting your review. You may view it at " . $this->util->setting('url')."/roster/edit/" . $member_id;
		
				$email[]= array(	"to"=>$this->util->setting('email_station_manager'),
								"subject"=>$subject,
								"message"=>$message);
				break;
			
			case "new_application":
				// Create update
				$update_data['title'] = "New Application";
				$update_data['message'] = $member_data['first_name']." ".$member_data['last_name']." submitted a new application.";
				
				// Send emails
				$subject = "New Application";
				$message_one = $member_data['first_name']." ".$member_data['last_name']." has submitted a new application. It is awaiting your review. You may view it at " . $this->util->setting('url')."/roster/edit/" . $member_id;
				
				// Load messages for the members based on app type
				if ( $member_data['undergrad'] == 0 || $member_data['undergrad'] == 2 || $member_data['undergrad'] == 3) 
					$message_two = $this->util->page('email_associate_app_received');
				else
					$message_two = $this->util->page('email_full_app_received');
				
				$email[]= array(	"to"=>$this->util->setting('email_station_manager'),
								"subject"=>$subject,
								"message"=>$message_one );
				$email[]= array(	"to"=>$this->util->setting('email_training_director'),
								"subject"=>$subject,
								"message"=>$message_one );
				$email[] = array(	"to"=> $member_data['email'],
								"subject" => "Application Received!",
								"message" => $message_two);
				break;
			
			case "new_member":
				$update_data['title'] = "New Member";
				$update_data['message'] = "An admin added ".$member_data['first_name']." ".$member_data['last_name']." as a member.";
				break;
				
			case "request_update":
				$update_data['title'] = "Updates Requested";
				$update_data['message'] = "An admin requested an update from ".count($otherdata)." members.";
				
				$message = $this->util->page('email_request_update');
				
				foreach($otherdata as $key=>$val)
				{
					$data = $this->member_management->member_data($val);
					$email[] = array(	"to"=> $data['email'],
									"subject" => "Please Update Your Member Data",
									"message" => $message);
				}
				$this->session->set_flashdata('success', 'Requested Data Updates from '.count($otherdata).' members.');
				$redirect = "roster/main";
				break;
			case "revision_approved":
				$update = FALSE;
				break;
			case "revision_rejected":
				$update = FALSE;
				break;
		}
		
		if($update)
		{
			$this->notify->update('roster', $type, $update_data['title'], $update_data['message']);
		}
		if(!empty($email))
		{
			foreach($email as $key=>$val)
			{
				$this->notify->robot_email($val['to'], $val['subject'], $val['message']);
			}
		}
		if(!empty($redirect))
		{
			redirect($redirect);
		}
	}	
	
	*/
	function save( $type, $member_id = '', $data = NULL )
	{
		$config = $this->config[$type];
		if(!empty($member_id))
			$this->member_data = $this->ci->member_management->member_data( $member_id );
		
		// Set parsing variables
		$parse['site_url'] = $this->site_url;
		if(!empty($member_id))
		{
			$parse['name'] = $this->member_data['first_name']." ".$this->member_data['last_name'];
			$parse['member_id'] = $this->member_data['member_id'];
		}
		if(!empty($data['revision_id']))
			$parse['revision_id'] = $data['revision_id'];
		if(!empty($data['team_id']))
		{
			$q = $this->ci->db->where('team_id', $data['team_id'])->get('team_data');
			$r = $q->row();
			$parse['squad_name'] = $r->team_title;
		}
		
		// Set things to parse
		$parseable = array("message", "url");
		
		// Parse that shit
		foreach($parseable as $item)
		{
			foreach($parse as $key=>$val)
			{
				if(!empty($config[$item]))
					$config[$item] = str_replace("{".$key."}", $val, $config[$item]);
			}
		}
		
		// Set url variable to avoid undefined index errors below
		if(!empty($config['url'])) $url = $config['url'];
		else $url = NULL;

		if(!empty($config['parameter_one'])) $parameter_one = $data[$config['parameter_one']];
		else $parameter_one = '';		
		
		if(!empty($config['parameter_two'])) $parameter_two = $data[$config['parameter_two']];
		else $parameter_two = '';		
		
		$this->update($config['service'], $type, $config['title'], $config['message'], $url, $member_id, $parameter_one, $parameter_two);
	}
	
	function update ( $service, $name, $title, $message, $url = '', $member_id = '', $parameter_one = '', $parameter_two = ''  )
	{
		$data = array ( "type"=>"update",
					"service"=>$service,
					"name"=>$name,
					"title"=>$title,
					"message"=>$message,
					"parameter_one"=>$parameter_one,
					"parameter_two"=>$parameter_two,
					"member_id"=>$member_id );
		if(!empty($url)) $data['url'] = $url;
		$this->ci->db->insert('updates', $data);
	}
	
	function mass ( $type, $to )
	{
		$subject = $this->ci->util->email($type, 'subject');
		$message = $this->ci->util->email($type, 'body');
		foreach ( $to as $id )
		{
			$data = $this->ci->member_management->member_data($id);
			$message = str_replace("{first_name}", $data['first_name'], $message);
			$message = str_replace("{name}", $data['first_name']." ".$data['last_name'], $message);
			$email = $data['email'];
			$this->robot_email($email, $subject, $message);
		}
	}

	function robot_email ( $to, $subject, $message, $html = TRUE )
	{
	
				
		$html_message = "<html><head><title>A Message From WYBC</title></head><body>";
		$html_message .= $message;
		$html_message .= "</body></html>";		
		
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'robot@wybc.com',
			'mailtype' => 'html',
			'smtp_pass' => 'nargo^%'
		);
		$this->ci->load->library('email', $config);
		$this->ci->email->set_newline("\r\n");
		
		$this->ci->email->from('robot@wybc.com', 'WYBC');
		$this->ci->email->to($to);
		
		$this->ci->email->subject("[WYBC] ".$subject);
		$this->ci->email->message($html_message);
		
		if (!$this->ci->email->send())
			return "Ooops! There has been an error. Please copy and paste following error message in an email to gm@wybc.com. Thanks!<br /><br />".show_error($this->ci->email->print_debugger());
	}
}
