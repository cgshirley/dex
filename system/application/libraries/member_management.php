<?php
class Member_management{
	
	var $CI;
    	var $title   = '';
    	var $content = '';
    	var $date    = '';
	var $root_path= "/Library/WebServer/Documents/roster/";
	var $admin_email = "training@wybc.com";
	var $drupal_path = "http://dev.wybcx.com";
	
	
	var $member_id;
	var $teams = array();
	var $member_data;
	
	var $fields = array (		
						"member_id" => "Member ID",
						"drupal_id" => "Drupal ID",
						"member_no" => "Member Number",
						"status_id"=>"Status ID",
						"membership"=>"Membership Type",
						"date_added"=>"Date Added",
						"undergrad"=>"Undergrad/Yale Affiliate/Community Member",
						"college"=>"Residential College",
						"class"=>"Class Year",
						"major"=> "Major",
						"first_name"=>"First Name",
						"middle_initial"=>"Middle Initial",
						"last_name"=>"Last Name",
						"home_address"=>"Home Address",
						"home_city"=>"Home City",
						"home_state"=>"Home State",
						"home_zip"=>"Home ZIP Code",
						"home_country"=>"Home Country",
						"phone_mobile"=>"Mobile Phone Number",
						"phone_home"=>"Home Phone Number",
						"phone_work"=>"Work Phone Number",
						"drivers_license_number"=>"Drivers License Number",
						"drivers_license_state"=>"Drivers License State",
						"yale_sid"=>"Yale SID",
						"email_yale"=>"Yale Email Address",
						"email_personal"=>"Personal Email Address",
						"us_citizen"=>"US Citizen?",
						"citizen_of"=>"Country of Citizenship",
						"profession"=>"Profession",
						"employer"=>"Employer",
						"stake_in_other_stations"=>"Stake in Other Stations",
						"conviction_felony"=>"Convicted of a Felony",
						"conviction_antitrust"=>"Convicted of Antitrust",
						"conviction_fraud"=>"Convicted of Fraud",
						"conviction_discrimination"=>"Convicted of Discrimination",
						"drug_abuse_act"=>"Convicted under the Drug Abuse Act",
						"ethnicity"=>"Ethnicity",
						"gender"=>"Gender",
						"statement"=>"Personal Statement",
						"notes"=>"Notes",
						"training_term"=>"Training Term",
						"training_year"=>"Training Year",
						"expires_term"=>"Expires Term",
						"expires_year"=>"Expires Year",
						"college_name"=>"College Name",
						"college_city"=>"College City",
						"college_state"=>"College State",
						"college_zip"=>"College ZIP Code",
						"college_dates"=>"College Dates Attended",
						"college_degree"=>"College Degree",
						"highschool_name"=>"High School Name",
						"highschool_city"=>"High School City",
						"highschool_state"=>"High School State",
						"highschool_zip"=>"High School ZIP Code",
						"highschool_dates"=>"High School Dates Attended",
						"highschool_graduation"=>"High School Graduation Year",
						"other_name"=>"Other School Name",
						"other_city"=>"Other School City",
						"other_state"=>"Other School State",
						"other_zip"=>"Other School ZIP Code",
						"other_dates"=>"Other School Dates Attended",
						"employment_name"=>"Employment Name",
						"employment_city"=>"Employment City",
						"employment_state"=>"Employment State",
						"employment_zip"=>"Employment ZIP Code",
						"employment_phone"=>"Employment Phone Number",
						"employment_date_hired"=>"Employment Date Hired",
						"employment_title"=>"Employment Title",
						"employment_supervisor_name"=>"Employment Supervisor Name r",
						"employment_supervisor_phone"=>"Employment Supervisor Phone Number",
						"reference_one_name"=>"Reference One Name",
						"reference_one_address"=>"Reference One Address",
						"reference_one_phone"=>"Reference One Phone Number",
						"reference_one_relationship"=>"Reference One Relationship",
						"reference_two_name"=>"Reference Two Name",
						"reference_two_address"=>"Reference Two Address",
						"reference_two_phone"=>"Reference Two Phone Number",
						"reference_two_relationship"=>"Reference Two Relationship",
						"department"=>"department");

    	function __construct()
    	{
		$this->CI =& get_instance();
    	}
    	
	function prep_member_data( $data )
	{
		// Iterate over each item in the provided data array (usually the $_POST object)
		foreach ( $data as $key=>$val )
		{
			// Move valid fields into $this->member_data array.
			if(isset($this->fields[$key]))
			{
				$this->member_data[$key]=$val;
			}
		}
		if(!empty($data['team']))
			$this->teams = $data['team'];
		if ( isset($data['member_id']) )
		{
			$this->member_id = $data['member_id'];
		}
		$this->_clean_phone_numbers();
	}
	
	function save( $method = NULL, $id = NULL )
	{
		$this->prep_member_data($_POST);
		// Existing Members
		if ( !empty($this->member_id) )
		{
			//Self Edits
			if ($method=="update")
			{
				// Save revision into history
				$this->save_revision($this->member_id, $this->member_data, "update");
			}
			
			// Admin Edits
			elseif ($method=="edit")
			{
				// Save revision into history
				$this->save_revision($this->member_id, $this->member_data, "edit");
				
				// Save revision into DB
				$this->CI->db->where('member_id', $this->member_id)->update("member_data", $this->member_data);
			}
			
			// Admin-approved member data revision [made by a member]
			elseif($method=="approved")
			{
				// Load revision, prep for update
				$revision_info = $this->get_revision($id);
				$revised = $revision_info['data'];
				$this->member_id = $revision_info['member_id'];
				$this->member_data = array();
				$this->prep_member_data($revised);

				// Update data
				$this->CI->db->where('member_id', $this->member_id)->update("member_data", $this->member_data);
				
				// Mark revision as approved
				$this->CI->db->where('id', $id)->update('member_revisions', array('approved'=>1));
			}
			// Admin-approved dj profile revision [made by a member]
			elseif($method=="approved_profile")
			{
				$this->CI->load->library('drupal');
				
				// Prep data
				$revision_info = $this->get_revision($id);
				$revised = $revision_info['data'];

				$revisions = array ("body"=>$revised['body'], "teaser"=>$revised['body'], "title"=>$revised['title']);
				$profile = array ( "field_status_value"=>$revised['field_status_value'], "field_hometown_value"=>$revised['field_hometown_value']);
				$alias = strtolower(str_replace(" ", "-", $revised['title']));
				$where = "nid=".$revised['nid'];
				
				//Prep queries
				$sql1 = $this->CI->db->update_string("node_revisions", $revisions, $where);
				$sql2 = $this->CI->db->update_string("content_type_profile", $profile, $where);
				$sql3 = $this->CI->db->update_string("url_alias", array("dst"=>"dj/".$alias), "src=`node/".$revised['nid']."`");
				$sql4 = $this->CI->db->update_string("url_alias", array("dst"=>"dj/".$alias."/feed"), "src='node/".$revised['nid']."/feed'");
				
				// Run queries
				$this->CI->drupal->api_call($sql1);
				$this->CI->drupal->api_call($sql2);
				$this->CI->drupal->api_call($sql3);
				$this->CI->drupal->api_call($sql4);
				
				// Mark revision as approved
				$this->CI->db->where('id', $id)->update('member_revisions', array('approved'=>1));
			}

			
		}
		// New Members
		else
		{
			// Save app into DB
			$this->CI->db->insert("member_data",$this->member_data);
			$this->member_id = $this->CI->db->insert_id();
			if(isset($_POST['training'])) $this->invite($this->member_id, $_POST['training']);
			
			// What type of revision?
			if ( $method== "new") $type = "new";
			else $type = "apply";
			
			// Save revision into history			
			$this->save_revision($this->member_id, $this->member_data, $type);
		}
		
		$this->save_teams();
		
		return $this->member_id;
	}
	
	function save_teams( $teams = NULL, $member_id = NULL )
	{
		// Check for team data
		if(empty($this->teams)&&!empty($teams))
			$this->teams = $teams;
		elseif(empty($this->teams)&&empty($teams))
			return false;
		
		// Check for member_id
		if(empty($this->member_id)&&!empty($member_id))
			$this->member_id = $member_id;
		elseif(empty($this->member_id)&&empty($member_id))
			return false;
		
		$current_query = $this->CI->db->select('team_id')->where('member_id', $this->member_id)->get('team_roster');
		$current_teams = $current_query->result_array();
		
		foreach($current_teams as $key=>$val)
			$current[] = $val['team_id'];
		
		$removed = array_diff($current, $this->teams);
		$added = array_diff($this->teams, $current);

		foreach ( $added as $val )
		{
			$data = array ( "team_id"=>$val, "member_id"=>$this->member_id);
			$this->CI->db->insert("team_roster", $data);
		}
		
		foreach ( $removed as $val )
		{
			$this->CI->db->where('member_id',$this->member_id)->where('team_id', $val)->delete('team_roster');
		}
		
		return array ( "added"=>$added, "removed"=>$removed);
	}
	
	function save_revision ( $member_id, $revision, $type, $date = null, $stop = NULL, $approved = NULL )
	{
		if($type=="profile")
			$this->CI->load->library('drupal');
		
		// If this is the first time this function has been called
		if (!$stop&&($type=="edit"||$type=="update"))
		{
			// Check to see if the current version has been saved yet.
			$q = $this->CI->db->where('member_id', $member_id)->where('type !=', 'profile')->get('member_revisions');
			if($q->num_rows==0)
			{
				$member_data_query = $this->CI->db->where('member_id', $member_id)->get('member_data');
				$member_data = $member_data_query->row_array();

				// If present, use the timestamp from the application's creation as revision's timestamp
				if(!empty($member_data['date_added'])) 
				{
					$app_date = $member_data['date_added'];
				}
				else $app_date = NULL;

				// Save original
				$this->save_revision ( $member_id, $member_data, "apply", $app_date, TRUE);
			}
		}
		elseif (!$stop&&$type=="profile")
		{
			// Check to see if the current version has been saved yet
			$q = $this->CI->db->where('member_id', $member_id)->where('type !=', 'profile')->get('member_revisions');
			if($q->num_rows==0)
			{
				$raw_data = $this->CI->drupal->load_profile( $member_id );
				$current_data = array ( 	"field_status_value"=>$raw_data['status'], 
									"field_hometown_value"=>$raw_data['hometown'],
									"title"=>$raw_data['name'],
									"nid"=>$raw_data['nid'],
									"body"=>$raw_data['bio']);
				$this->save_revision ( $member_id, $current_data, "profile", NULL, TRUE, TRUE);
			}
		}
		// Save this revision.
		$data["data"] = utf8_encode(serialize($revision));
		$data["member_id"] = $member_id;
		$data["type"] = $type;
		if(!empty($date)) $data['date'] = $date;
		$descriptions = array (	"edit"=>"Data Edited by an Admin",
							"new"=>"Created by an Admin",
							"apply"=>"Application Submitted",
							"update"=>"Data Edited by Member",
							"profile"=>"DJ Profile Edited by Member");
		$data['description'] = $descriptions[$type];
		
		if($type=="new"||$type=="apply"||$type=="edit"||$approved==TRUE) $data['approved'] = 1;
		else $data['approved'] = 0;
		$this->CI->db->insert('member_revisions', $data);
		return $this->CI->db->insert_id();
	}
	function update_status($status, $nid )
	{
		$this->CI->load->library('drupal');
		// Prep data
		$profile = array ( "field_status_value"=>$status);
		$where = "nid=".$nid;
		//Prep queries
		$sql = $this->CI->db->update_string("content_type_profile", $profile, $where);
		// Run queries
		$this->CI->drupal->api_call($sql);
	}
	function roster( $where )
	{
		if ( substr($where, 0, 4)=="team")
		{
			$bits = explode("=",$where);
			$query = $this->CI->db->query("SELECT * FROM `member_data` AS M JOIN `team_roster` AS T ON M.member_id = T.member_id  JOIN member_status AS s ON m.status_id=s.status_id WHERE T.team_id = ".$bits[1]);
		}
		else
		{
			if ( isset($where) && $where!="" && $where!="all")
				$where_clause = "WHERE ".$where." ";
			else
				$where_clause = "";
				
			$query = $this->CI->db->query("SELECT * FROM member_data AS m INNER JOIN member_status AS s ON m.status_id=s.status_id ".$where_clause." ORDER BY m.last_name ASC");
		}
		$roster = array();
		foreach ( $query->result() as $num => $row )
		{
			foreach ( $row as $key=>$val )
			{
				$roster[$num][$key] = $val;
			}
		}
		return $roster;
	}

	function member_data( $id )
	{
		$query = $this->CI->db->query("SELECT * FROM member_data AS m INNER JOIN member_status AS s ON m.status_id=s.status_id WHERE m.member_id=".$id." ORDER BY m.last_name ASC");
		$data = array();
		foreach ( $query->row() as $key => $val )
		{
			$data[$key]=$val;
		}

		if(!empty($data['email_yale'])) $data['email'] = $data['email_yale'];
		else $data['email'] = $data['email_personal'];
		
		$teamsQuery = $this->CI->db->query("SELECT * FROM team_roster WHERE member_id=".$id);
		$data['teams']=array();
		foreach($teamsQuery->result() as $key=>$val)
		{
			$data['teams'][$val->team_id]=TRUE;
		}
		$interestsQuery = $this->CI->db->query("SELECT * FROM interests_roster WHERE member_id=".$id);
		$data['interests']=array();
		foreach($interestsQuery->result() as $key=>$val)
		{
			$data['interests'][$val->interest_id]=TRUE;
		}
		return $data;
	}
	function lister ( $type, $id = NULL )
	{
		switch ( $type )
		{
			case "roster":
				$this->CI->load->library('parser');
				$data['edit'] = $_POST['edit'];
				$data['drupal'] = $this->drupal_path;
				$data['base_url'] = base_url(); 
				$roster = $this->roster($_POST['where']);
				foreach($roster as $key=>$val )
				{
					if(strlen($val['email_personal'])>30) {
						$roster[$key]['email_personal'] = substr($val['email_personal'], 0, 30)."...";
					}
				}
				$data['roster'] = $roster;
				$str =  $this->CI->parser->parse('templates/roster_row', $data, TRUE);
				$str = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $str);
				$str = str_replace(",]","]",$str);
				echo $str;
				break;
			case "teams":
				$teams = array();
				$query = $this->CI->db->query('SELECT * FROM team_data WHERE team_status=1 ORDER BY sort_order ASC');
				foreach ( $query->result() as $row )
				{
					$teams[] = array ( "id" => $row->team_id, "title" => $row->team_title, "description" => $row->team_description);
				}
				return $teams;
				break;
			case "interests":
				$interests = array();
				$query = $this->CI->db->query('SELECT * FROM interests_data WHERE interest_status=1 ORDER BY sort_order ASC');
				foreach ( $query->result() as $row )
				{
					$interests[] = array ( "id" => $row->interest_id, "description" => $row->interest_desc);
				}
				return $interests;
				break;
			case "status":
				$query = $this->CI->db->query("SELECT * FROM member_status ORDER BY sort_order");
				$status = array();
				foreach($query->result() as $key => $val)
				{
					$status[$val->status_id]=$val->status;
				}
				return $status;
				break;
			case "filters":
				$filters = array();
				$status = $this->lister('status');
				foreach ( $status as $key=>$val )
				{
					$filters[$val] = "m.status_id=".$key;
				}
				$teams = $this->lister('teams');
				foreach ( $teams as $key=>$val )
				{
					$filters[$val['title']] = "team=".$val['id'] ;
				}
				return $filters;
				break;
			case "revisions":
				$q = $this->CI->db->where('member_id', $id)->order_by('date', 'desc')->get('member_revisions');
				$r = $q->result_array();
				
				// Add "current" flag to latest member_data and dj profile revisions
				$c_d = false;
				$c_p = false;
				for($i=0; $i<count($r); $i++)
				{
					if($r[$i]['approved']==1 && $c_d==false && $r[$i]['type']!="profile")
					{
					
						$r[$i]['current'] = TRUE;
						$c_d = TRUE;
					}
					if($r[$i]['approved']==1 && $c_p==false && $r[$i]['type']=="profile")
					{
						$r[$i]['current'] = TRUE;
						$c_p = TRUE;
					}
				}
				return $r;
				break;
		}
	}
	
	function export ( $type, $raw_list )
	{
		$roster = $this->selective_roster(explode("-",trim($raw_list,"-")));
		
		switch ( $type )
		{
			case "csv":
				$this->CI->load->dbutil();
				$this->CI->load->helper('file');
				$delimiter = "\t";
				$newline = "\r\n";
		
				$csv = $this->CI->dbutil->csv_from_result($roster, $delimiter, $newline); 
				
				$filepath = $this->root_path."system/csv/";
				$basename = "member_data_".date("Y-m-d-g-i-s-A").".csv";	
				$filename = $filepath.$basename;	
				
				if ( ! write_file($filename, $csv))
				{
					echo "File cannot be written. Blame Sherwin.";
				}
				else
				{
					header('Content-disposition: attachment; filename='.$basename);
					header('Content-type: text/csv');
					readfile($filename);
				}
				break;
			case "contact":
				echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml"><head>
				<link rel="stylesheet" href="'.base_url().'assets/css/export.css" />
				<title>WYBC Member Management System</title>
				</head>
				<body>
				<div class="wrapper">';
				
				$i=1;
				foreach ($roster->result() as $val)
				{
					if($i==1)
					{
						echo '<div class="header"><img src="http://localhost/wybc/assets/images/logo_large.png" style="width: 100px; float: left;" /><h1 style="float: left; margin-left: 33px;">Contact Information</h1><br /><hr style="clear: both;" /></div>
						<table class="contact">
						<tr class="heading"><td>Name</td><td>Cell Phone</td><td>Email</td></tr>';
					}
					echo "<tr><td>".$val->last_name.", ".$val->first_name."</td><td>".$val->phone_mobile."</td><td>".$val->email_personal."</td></tr>";
					if($i==32)
					{
						echo "</tbody></table>";
						$i=0;
					}
					$i++;
				}

				break;
			case "detailed":
				echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml"><head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<link rel="stylesheet" href="'.base_url().'assets/css/export.css" />
				<title>WYBC Member Management System</title>
				</head>
				<body>
				<div class="wrapper">';
				foreach($roster->result() as $val) 
				{
					echo "<h1>".$val->last_name.", ".$val->first_name."</h1>";
					echo "<p>Email: ".$val->email_personal."</p>";
					echo "<p>Cell: ".$val->phone_mobile."</p>";
					echo "<p>College: ".$val->college."</p>";
					echo "<p>Class: ".$val->class."</p>";
					echo "<p>Status: ".$val->status."</p>";
					echo "<div class='page-break'></div>";
				}
				break;
			case "mailinglist":
				foreach($roster->result() as $val)
				{
					echo "<p>".$val->email_personal."</p>";
				}
				break;
		}
	}
	function selective_roster ( $list )
	{
		$query = '';
		foreach ( $list as $val )
		{
			$query .= "SELECT * FROM member_data AS m INNER JOIN member_status AS s ON m.status_id=s.status_id WHERE member_id=".$val." UNION ";
		}
		return $this->CI->db->query(substr($query,0,(strlen($query)-7)));
	}
	
	function _clean_phone_numbers()
	{
	
	}
	
	function verification ( $member_id )
	{
	
		$key = rand(1000000,9999999);
		$data = array ("member_id"=>$member_id, "sess_key"=>$key );
		$this->CI->db->query("DELETE FROM email_keys WHERE member_id=".$member_id);
		$this->CI->db->query($this->CI->db->insert_string('email_keys',$data));
		$email_query = $this->CI->db->query("SELECT email_personal, first_name, last_name FROM member_data WHERE member_id=".$member_id);
		$row = $email_query->row();
		$email = $row->email_personal;
		
		/*$message = 
"Hello, WYBC member! 

From time to time, we like everyone to check in and verify the information we have stored in our member database. So here is how you can help: Click the link below and it will take you to a page with your information on it. Fix any errors you notice and then click submit. Thanks for your help!


Please go here to verify your member data:
http://dj.wybc.com/admin/index.php/roster/verify/".$key."

Thanks,
The WYBC Team";*/



$message = "Hey, ".$row->first_name."!

Our tireless engineer Brandon has created a WYBC MEMBER DATABASE and we need you to input and verify all of your information for our records. That way, your contact info will be current, you'll be signed up for all the right team emails, and the FCC will be satisfied.

Please go here to verify your member data!
http://wybc.com/roster/index.php/roster/verify/".$key."

Thank you for your help!

WYBC Eboard";
		return $this->robot_email ( $email, "[WYBC] Verify Your Member Data", $message );
	}
	function notify ( $type, $name, $member_id)
	{
		switch($type)
		{
			case "new_app":
				$msg = $name." has submitted a new application.";
				$this->robot_email($this->admin_email, "[WYBC] New App: ".$name,  $msg." It is currently awaiting your attention. Thanks!
 -The WYBC Robot");
 				$this->CI->db->query("INSERT INTO member_updates (member_id, update_type, update_desc) VALUES (".$member_id.",1,'".$msg."')");
				break;
			case "verifier":
				$msg = $name." has updated their data";
				$this->robot_email($this->admin_email, "[WYBC] ".$msg, $msg.". It is currently awaiting your attention. Thanks!
-The WYBC Robot");
 				$this->CI->db->query("INSERT INTO member_updates (member_id, update_type, update_desc) VALUES (".$member_id.",0,'".$msg."')");

				break;
		}
	}
	function robot_email ( $to, $subject, $message, $html = false )
	{
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'robot@wybc.com',
			'smtp_pass' => 'nargo^%'
		);
		$this->CI->load->library('email', $config);
		$this->CI->email->set_newline("\r\n");
		
		$this->CI->email->from('robot@wybc.com', 'WYBC');
		$this->CI->email->to($to);
		
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		
		if (!$this->CI->email->send())
			return "Ooops! There has been an error. Please copy and paste following error message in an email to gm@wybc.com. Thanks!<br /><br />".show_error($this->CI->email->print_debugger());
	}
	
	function delete_member ( $member_id )
	{
		$this->CI->db->query("DELETE FROM member_data WHERE member_id=".$member_id);
		$this->CI->db->query("DELETE FROM team_roster WHERE member_id=".$member_id);
		$this->CI->db->query("DELETE FROM interests_roster WHERE member_id=".$member_id);
	}
	
	function get_revision ( $id )
	{
		// Get revisions
		$query = $this->CI->db->where('id', $id)->get('member_revisions');
		$result = $query->row();
		
		// Decode data
		$data = unserialize(utf8_decode($result->data));	
		$r = array("data"=>$data, "type"=>$result->type, "member_id"=>$result->member_id);
		return $r;
	}
	
	function revision_changes( $id)
	{
		$changes = array();
		
		// Get revision
		$revision_info = $this->get_revision($id);
		$revised = $revision_info['data'];
		$member_id = $revision_info['member_id'];
		$type = $revision_info['type'];
		// Get current member data
		if($type!='profile')
		{
			$current = $this->member_data( $member_id );
		}
		else
		{	
			$this->CI->load->library('drupal');
			
			$current = $this->CI->drupal->load_profile( $member_id );
		}
		// Process changes
		foreach( $revised as $key=>$val)
		{
			if(!empty($this->fields[$key])) $title = $this->fields[$key];
			else $title = $key;
			if ( $current[$key]!=$val)
				$changes[$key] = array ('title' => $title, 'old'=>$current[$key], 'new'=>$val);
		}
		return $changes;
	}
	/*
	Events Management
	*/
	// LOW LEVEL FUNCTIONS
	
	function delete_event ( $event_id )
	{
		$this->CI->db->where('event_id', $event_id)->delete("event_data");
		$this->CI->db->where('event_id', $event_id)->delete("event_attendence");
	}
	function invite( $member_id, $event_id )
	{
		$this->CI->db->insert('event_attendence', array('member_id'=>$member_id, 'event_id'=>$event_id));
	}
	function uninvite( $member_id, $event_id )
	{
		$this->CI->db->where('member_id', $member_id)->where('event_id', $event_id)->delete('event_attendence');
	}
	function take_attendence( $status = 'present', $member_id, $event_id )
	{
		if($status=="present")
			$data = array("present"=>1);
		elseif($status=="absent")
			$data = array ("present"=>0);
		elseif($status=="excused")
			$data = array ("present"=>0, "excused"=>1);
		else 
			return false;
		$this->CI->db->where('event_id', $event_id)->where('member_id', $member_id)->update( 'event_attendence', $data);
	}
	// HIGH LEVEL FUNCTIONS
	
	function invite_group( $group = 'active', $event_id )
	{
		if ( $group == "active" )
		{
			$q = $this->CI->db->where('status_id', 6)->get('member_data');
			$actives = $q->result();
			foreach($actives as $key=>$obj)
			{
				$this->invite($obj->member_id, $event_id);
			}
		}
	}
	function submit_attendence()
	{
		$event_id = $_POST['event_id'];
		foreach($_POST as $key=>$val)
		{
			if(strpos($key, "status_")!==false)
			{
				$member_id = substr($key, 7);
				echo $member_id."=".$val.", ";
				$this->take_attendence($val, $member_id, $event_id);
			}
		}
	}
	function fetch_attendence( $id )
	{
		$q = $this->CI->db->from("event_attendence AS a ")->where('member_id', $id)->join('event_data as e ', 'e.event_id=a.event_id')->get();
		$r = $q->result_array();
		foreach($r as $key=>$val)
		{
			if($val['type']=='gboard')
				$r[$key]['type'] = "G-Board Meeting";
			if($val['excused']==0&&$val['present']==0)
			{
				$r[$key]['status'] = "Unexcused Absence";
			}
			elseif($val['excused']==1&&$val['present']==0)
			{
				$r[$key]['status'] = "Excused Absence";
			}
			elseif($val['present']==1)
			{
				$r[$key]['status'] = "Present";
			}
		}
		return $r;
	}
	function get_training()
	{
		$q = $this->CI->db->where('type', 'training')->where('start_date > ', date("Y-m-d H:i:s"))->get('event_data');
		return $q->result_array();
	
	}
}
?>