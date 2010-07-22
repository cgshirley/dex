<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#roster"); ?>" id='ticket_link'>Roster</a> | <a href="<?php echo site_url("roster/revisions"); ?>" id='ticket_link'>Revisions</a> | <?php echo $revision['first_name']." ".$revision['last_name'];
echo ": v".date("n.j.o",strtotime($revision['date'])); ?></p>

<table class='display'>
<thead>
<tr>
	<th style='width: 20%;'>Field</th>
	<th style='width: 40%;'>Current Version</th>
	<th style='width: 40%;'>Revised Version</th>
</tr>
</thead>
<tbody>
<?php foreach($changes as $key=>$val) { ?>
<tr><td><p style='font-weight: bold;'><?php echo $val['title']; ?></p></td>
<td><span style='color:#CB4346 '><?php if(empty($val['old'])) echo "[blank]"; else echo $val['old']; ?></span></td>
<td><span style='color:#348045 '><?php if(empty($val['new'])) echo "[blank]"; echo $val['new']; ?></span></td>
</tr>
<?php } ?>
</tbody></table>
<?php if($revision['approved']==1) { ?>

<h3>This revision was approved.</h3>

<?php } elseif($revision['rejected']==1) { ?>

<h3>This revision was rejected.</h3>

<?php } else {
if($type=='profile') { ?>
<form action="<?php echo site_url('roster/revisions/approved_profile'); ?>" method="post">
<?php } else { ?>
<form action="<?php echo site_url('roster/revisions/approved'); ?>" method="post">
<?php } ?>
<input type='hidden' name='app_type' value='approved'>
<input type='hidden' name='revision_id' value="<?php echo $revision['id']; ?>" />
<input type='hidden' name='member_id' value="<?php echo $revision['member_id']; ?>" />
<input type='submit' style='float: left; margin-right: 10px;' value='Approve Revision' class='red_button' />
</form>

<form action="<?php echo site_url('roster/revisions/reject'); ?>" method="post">
<input type='hidden' name='app_type' value='approved'>
<input type='hidden' name='revision_id' value="<?php echo $revision['id']; ?>" />
<input type='hidden' name='member_id' value="<?php echo $revision['member_id']; ?>" />
<input type='submit' style='float: left; background: #666;' value='Reject Revision' class='red_button' />
</form>
<?php } ?>