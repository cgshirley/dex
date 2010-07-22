<style>
#container{
	width: 600px;
	padding: 20px 50px;
}
</style>
<div id='container'>
<h2>Update Your Status</h2>
<form action="<?php echo site_url("meta/update_status"); ?>" class='big' method="post" id='update_status_form'>
<input type='hidden' name='nid' value="<?php echo $nid; ?>" />
<p>
	<input type='text' name='status' value='<?php echo $status; ?>' />
</p>
<input type='submit' value='Update Status' class='red_button left' onFocus="this.blur()" />
<br style='clear: both;' />
</form>
</div>