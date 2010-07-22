<style>
#container{
	width: 600px;
	padding: 20px 50px;
}
input[type=text], textarea {
	font-family: helvetica, arial, sans-serif;
	font-size: 18px;
	width: 580px;
	padding: 5px;
}
#start_date{
	width: 200px;
}
</style>

<div id='container'>
<h2>New Event</h2>
<form action='<?php echo site_url("roster/events/new"); ?>' method='post' class='ui-widget'>
<p><label>Title</label>
<input type='text' name='title' /></p>

<p><label>Type of Event</label>
<select name='type'>
		<option value='gboard'>General Board Meeting</option>
		<option value='training'>Training</option>
	</select></p>
<p>
<table>
<tr>
<td><label>Date</label>
<input type='text' id='start_date' name='start_date' /></td>
<td style='width: 200px;'><label>Start Time</label>
	<select name='start_hour'>
	<option>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>	
	<option>5</option>
	<option>6</option>	
	<option>7</option>
	<option>8</option>	
	<option>9</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	</select> : <select name='start_minutes'>
		<option>00</option>
		<option>15</option>
		<option>30</option>
		<option>45</option></select>
	<select name='start_ampm'>
		<option>AM</option>
		<option selected='selected'>PM</option>
	</select>
</td>
<td style='width: 200px;'>
<label>End Time</label>
<select name='end_hour'>
	<option>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>	
	<option>5</option>
	<option>6</option>	
	<option>7</option>
	<option>8</option>	
	<option>9</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	</select> : <select name='end_minutes'>
		<option>00</option>
		<option>15</option>
		<option>30</option>
		<option>45</option></select>
	<select name='end_ampm'>
		<option>AM</option>
		<option selected='selected'>PM</option>
	</select>
</td>
</tr></table>

<p><label>Description</label>
<textarea name='description' rows='4'></textarea></p>
<p><label><input type='checkbox' name='all_active' checked='checked' />Add All Active Members</label></p>
<p><input type='submit' class="red_button left " value="Create Event" /></p>
</form>
</div>