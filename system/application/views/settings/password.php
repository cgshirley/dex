<style>
input[type='password'] {
	font-size: 1.5em;
}
</style>

<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("settings"); ?>" id='ticket_link'>Settings</a> | Change Password</p>
<?php if(!empty($alert)) {
	echo $alert;
}?>
<form id='change_password' method='post' action="<?php site_url('settings/password'); ?>" >
<input type='hidden' name='user_id' value="<?php echo $user_id; ?>" />
<p><label>Existing Password</label></p>
<p><input name='existing' type='password' value='' /></p>
<p><label>New Password</label></p>
<p><input name='new' type='password' value='' id='new' /></p>
<p><label>Confirm New Password</label></p>
<p><input name='confirm' type='password' value='' id='confirm' /></p>
<input type='submit' />
</form>