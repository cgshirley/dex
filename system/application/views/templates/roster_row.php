[
{roster}
	[ 	<?php if($edit) { ?>"<input name='selector' class='selections' value='{member_id}' type='checkbox' />",<?php } ?>
		"{last_name}, {first_name}",
		"{email_personal}",
		"{phone_mobile}",
		"{college}",
		"{class}",
		<?php if(!empty($edit) && $edit = TRUE) { ?>"{status}",<?php } ?>
		"<a href='http://www.facebook.com/search/?q={first_name}+{last_name}' target='_BLANK'><img src='{base_url}assets/images/icon_facebook.png' /></a>
	<?php if ( $_POST['edit']==1 ) { ?>
		<a href='<?php echo site_url('roster/edit/'); ?>/{member_id}' ><img src='{base_url}assets/images/icon_edit.png' /></a>
		<a href='{drupal}/user/{drupal_id}/edit/profile' target='_BLANK'><img src='{base_url}assets/images/icon_dj.png' /></a>
		<a href='<?php echo site_url("roster/delete/"); ?>/{member_id}' onclick='javascript:return confirm(&quot;Are you sure you want to delete this member?&quot;)'><img src='{base_url}assets/images/icon_delete.png' /></a>
	<?php } ?>" ],{/roster}]