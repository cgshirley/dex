<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("settings"); ?>" id='ticket_link'>Settings</a> | Edit DJ Profile</p>
<form action="<?php echo site_url('settings/profile'); ?>" method='post' class='big'>
<input type='hidden' value='<?php echo $profile['nid']; ?>' name='nid' />
<input type='hidden' value="<?php echo $user_id; ?>" name='user_id' />
<input type='hidden' value='<?php echo $member_id; ?>' name='member_id' />
<p><label>DJ Name</label></p>
<p><input type='text' name='name' value='<?php if(!empty($profile['name'])) echo $profile['name']; ?>' /></p>
<p><label>Status</label></p>
<p><input type='text' name='status' value='<?php if(!empty($profile['status'])) echo $profile['status']; ?>' /></p>
<p><label>Hometown</label></p>
<p><input type='text' name='hometown' value='<?php if(!empty($profile['hometown'])) echo $profile['hometown']; ?>' /></p>
<p><label>About Me</label></p>
<p><textarea name='bio' id='bio'><?php if(!empty($profile['bio'])) echo $profile['bio']; ?></textarea></p>
<p><input type='submit' class='red_button' value='Update DJ Profile' /></p>
</form>
<script>
$(function(){
	$("#bio").ckeditor(function(){}, {toolbar:'Basic'});
});
</script>