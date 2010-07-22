<?php 
/* 

THE EDIT VIEW 


///////////////////////////////////////////////////////////////
The variables at play...

$edit
$add

$undergrad
$affiliate
$associate

$members
$teams
$statii
$revisions


///////////////////////////////////////////////////////////////
**Useful command structure**
This page has three uses:
	1) DJs editing their own information
	2) Admins editing a DJ's information
	3) Admins creating new DJs
You can use this control structure to determine which type of page is currently in use.

<?php if((!isset($add)||!$add)&&(!isset($edit)||!$edit)) { ?>
		DJs editing their own information
<?php elseif((!isset($add)||!$add)&&$edit) { ?>
		Admins editing a DJ's information
<?php } elseif($add) { ?>
		Admins creating new DJs
<?php } ?>
////////////////////////////////////////////////////////////////
*/
?>


<div class='ui-widget'>
<form action="<?php echo site_url("roster/save"); ?>" id='edit_member' method="post">

<?php
// Save member_id (if available)
if ( isset( $members['member_id']) ) 
	echo "<input type='hidden' value='".$members['member_id']."' name='member_id' />";
?>


<?php if((!isset($add)||!$add)&&(!isset($edit)||!$edit)) { ?>

	<h1>Update Your Data</h1>
	<input type='hidden' value='update' name='app_type' />

<?php } elseif((!isset($add)||!$add)&&$edit) { ?>

	<h1>Update Member Data</h1>
	<input type='hidden' value='edit' name='app_type' />

<?php } elseif($add) { ?>
	<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#roster"); ?>" id='ticket_link'>Roster</a> | <a href="<?php echo site_url("roster/add"); ?>" id='ticket_link'>Add New Member</a> | <?php echo ucfirst($this->uri->segment(3)); ?> Application</p>
	<h1>Add New Member</h1>
	<input type='hidden' value='new' name='app_type' />

<?php } ?>


<div id="accordion">

<h3><a href="#">The Basics</a></h3>
<div>
	<!-- [All] Names -->
	<table>
		<tr>
			<td><label>First Name</label></td>
			<td><label>Middle Initial</label></td>
			<td><label>Last Name</label></td>
		</tr>
		<tr>
			<td><input name="first_name" type="text" value="<?php if(isset($members['first_name'])) echo $members['first_name']; ?>" />
			</td>
			<td><input name="middle_initial" type="text" value="<?php if(isset($members['middle_initial'])) echo $members['middle_initial']; ?>" width="2"/>
			</td>
			<td><input name="last_name" type="text" value="<?php if(isset($members['last_name'])) echo $members['last_name']; ?>" />
			</td>
		</tr>
	</table>
	<!-- eof names-->
	
	<!-- [Undergrad] Yale info -->
	<?php if( $undergrad ) { ?>
	<table id='yale_info'>
		<tr>
			<td><label>Residential College</label></td>
			<td><label>Class Year</label></td>
			<td><label>Major/Discipline</label></td>
		</tr>
		<tr>
			<td>
				<select name="college">
					<?php 
					if(isset($members['college'])){ 
						echo '<option value="'.$members['college'].'" selected="selected">'.$members['college'].'</option>'; 
					}
					else {
						echo '<option selected="selected" value="">Choose a college</option>';
					}
					?>
					<option value="BK">Berkeley</option>
					<option value="BR">Branford</option>
					<option value="CC">Calhoun</option>
					<option value="DC">Davenport</option>
					<option value="ES">Ezra Stiles</option>
					<option value="JE">Jonathan Edwards</option>
					<option value="MC">Morse</option>
					<option value="PC">Pierson</option>
					<option value="SY">Saybrook</option>
					<option value="SM">Silliman</option>
					<option value="TD">Timothy Dwight</option>
					<option value="TC">Trumbull</option>
				</select>
			</td>
			<td><input name="class" type="text" value="<?php if(isset($members['class'])) echo $members['class']; ?>" maxlength="4" />
			</td>
			<td><input name="major" type="text" value="<?php if(isset($members['major'])) echo $members['major']; ?>" />
			</td>
		</tr>
	</table>
	<?php } ?>
	<!-- eof undergrad yale info -->
	
	
	<!-- [Associates] ID Info -->
	<?php if($affiliate || $associate) { ?>
	<div id='id_info'>
		<p>
			<label>Driver's License #</label>
			<input type='text' name='drivers_license_number' value='<?php if(isset($members['drivers_license_number'])) echo $members['drivers_license_number']; ?>' />
		</p>
		<p>
			<label>Driver's License State</label>
			<select name="drivers_license_state">
				<?php if(isset($members['drivers_license_state'])){ 
							echo '<option value="'.$members['drivers_license_state'].'" selected="selected">'.$members['drivers_license_state'].'</option>'; }
							else {
							echo '<option selected="selected">Select a State</option>';
							}
					?>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
		</p>
	</div>
	<?php } ?>
	<!-- eof Associate's ID Info -->


	
	<!-- [Yale Affiliates] SID & Department Info -->
	<?php if( $affiliate ) { ?>
	<div>
		<p>
			<label>Department / Graduate School</label>
			<input type='text' name='department' value='<?php if(isset($members['department'])) echo $members['department']; ?>' />
		</p>
		<p>
			<label>Yale SID</label>
			<input type="text" name='yale_sid' value="<?php if(isset($members['yale_sid'])) echo $members['yale_sid']; ?>" />
		</p>
	</div>
	<?php } ?>
	<!-- eof Yale Affiliate Info -->	
	

</div>

<h3><a href="#"> Contact Information & Addresses </a></h3>
<div>
	
	<!-- [Undergrads + Affiliates] Yale Email & Alternate Email-->
	<?php if ( $undergrad || $affiliate ) { ?>
	<div>
	<p>
		<label>Yale Email</label>
		<input type='text' name='email_yale' value='<?php if(isset($members['email_yale'])) echo $members['email_yale']; ?>' />
	</p>
	<p>
		<label>Alternative Email</label>
		<input type='text' name='email_personal' value='<?php if(isset($members['email_personal'])) echo $members['email_personal']; ?>' />
	</p>
	</div>
	<?php } ?>
	<!-- eof Yalies' email -->
	
	<!-- [Associates] Email -->
	<?php if ($associate){ ?>
	<p>
		<label>Email Address</label>
		<input type='text' name='email_personal' value='<?php if(isset($members['email_personal'])) echo $members['email_personal']; ?>' />
	</p>
	<?php } ?>
	<!-- eof Associates Email-->
	
	<!-- [All] Phone Numbers -->
	<h3>Phone Numbers</h3>
	<p>
		<label>Cell</label>
		<input type="text" name='phone_mobile' value='<?php if(isset($members['phone_mobile'])) echo $members['phone_mobile']; ?>' />
	</p>
	
	<p>
		<label>Home</label>
		<input type="text" name='phone_home' value='<?php if(isset($members['phone_home'])) echo $members['phone_home']; ?>' />
	</p>
			
	<p>
		<label>Work</label>
		<input type="text" name='phone_work' value='<?php if(isset($members['phone_work'])) echo $members['phone_work']; ?>' />
	</p>
	
	<!-- eof phone numbers-->
	
	<!-- [All] Home Address -->
	<h3>Home Address</h3>
	<table>
		<tr>
			<td colspan="3"><label>Street Address / PO Box</label></td>
		</tr>
		</tr>
		
		<tr>
			<td colspan="3"><input type='text' name='home_address' value='<?php if(isset($members['home_address'])) echo $members['home_address']; ?>' style='width: 100%;' /></td>
		</tr>
		<tr>
			<td><label>City</label></td>
			<td><label>State</label></td>
			<td><label>ZIP Code</label></td>
		</tr>
		<tr>
			<td><input type='text' name='home_city' value='<?php if(isset($members['home_city'])) echo $members['home_city']; ?>' /></td>
			<td><select name="home_state">
					<?php if(isset($members['home_state'])){ 
							echo '<option value="'.$members['home_state'].'" selected="selected">'.$members['home_state'].'</option>'; }
							else {
							echo '<option value="" selected="selected">Select a State</option>';
							}
					?>
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="DC">District Of Columbia</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
				</select></td>
			<td><input name='home_zip' value='<?php if(isset($members['home_zip'])) echo $members['home_zip']; ?>' type="text" /></td>
		</tr>
		<tr>
			<td colspan='3'><label>Country (if not USA)</label></td>
		</tr>
		<tr>
			<td colspan='3'><input name='home_country' value='<?php if(isset($members['home_country'])) echo $members['home_country']; ?>' type='text'  /></td>
		</tr>
	</table>
	<!-- eof home address-->
</div>


<!-- [Associates & Affiliates] Background Information -->
<?php if( $associate || $affiliate ) { ?>
<h3><a href="#">Education</a></h3>
<div id='education'>
	<h3>College</h3>
	<div>
		<p>
			<label>Name</label>
			<input type='text' name='college_name'  value='<?php if(isset($members['college_name'])) echo $members['college_name']; ?>' >
		</p>
		<table id='college_location'>
			<tr>
				<td><label>City</label></td>
				<td><label>State</label></td>
				<td><label>ZIP Code</label></td>
			</tr>
			<tr>
				<td>
					<input type='text' name='college_city' class='input_city'  value='<?php if(isset($members['college_city'])) echo $members['college_city']; ?>'   />
				</td>
				<td>
					<select name="college_state">
						<?php if(isset($members['college_state'])) echo '<option selected="selected">'.$members['college_state']."</option>";?>
						<option value=''>Select A State</option>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
				</td>
				<td>
					<input name='college_zip' class='input_zip'  type="text"   value='<?php if(isset($members['college_zip'])) echo $members['college_zip']; ?>'  />
				</td>
			</tr>
		</table>
		<p>
			<label>Dates Attended</label>
			<input type='text' name='college_dates'  value='<?php if(isset($members['college_dates'])) echo $members['college_dates']; ?>' >
		</p>
		<p>
			<label>Degree</label>
			<input type='text' name='college_degree'  value='<?php if(isset($members['college_degree'])) echo $members['college_degree']; ?>' >
		</p>
	</div>
	<h3>High School</h3>
	<div>
		<p>
			<label>Name</label>
			<input type='text' name='highschool_name'  value='<?php if(isset($members['highschool_'])) echo $members['highschool_name']; ?>' >
		</p>
		<table id='highschool_location'>
			<tr>
				<td><label>City</label></td>
				<td><label>State</label></td>
				<td><label>ZIP Code</label></td>
			</tr>
			<tr>
				<td>
					<input type='text' name='highschool_city' class='input_city'   value='<?php if(isset($members['highschool_city'])) echo $members['highschool_city']; ?>'  />
				</td>
				<td>
					<select name="highschool_state">
						<?php if(isset($members['highschool_state'])) echo '<option selected="selected">'.$members['highschool_state']."</option>";?>
						<option value=''>Select A State</option>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
				</td>
				<td>
					<input name='highschool_zip' class='input_zip'  type="text"   value='<?php if(isset($members['highschool_zip'])) echo $members['highschool_zip']; ?>'  />
				</td>
			</tr>
		</table>
		<p>
			<label>Dates Attended</label>
			<input type='text' name='highschool_dates'   value='<?php if(isset($members['highschool_dates'])) echo $members['highschool_dates']; ?>' >
		</p>
		<p>
			<label>Year of Graduation</label>
			<input type='text' name='highschool_graduation'  value='<?php if(isset($members['highschool_graduation'])) echo $members['highschool_graduation']; ?>' >
		</p>
	</div>
	<h3>Other / Trade School</h3>
	<div>
		<p>
			<label>Name</label>
			<input type='text' name='other_name'  value='<?php if(isset($members['other_name'])) echo $members['other_name']; ?>' >
		</p>
		<table id='other_location'>
			<tr>
				<td><label>City</label></td>
				<td><label>State</label></td>
				<td><label>ZIP Code</label></td>
			</tr>
			<tr>
				<td>
					<input type='text' name='other_city' class='input_city'  value='<?php if(isset($members['other_city'])) echo $members['other_city']; ?>'  />
				</td>
				<td>
					<select name="other_state">
					<?php if(isset($members['other_state'])) echo '<option selected="selected">'.$members['other_state']."</option>";?>
						<option value=''>Select A State</option>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
				</td>
				<td>
					<input name='other_zip' class='input_zip'  type="text" value='<?php if(isset($members['other_zip'])) echo $members['other_zip']; ?>'  />
				</td>
			</tr>
		</table>
		<p>
			<label>Dates Attended</label>
			<input type='text' name='other_dates' value='<?php if(isset($members['other_dates'])) echo $members['other_dates']; ?>' >
		</p>
	</div>
</div>

<h3><a href="#">Employment</a></h3>
<div id='employment'>
	<p>
		<label>Employer</label>
		<input type='text' name='employment_name'>
	</p>
	<table id='employment_location'>
		<tr>
			<td><label>City</label></td>
			<td><label>State</label></td>
			<td><label>ZIP Code</label></td>
		</tr>
		<tr>
			<td>
				<input type='text' name='employment_city' class='input_city' value='<?php if(isset($members['employment_city'])) echo $members['employment_city']; ?>'  />
			</td>
			<td>
				<select name="employment_state">
					<?php if(isset($members['employment_state'])) echo '<option selected="selected">'.$members['employment_state']."</option>";?>
					<option value=''>Select A State</option>
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="DC">District Of Columbia</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
				</select>
			</td>
			<td>
				<input name='employment_zip' class='input_zip' type="text" value='<?php if(isset($members['employment_zip'])) echo $members['employment_zip']; ?>'  />
			</td>
		</tr>
	</table>
	<p>
		<label>Phone Number</label>
		<input type='text' name='employment_phone'  value='<?php if(isset($members['employment_phone'])) echo $members['employment_phone']; ?>'  />
	</p>
	<p>
		<label>Date Hired</label>
		<input type='text' name='employment_date_hired' value='<?php if(isset($members['employment_date_hired'])) echo $members['employment_date_hired']; ?>' >
	</p>
	<p>
		<label>Title</label>
		<input type='text' name='employment_title'  value='<?php if(isset($members['employment_title'])) echo $members['employment_title']; ?>' />
	</p>
	<p>
		<label>Supervisor's Name</label>
		<input type='text' name='employment_supervisor_name' value='<?php if(isset($members['employment_supervisor_name'])) echo $members['employment_supervisor_name']; ?>' >
	</p>
	<p>
		<label>Supervisor's Phone Number</label>
		<input type='text' name='employment_supervisor_phone' value='<?php if(isset($members['employment_supervisor_phone'])) echo $members['employment_supervisor_phone']; ?>' >
	</p>
</div>


<h3><a href="#">References</a></h3>
<div id='references'>
	<p class='instructions'>Please list two non-related persons who are familiar with the quality of your work or have directly worked with you for at least two years.</p>
	<h3>Reference One</h3>
		<p>
			<label>Name</label>
			<input type='text' name='reference_one_name' value='<?php if(isset($members['reference_one_name'])) echo $members['reference_one_name']; ?>'>
		</p>
		<p>
			<label>Address</label>
			<input type='text' name='reference_one_address' value='<?php if(isset($members['reference_one_address'])) echo $members['reference_one_address']; ?>'>
		</p>
		<p>
			<label>Phone Number</label>
			<input type='text' name='reference_one_phone' value='<?php if(isset($members['reference_one_phone'])) echo $members['reference_one_phone']; ?>'>
		</p>
		<p>
			<label>Relationship</label>
			<input type='text' name='reference_one_relationship' value='<?php if(isset($members['reference_one_relationship'])) echo $members['reference_one_relationship']; ?>'>
		</p>
	<h3>Reference Two</h3>
		<p>
			<label>Name</label>
			<input type='text' name='reference_two_name' value='<?php if(isset($members['reference_two_name'])) echo $members['reference_two_name']; ?>'>
		</p>
		<p>
			<label>Address</label>
			<input type='text' name='reference_two_address' value='<?php if(isset($members['reference_two_address'])) echo $members['reference_two_address']; ?>' />
		</p>
		<p>
			<label>Phone Number</label>
			<input type='text' name='reference_two_phone' value='<?php if(isset($members['reference_two_phone'])) echo $members['reference_two_phone']; ?>' />
		</p>
		<p>
			<label>Relationship</label>
			<input type='text' name='reference_two_relationship' value='<?php if(isset($members['reference_two_relationship'])) echo $members['reference_two_relationship']; ?>' />
		</p>	
</div>
<?php } ?>
<!-- eof Background Information -->


<h3><a href="#">Federal & FCC Requirements</a></h3>
<div>
	<p>
		<label>US Citizen</label>
		<label class='normal'>
		<input type="radio" name="us_citizen" value="1" id="us_citizen_0"
		<?php if ( isset($members['us_citizen'])&&$members['us_citizen']==1) echo 'checked="checked"'; ?> />
		Yes</label>
		<label class='normal'>
		<input type="radio" name="us_citizen" value="0" id="us_citizen_0"
		<?php if ( isset($members['us_citizen'])&&$members['us_citizen']==0) echo 'checked="checked"'; ?> />
		No</label>
	</p>
	<p>
		<label>If no, country of citizenship</label>
		<input name='citizen_of' type="text" value='<?php if(isset($members['citizen_of'])) echo $members['citizen_of']; ?>' />
	</p>
	<p>
		<label>Principal Profession / Occupation</label>
		<input type='text' name='profession' value='<?php if(isset($members['profession'])) echo $members['profession']; ?>' />
	</p>
	<p>
		<label>Describe any interest (ownership, employment or official relationship) you have in any other
		broadcast station:</label>
		<textarea name='stake_in_other_stations'><?php if(isset($members['stake_in_other_stations'])) echo $members['stake_in_other_stations']; ?></textarea>
	</p>
	<h3>Convictions</h3>
		<!--<p class='description'>Has an adverse finding been made or final action been taken against you (or any other entity
		in which you have an attributable interest by FCC standards) by any court or administrative
		body in a civil or criminal proceeding, brought under the provisions of any law relating to the
		following? Check all that apply.</p>-->
		<label><input type='checkbox' name='conviction_felony' value='1' 
			<?php if(isset($members['conviction_felony'])) { if($members['conviction_felony']==1){ echo "checked='checked'"; }}?> />
			Any felony</label>
		<label><input type='checkbox' name='conviction_antitrust'  value='1'
			<?php if(isset($members['conviction_antitrust'])) { if($members['conviction_antitrust']==1){ echo "checked='checked'"; }}?> />
			Broadcast related antitrust or unfair competition</label>
		<label><input type='checkbox' name='conviction_fraud' value='1' 
			<?php if(isset($members['conviction_fraud'])) { if($members['conviction_fraud']==1){ echo "checked='checked'"; }}?> />
			Criminal fraud or fraud before another governmental unit</label>
		<label><input type='checkbox' name='conviction_discrimination'  value='1' 
			<?php if(isset($members['conviction_discrimination'])) { if($members['conviction_discrimination']==1){ echo "checked='checked'"; }}?> />
			Discrimination
		</label>
		<label><input type='checkbox' name='drug_abuse_act'  value='1'
			<?php if(isset($members['drug_abuse_act'])) { if($members['drug_abuse_act']==1){ echo "checked='checked'"; }}?> />
			Anti-Drug Abuse Act of 1988</label>
	<h3>Ethnicity</h3>
	<label>
		<input type="radio" name="ethnicity" value="American Indian or Alaska Native" id="ethnicity_0" 
		<?php if(isset($members['ethnicity'])) { if($members['ethnicity']=="American Indian or Alaska Native"){ echo "checked='checked'"; }}?> />
		American Indian or Alaska Native </label>
		<label><input type="radio" name="ethnicity" value="Hispanic or Latino" id="ethnicity_1"
		<?php if(isset($members['ethnicity'])) { if($members['ethnicity']=="Hispanic or Latino"){ echo "checked='checked'"; }}?> />
		Hispanic or Latino </label>
		<label><input type="radio" name="ethnicity" value="Asian" id="ethnicity_2" 
		<?php if(isset($members['ethnicity'])) { if($members['ethnicity']=="Asian"){ echo "checked='checked'"; }}?> />
		Asian </label>
		<label><input type="radio" name="ethnicity" value="White" id="ethnicity_3"
		<?php if(isset($members['ethnicity'])) { if($members['ethnicity']=="White"){ echo "checked='checked'"; }}?> />
		White </label>
		<label><input type="radio" name="ethnicity" value="Black or African American" id="ethnicity_4"
		<?php if(isset($members['ethnicity'])) { if($members['ethnicity']=="Black or African American"){ echo "checked='checked'"; }}?> />
		Black or African American </label>
		<label><input type="radio" name="ethnicity" value="Native Hawaiian or Other Pacific Islander" id="ethnicity_5"
		<?php if(isset($members['ethnicity'])) { if($members['ethnicity']=="Native Hawaiian or Other Pacific Islander"){ echo "checked='checked'"; }}?> />
		Native Hawaiian or Other Pacific Islander  </label>
</div>

<h3><a href="#">Station Squads</a></h3>
<div>
	<table>
		<?php foreach( $teams as $row ) 
		{
			echo "<tr><td><input type='checkbox'";
			if( isset($members['teams'][$row['id']]) && $members['teams'][$row['id']]==1)
				echo "checked='checked' ";
			echo "name='team[]' value='".$row['id']."' /></td><td><span>".$row['title']."</span></td></tr>";
			echo "<tr class='interest_desc'><td></td><td><span>".$row['description']."</span></td></tr>";
		} 
		?>
	</table>
</div>

<h3><a href="#">Personal Statement</a></h3>
<div>
	<p class='instructions'>Why you would like to be a member of WYBC? Tell us in 150 to 750 words (we don't have room to train all who apply).</p>
	<textarea name='statement' style='width: 97%;' rows='15'><?php if(isset($members['statement'])) echo $members['statement']; ?></textarea>
</div>

<!-- [Admin] Status -->
<?php if ($edit==true) { ?>
<h3><a href="#">Administrative Information</a></h3>
<div>
	<p>
		<label>Membership Type</label>
		<select name='membership'>
			<option value='0' <?php if(isset($members['membership'])&&$members['membership']=="0") echo "selected='selected'"; ?>>Associate</option>
			<option value="1" <?php if(isset($members['membership'])&&$members['membership']=="1") echo "selected='selected'"; ?>>Full</option>
		</select>
	</p>
	<p>
		<label>Status</label>
		<select name='status_id'>
			<?php 
			foreach($statii as $key=>$val)
			{
				echo "<option value='".$key."' ";
				if(isset($members['status_id'])&&$members['status_id']==$key) echo " selected='selected' ";
				echo ">".$val."</option>";
			}
			?>
		</select>
	</p>
	
	<p>
		<label>Training Term</label>
		<select name='training_term'>
			<option />
			<option <?php if(isset($members['training_term']) && $members['training_term'] == "Spring") echo "selected='selected'"; ?>>Spring</option>
			<option <?php if(isset($members['training_term']) && $members['training_term'] == "Fall") echo "selected='selected'"; ?>>Fall</option>
		</select>
	</p>
	<p>
		<label>Training Year</label>
		<input name='training_year' value="<?php if(isset($members['training_year'])) echo $members['training_year']; ?>" />
	</p>
	
	<p>
		<label>Expires Term</label>
		<select name='expires_term'>
			<option />
			<option <?php if(isset($members['expires_term']) && $members['expires_term'] == "Spring") echo "selected='selected'"; ?>>Spring</option>
			<option <?php if(isset($members['expires_term']) && $members['expires_term'] == "Fall") echo "selected='selected'"; ?>>Fall</option>
		</select>
	</p>
	<p>
		<label>Expires Year</label>
		<input name='expires_year' value="<?php if(isset($members['expires_year'])) echo $members['expires_year']; ?>" />
	</p>
	
	<p>
		<label>Enrollment Status<br />
		<label class='normal'>
		<input type="radio" name="undergrad" value="1" id="undergrad_0" 
	<?php if(isset($members['undergrad'])) { if($members['undergrad']==1){ echo "checked='checked'"; }}?> >
		Yale undergraduate student</label>
		<label class='normal'>
		<input type="radio" name="undergrad" value="2" id="undergrad_1"
	<?php if(isset($members['undergrad'])) { if($members['undergrad']==2){ echo "checked='checked'"; }}?> >
		Yale graduate student</label>
		<label class='normal'>
		<input type="radio" name="undergrad" value="3" id="undergrad_1"
	<?php if(isset($members['undergrad'])) { if($members['undergrad']==3){ echo "checked='checked'"; }}?> >
		Yale faculty/staff</label>
		<label class='normal'>
			<input type="radio" name="undergrad" value="0" id="undergrad_1" <?php if(isset($members['undergrad'])) { if($members['undergrad']==0){ echo "checked='checked'"; }}?> >
			Other
		</label>
	</p>
	<h3>Notes</h3>
	<textarea name='notes' style='width: 97%' rows='15'><?php if(isset($members['notes'])) echo $members['notes']; ?></textarea>
</div>
<?php if(!$add) { ?>
<h3><a href="#">Attendence</a></h3>
<div>
<table class='display'>
	<thead>
		<th>Type</th>
		<th>Title</th>
		<th>Date</th>
		<th>Status</th>
	</thead>
	<tbody>
	<?php foreach($attendence as $key=>$val) { ?>
	<tr>
		<td><?php echo ucfirst($val['type']); ?></td>
		<td><?php echo $val['title']; ?></td>
		<td><?php echo date('n/j/o', strtotime($val['start_date'])); ?></td>
		<td><?php echo $val['status']; ?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>
</div>

<h3><a href="#">Revision History</a></h3>
<div>
<table class='display'>
	<?php foreach( $revisions as $key=>$val) { ?>
	<tr>
		<td style='width: 100px;'><?php echo date("n/j/o", strtotime($val['date'])); ?></td>
		<td style='width: 200px;'><a href="<?php echo site_url('roster/revisions/'.$val['id']); ?>"><?php echo $val['description']; ?></a></td>
		<td><?php if(isset($val['current'])&&$val['current']==TRUE){
				echo "<span style='background: green; color: white; padding: 3px 6px; font-size: 10px;'>Current Version</span>";
				}
				elseif($val['rejected']==1) {
				echo "<span style='font-size: 10px; color:red; '>Rejected</span>"; 
				}?></td>
	</tr>
	<?php } ?>
</table>
</div>

<?php  } }  ?>
<!-- eof status-->

</div>
<?php if(!isset($add)||!$add) { ?>
	<input type='submit' class='red_button' style='margin-top: 20px;' value='Update Member Data' />
<?php } elseif($add) { ?>
	<input type='submit' class='red_button' style='margin-top: 20px;' value='Add New Member' />
<?php } ?>
	</form>
</div>


<script>
$(function(){
	$("#accordion").accordion({'autoHeight': false, 'collapsible':true});
});
</script>
