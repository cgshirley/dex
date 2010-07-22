<style>
#go_live_link{
	background: red;
	color: white;
	padding: 10px;
	text-decoration: none;
	display: block;
	width: 150px;
	margin-top: 20px;
	text-align: center;
}
</style>
<div style='width: 400px;'>
<h2>Go Live</h2>
<p>By clicking "Go Live," the song you just selected will be logged and displayed in the "now playing" section of the website. So. That means you should only press that red button if you are on the air. If you're not, we know who you are, and we will find you. Also, it starts an automated recording of your show. So be sure to press the button right when your show officially "starts."</p>
<label>Which studio are you in?</label>
<form name='go_live' id='go_live' action='<?php echo site_url('meta/ajaxData/go_live'); ?>'>
<select id='studio_select' name='studio'>
<option>X</option>
<option>Moon</option>
<option>AM</option>
<option>FM</option>
</select>
<input id='track_id' value='<?php echo $id; ?>' type='hidden' />
<input id='episode_id_live' value='<?php echo $episode; ?>' type='hidden' />
<a href='#' id='go_live_link' >Go Live</a>
</form>
</div>