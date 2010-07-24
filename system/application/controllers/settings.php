<?php

class Settings extends Controller {

var $data;
var $member_id;
var $user_id;

function Settings()
	{
		parent::Controller();
		$this->load->helper('url');
		$this->auth->restrict(1);
		$this->data['css'][] =  "smoothness/jquery-ui.css";
		$this->load->library('member_management');
		$this->member_id = $this->session->userdata('member_id');
		$this->user_id = $this->session->userdata('user_id');
	}
	function index()
	{
		$this->data['title']="Settings";
		$this->load->view('header', $this->data);
		$this->load->view('settings', $this->data);
		$this->load->view('footer', $this->data);
	}
	function password()
	{
		if(!empty($_POST))
		{
			if($_POST['new'] != $_POST['confirm'])
			{
				$this->data['alert'] = "<p class='error'>Please make sure that the two new passwords match.</p>";
				$this->_password();
			}
			else
			{
				$this->load->library('drupal');
				$user_sql = "SELECT * FROM users WHERE uid=".$_POST['user_id'];
				$user_query = $this->drupal->api_call($user_sql);
				
				if(md5($_POST['existing']) != $user_query[0]['pass'])
				{
					$this->data['alert'] = "<p class='error'>Please enter the correct existing password.</p>";
					$this->_password();
				}
				else
				{
					$newdata = array('pass' => md5($_POST['confirm']));
					$where = array("uid"=>$_POST['user_id']);
					$sql = $this->db->update_string('users', $newdata, $where);
					$this->drupal->api_call($sql);
					$this->data['alert'] = "<p class='success'>Password Successfully Changed.</p>";
					$this->_password();
				}
			}
		}
		else
		{
			$this->_password();
		}
	}
	function profile()
	{
		if(!empty($_POST))
		{
			$revisions = array ("body"=>$_POST['bio'], "teaser"=>$_POST['bio'], "title"=>$_POST['name']);
			$profile = array ( "field_status_value"=>$_POST['status'], "field_hometown_value"=>$_POST['hometown']);

			$revision_data = array_merge($revisions, $profile);
			$revision_data['nid'] = $_POST['nid'];
			$revision_id = $this->member_management->save_revision( $_POST['member_id'], $revision_data, "profile");

			$update_data['revision_id'] = $revision_id;
			$this->load->library('notify');
			$this->notify->save("dj_profile_updated", $this->member_id, $update_data);
			
			$this->session->set_flashdata('success', 'DJ Profile changes submitted for approval.');
			redirect('settings/profile');
		}
		else
		{
			$this->_profile_form();
		}
	}
	
	function data()
	{
		$this->data['title'] = 'Edit Your Member Data | WYBC';
		$this->data['teams'] = $this->member_management->lister('teams');
		$this->data['interests'] = $this->member_management->lister('interests');
		$this->data['statii'] = $this->member_management->lister('status');
		$this->data['revisions'] = $this->member_management->lister('revisions', $this->member_id);
		$this->data['attendence'] = $this->member_management->fetch_attendence($this->member_id);
		$this->data['edit'] = FALSE;
		$this->data['add'] = FALSE;
		
		$this->data['js'][] = 'songtracker-ui.php';
		$this->data['js'][] = 'jquery-ui-accordion.js';
		
		$this->data['members'] = $this->member_management->member_data($this->member_id);
		
		// Application type
		$this->data['undergrad'] = FALSE;
		$this->data['associate'] = FALSE;
		$this->data['affiliate'] = FALSE;
		if ( $this->data['members']['undergrad'] == 1 ) $this->data['undergrad'] = TRUE;
		elseif ( $this->data['members']['undergrad'] == 2 ||  $this->data['members']['undergrad'] == 3 ) $this->data['affiliate'] = TRUE;
		elseif ( $this->data['members']['undergrad'] == 0 ) $this->data['associate'] = TRUE;

		
		$this->load->view('header', $this->data);
		$this->load->view('roster/edit', $this->data);
		$this->load->view('footer', $this->data);
	}
	function squads( $id = NULL, $id2 = NULL )
	{
		if($id=="delete_member")
		{
			$member_id = $_POST['member_id'];
			$this->db->where('team_id', $id2)->where('member_id', $member_id)->delete('team_roster');
			
			$this->notify->save('member_squad_removal', $member_id, array('team_id'=>$id2));
		}
		elseif(!empty($id))
		{
			$squad_query = $this->db->where('team_id', $id)->get('team_data');
			$this->data['squad'] = $squad_query->row_array();
			$members_query = $this->db->from('team_roster AS t ')->where('team_id', $id)->where('m.status_id',6)->join('member_data AS m ', 'm.member_id=t.member_id')->get();
			$this->data['members'] = $members_query->result_array();
			$this->load->view('settings/squad_details', $this->data);
		}
		else
		{
			if(!empty($_POST))
			{
				$squads = $this->member_management->save_teams( $_POST['team'], $this->member_id );

				foreach($squads['added'] as $squad)
				{
					$this->notify->save('member_squad_self_addition', $this->member_id, array('team_id'=>$squad));
				}
				foreach($squads['removed'] as $squad)
				{
					$this->notify->save('member_squad_self_removal', $this->member_id, array('team_id'=>$squad));
				}
								
				$this->session->set_flashdata('success', 'Squads Updated.');
				
				redirect('settings/squads');
				
			}
			else
			{
				$this->data['title'] = "Manage Squads";
				$member_data = $this->member_management->member_data( $this->member_id );
				$this->data['teams'] = $member_data['teams'];
				$this->data['team_list'] = $this->member_management->lister('teams');
				$mysquads_query = $this->db->where('team_leader', $this->member_id)->get('team_data');
				if($mysquads_query->num_rows>0)
				{
					$this->data['mine'] = $mysquads_query->result_array();
				}
				$this->data['js'][] = 'jquery-validate.php';
				$this->data['js'][] = 'colorbox.js';
				$this->data['js'][] = "jquery-datatables.php";
				$this->data['css'][] = 'colorbox.css';
				$this->data['css'][] = 'datatables.css';
				$this->load->view('header', $this->data);
				$this->load->view('settings/squads', $this->data);
				$this->load->view('footer', $this->data);
			}
		}
	}
	function _password()
	{
		$this->data['title'] = "Change Your Password";
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->load->view("header", $this->data);
		$this->load->view("settings/password", $this->data);
		$this->load->view('footer', $this->data);
	}
	function _profile_form()
	{
		$this->data['title'] = "Edit Your DJ Profile";
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->data['member_id'] = $this->session->userdata('member_id');
		$this->data['ckeditor'] = TRUE;
		$this->data['profile'] = $this->drupal->load_profile($this->data['user_id']);
		$this->load->view("header", $this->data);
		$this->load->view("settings/profile", $this->data);
		$this->load->view('footer', $this->data);

	}
	
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
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/settings.php */