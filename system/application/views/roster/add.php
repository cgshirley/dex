<!-- things to parse:
	{undergrad}
-->
<?php
// This index is used to number the sections.
$i=1;
?>

<div class='ui-widget'>
<form action="<?php echo site_url("roster/save/apply"); ?>" id='new_application' method="post">
<h1>Join WYBC</h1>
<p><?php echo $intro_blurb; ?></p>

<!-- Hidden Form Fields -->
<div id='hidden_fields'>
	<!-- Undergrad [denotes affiliation]
		0 = Community Member
		1 = Yale Undergraduate
		2 = Yale Graduate
		3 = Yale Faculty / Staff  -->
	<?php if($associate) { ?>
	<input type='hidden' name='undergrad' value='0' />
	<?php } elseif($undergrad) { ?>
	<input type='hidden' name='undergrad' value='1' />
	<?php } ?>
	<input type='hidden' name='app_type' value='apply' />
</div>
	

<div id='basics'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>The Basics</h2>
	
	
	<!-- First Name, Middle Initial & Last Name -->
	<table rel='Names'>
		<tr>
			<td><label>First Name</label></td>
			<td><label>Middle Initial</label></td>
			<td><label>Last Name</label></td>
		</tr>
		<tr>
			<td>
				<input name="first_name" type="text" value="" class='required' />
			</td>
			<td>
				<input name="middle_initial" type="text" value="" style='width: 86px;' class='required' />
			</td>
			<td>
				<input name="last_name" type="text" value="" class='required' />
			</td>
		</tr>
	</table>
	<!-- eof Names -->
	
	
	<!-- [Undergrads] Residential College, Class Year & Major -->
	<?php if($undergrad) { ?>
	<p>
		<label>Residential College</label>
		<select name="college" class='required'>
				<option></option>
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
	</p>
	<p>
		<label>Class Year</label>
		<input name="class" type="text" value="" class='required' maxlength="4" />
	</p>
	<p>
		<label>Major</label>
				<input name="major" class='required' type="text" value="" />
	</p>
	<?php } ?>
	<!-- eof Undergrad Info-->
	
	
	<!-- [Associates] ID Info -->
	<?php if($affiliate || $associate) { ?>
	<div id='id_info'>
		<p>
			<label>Driver's License #</label>
			<input type='text' class='required' name='drivers_license_number' value='' />
		</p>
		<p>
			<label>Driver's License State</label>
			<select name="drivers_license_state" class='required'>
				<option></option>
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
	<p>
		<label>Yale Affiliation</label>
		<label class="normal">
			<input type="radio" id="undergrad_1" value="2" name="undergrad" class='required'>
			Yale graduate student
		</label>
		<label class="normal">
			<input type="radio" id="undergrad_1" value="3" name="undergrad" class='required'>
			Yale faculty/staff
		</label>
		<label for="undergrad" class="error" style='display: none;'>Please select your Yale affiliation.</label>

	</p>
	<p>
		<label>Department</label>
		<input type='text' name='department' class='required' />
	</p>
	<p>
		<label>Yale SID</label>
		<input type="text" name='yale_sid' class='required' />
	</p>
	<?php } ?>
	<!-- eof Yale Affiliate Info -->
	
</div>

<div id='contact'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>Contact & Address Information</h2>
	
	
	<!-- [Undergrads + Affiliates] Yale Email & Alternate Email-->
	<?php if ( $undergrad || $affiliate ) { ?>
	<p>
		<label>Yale Email</label>
		<input type='text' name='email_yale' class='required email' />
	</p>
	<p>
		<label>Alternative Email</label>
		<input type='text' name='email_personal' />
	</p>
	
	<?php } ?>
	<!-- eof Yalies' email -->
	
	
	<!-- [Associates] Email -->
	<?php if ($associate){ ?>
	<p>
		<label>Email Address</label>
		<input type='text' name='email_personal' class='required' />
	</p>
	<?php } ?>
	<!-- eof Associates Email-->
	
	<!-- [All] Phone Numbers -->
	<h3>Phone Numbers</h3>
	<div>
		<p>
			<label>Cell</label>
			<input type="text" name='phone_mobile' id='phone_mobile' />
		</p>
		<p>
			<label>Home</label>
			<input type="text" name='phone_home' id='phone_home' />
		</p>
		<p>
			<label>Work</label>
			<input type="text" name='phone_work' id='phone_work' />
		</p>
	</div>
	<!-- eof Phone Numbers-->
	
	<!-- [All] Home Address-->
	<h3>Home Address</h3>
	<p>
		<label>Street Address / PO Box</label>
		<input type='text' name='home_address' class='required'  />
	</p>
	<table>
		<tr>
			<td><label>City</label></td>
			<td><label>State</label></td>
			<td><label>ZIP Code</label></td>
		</tr>
		<tr>
			<td>
				<input type='text' name='home_city' class='input_city required' />
			</td>
			<td>
				<select name="home_state">
					<option value=''></option>
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
				<input name='home_zip' class='input_zip'  type="text" />
			</td>
		</tr>
	</table>
	<p>
		<label>Country (if not USA)</label>
		<input id='home_country' name='home_country' type='text'  />
	</p>
	<!-- eof Home Address-->
</div>


<!-- [Associates & Affiliates] Background Information -->
<?php if( $associate || $affiliate ) { ?>
<div id='education'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>Education</h2>
	<h3>College</h3>
	<div>
		<p>
			<label>Name</label>
			<input type='text' name='college_name'>
		</p>
		<table id='college_location'>
			<tr>
				<td><label>City</label></td>
				<td><label>State</label></td>
				<td><label>ZIP Code</label></td>
			</tr>
			<tr>
				<td>
					<input type='text' name='college_city' class='input_city'  />
				</td>
				<td>
					<select name="college_state">
						<option value=''></option>
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
					<input name='college_zip' class='input_zip'  type="text" />
				</td>
			</tr>
		</table>
		<p>
			<label>Dates Attended</label>
			<input type='text' name='college_dates'>
		</p>
		<p>
			<label>Degree</label>
			<input type='text' name='college_degree'>
		</p>
	</div>
	<h3>High School</h3>
	<div>
		<p>
			<label>Name</label>
			<input type='text' name='highschool_name' class='required'>
		</p>
		<table id='highschool_location'>
			<tr>
				<td><label>City</label></td>
				<td><label>State</label></td>
				<td><label>ZIP Code</label></td>
			</tr>
			<tr>
				<td>
					<input type='text' name='highschool_city' class='input_city required'  />
				</td>
				<td>
					<select name="highschool_state" class='required'>
						<option value=''></option>
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
					<input name='highschool_zip' class='input_zip'  type="text" />
				</td>
			</tr>
		</table>
		<p>
			<label>Dates Attended</label>
			<input type='text' name='highschool_dates' class='required'>
		</p>
		<p>
			<label>Year of Graduation</label>
			<input type='text' name='highschool_graduation' class='required'>
		</p>
	</div>
	<h3>Other / Trade School</h3>
	<div>
		<p>
			<label>Name</label>
			<input type='text' name='other_name'>
		</p>
		<table id='other_location'>
			<tr>
				<td><label>City</label></td>
				<td><label>State</label></td>
				<td><label>ZIP Code</label></td>
			</tr>
			<tr>
				<td>
					<input type='text' name='other_city' class='input_city'  />
				</td>
				<td>
					<select name="other_state">
						<option value=''></option>
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
					<input name='other_zip' class='input_zip'  type="text" />
				</td>
			</tr>
		</table>
		<p>
			<label>Dates Attended</label>
			<input type='text' name='other_dates'>
		</p>
	</div>
</div>
<div id='employment'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>Employment</h2>
	<div>
		<p>
			<label>Employer</label>
			<input type='text' name='employment_name' class='required'>
		</p>
		<table id='employment_location'>
			<tr>
				<td><label>City</label></td>
				<td><label>State</label></td>
				<td><label>ZIP Code</label></td>
			</tr>
			<tr>
				<td>
					<input type='text' name='employment_city' class='input_city required' />
				</td>
				<td>
					<select name="employment_state" class='required'>
						<option value=''></option>
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
					<input name='employment_zip' class='input_zip required' type="text" />
				</td>
			</tr>
		</table>
		<p>
			<label>Phone Number</label>
			<input type='text' name='employment_phone' class='required'>
		</p>
		<p>
			<label>Date Hired</label>
			<input type='text' name='employment_date_hired' class='required'>
		</p>
		<p>
			<label>Title</label>
			<input type='text' name='employment_title' class='required'>
		</p>
		<p>
			<label>Supervisor's Name</label>
			<input type='text' name='employment_supervisor_name' class='required'>
		</p>
		<p>
			<label>Supervisor's Phone Number</label>
			<input type='text' name='employment_supervisor_phone' class='required' >
		</p>
	</div>
</div>
<div id='references'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>References</h2>
	<p class='instructions'>Please list two non-related persons who are familiar with the quality of your work or have directly worked with you for at least two years.</p>
	<h3>Reference One</h3>
		<p>
			<label>Name</label>
			<input type='text' name='reference_one_name' class='required'>
		</p>
		<p>
			<label>Address</label>
			<input type='text' name='reference_one_address' class='required'>
		</p>
		<p>
			<label>Phone Number</label>
			<input type='text' name='reference_one_phone' class='required'>
		</p>
		<p>
			<label>Relationship</label>
			<input type='text' name='reference_one_relationship' class='required'>
		</p>
	<h3>Reference Two</h3>
		<p>
			<label>Name</label>
			<input type='text' name='reference_two_name' class='required'>
		</p>
		<p>
			<label>Address</label>
			<input type='text' name='reference_two_address' class='required'>
		</p>
		<p>
			<label>Phone Number</label>
			<input type='text' name='reference_two_phone' class='required'>
		</p>
		<p>
			<label>Relationship</label>
			<input type='text' name='reference_two_relationship' class='required'>
		</p>	
</div>
<?php } ?>
<!-- eof Background Information -->


<div id='fcc'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>Federal & FCC Requirements</h2>
	<p>
		<label>US Citizen</label>
		<label class='normal'><input type="radio" name="us_citizen" value="1" id="us_citizen_0" class='required' />Yes</label>
		<label class='normal'><input type="radio" name="us_citizen" value="0" id="us_citizen_0" class='required not_citizen' />No</label>
		<label class='error' for='us_citizen' style='display: none;'>Please choose whether you are a US citizen.</label>
	</p>
	<p>
		<label>If no, country of citizenship</label>
		<input name='citizen_of' type="text" />
	</p>
	<p>
		<label>Principal Profession / Occupation</label>
		<input type='text' name='profession' class='required' />
	</p>
	<p>
		<label>Describe any interest (ownership, employment or official relationship) you have in any other
		broadcast station:</label>
		<textarea name='stake_in_other_stations'></textarea>
	</p>
	
	<!-- [All] Convictions -->
	<h3>Convictions</h3>
	<p class='instructions'>Has an adverse finding been made or final action been taken against you (or any other entity
		in which you have an attributable interest by FCC standards) by any court or administrative
		body in a civil or criminal proceeding, brought under the provisions of any law relating to the
		following? Check all that apply.</p>
	<label><input type='checkbox' name='conviction_felony' value='1'  />Any felony</label>
	<label><input type='checkbox' name='conviction_antitrust'  value='1' />Broadcast related antitrust or unfair competition</label>
	<label><input type='checkbox' name='conviction_fraud' value='1'  />Criminal fraud or fraud before another governmental unit</label>
	<label><input type='checkbox' name='conviction_discrimination'  value='1'  />Discrimination</label>
	
	
	<p>Check below if you have you been subject to a denial of Federal benefits by any Federal or State court pursuant to Section 5301 of the Anti-Drug Abuse Act of 1988</p>
	<label><input type='checkbox' name='drug_abuse_act'  value='1' />Anti-Drug Abuse Act of 1988</label>
	
	<p>If you answered yes to any of those questions, attach a full description of the matters involved, including an identification of the court or administrative body, the proceeding (by dates and file numbers), and the disposition of the litigation. </p>
	<!-- eof convictions -->


	<!-- [All] Ethnicity -->
		<h3>Ethnicity</h3>
		<div>
		<p class='instructions'>The FCC now asks broadcast stations for information on the race and ethnicity of board
		members and officers. Please indicate your race/ethnicity by marking the appropriate box
		below: </p>
		
		<label>
			<input type="radio" name="ethnicity" value="American Indian or Alaska Native" id="ethnicity_0" class='required' />
			American Indian or Alaska Native
		</label>
		
		<label>
			<input type="radio" name="ethnicity" value="Hispanic or Latino" id="ethnicity_1" class='required'  />
			Hispanic or Latino
		</label>
		
		<label>
			<input type="radio" name="ethnicity" value="Asian" id="ethnicity_2"  class='required' />
			Asian
		</label>
		
		<label>
			<input type="radio" name="ethnicity" value="White" id="ethnicity_3" class='required' />
			White
		</label>
		
		<label>
			<input type="radio" name="ethnicity" value="Black or African American" id="ethnicity_4" class='required' />
			Black or African American
		</label>
		
		<label>
			<input type="radio" name="ethnicity" value="Native Hawaiian or Other Pacific Islander" id="ethnicity_5" class='required' />
			Native Hawaiian or Other Pacific Islander 
		</label>
		<label class='error' style='display: none;' for='ethnicity'>Please select your ethnicity.</label>
		</div>
	<!-- eof Ethnicity -->
</div>


<div id='squads'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>Station Squads</h2>
	
	<!-- [All] Squads -->
	<p class='instructions'>All members are required to serve dutifully and valiantly on one or more squads. 
		Squads will meet once a week at the discretion of squadron leaders.</p>
		<?php foreach( $teams as $row ) 
		{
			/*
			echo "<label><input type='checkbox'";
			if( isset($members['teams'][$row['id']]) && $members['teams'][$row['id']]==1)
				echo "checked='checked' ";
			echo "name='team_".$row['id']."' value='1' /><span class='subtitle'>".$row['title']."</span><span class='subdescription'>".$row['description']."</span></label>";
			*/
			echo "<label><input type='checkbox'";
			if( isset($members['teams'][$row['id']]) && $members['teams'][$row['id']]==1)
				echo "checked='checked' ";
			echo "name='team[]' value='".$row['id']."' class='required' /><span class='subtitle'>".$row['title']."</span><span class='subdescription'>".$row['description']."</span></label>";
			
		} 
		?>
		<label class='error' for='team[]' style='display: none;'>Please select at least one squad.</label>
	<!-- eof Squads-->
	
</div>


<div id='statement'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>Personal Statement</h2>
	<p class='instructions'>Why you would like to be a member of WYBC? Tell us in 150 to 750 words (we don't have room to train all who apply).</p>
	<textarea name='statement' style='width: 97%;' rows='15' class='required'></textarea>
</div>

<div id='training'>
	<h2><span class='number'><?php echo $i; $i++; ?></span>Training</h2>
	<p class='instructions'>Please select one of the Core Training sessions below to attend.</p>
	<?php if(count($training)>0) {
		foreach($training as $key=>$val){?>
		<label><input type='radio' class='required' name='training' value='<?php echo $val['event_id']; ?>' />
		<?php echo date('F jS Y', strtotime($val['start_date']))." ".date('g:ia', strtotime($val['start_date']))." - ".date('g:ia', strtotime($val['end_date'])); ?></label>
	<?php } ?>
	<label class='error' for='training' style='display: none;'>Please select a core training session.</label>
	<?php  }
	else { 
		echo "<p>No training dates found.</p>";
	}?>
</div>


<div id='finish'>
	<p>By clicking submit, I certify all the above information is true and complete. I will let WYBC know if any changes occur in
		the information provided in this application (as required by the FCC).</p>
	<p><input type='submit' class='red_button left' value='Submit Your Application' style='font-family: helvetica, arial, sans-serif;' /></p>
	<br style='clear: both;' />
</div>
</form>
</div>
<script>
$(function(){

	$("#new_application").validate({
   		rules: {
       			citizen_of: 
       			{
         			required: ".not_citizen:checked"
       			},
       			home_state:
       			{
       				required: "#home_country:blank"
       			},
       			home_zip:
       			{
       				required: "#home_country:blank"
       			},
       			team:
       			{
       				required: true,
       				minlength: 1
       			},
       			phone_mobile:
       			{
       				required: function() {
       							var home = $("#phone_home").val();
       							var work =  $("#phone_work").val();
    							if(home==""&&work=="")
    							{
       								return true;
       							}
       							else
       							{
       								return false;
       							}
       						}
       					
       			},
       			phone_home:
       			{
        				required: function() {
       							var mobile = $("#phone_mobile").val();
       							var work =  $("#phone_work").val();
    							if(mobile==""&&work=="")
    							{
       								return true;
       							}
       							else
       							{
       								return false;
       							}
       						}
       			},
       			phone_work:
       			{
       				required: function() {
       							var home = $("#phone_home").val();
       							var mobile =  $("#phone_mobile").val();
    							if(home==""&&mobile=="")
    							{
       								return true;
       							}
       							else
       							{
       								return false;
       							}
       						}
       			}
     		},
     		messages: {
     			phone_mobile: "Please enter at least one phone number.",
     			phone_home: "Please enter at least one phone number.",
     			phone_work: "Please enter at least one phone number."
     		}
	});
});
</script>