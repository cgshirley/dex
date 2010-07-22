<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#roster"); ?>" id='ticket_link'>Roster</a> | Pending Revisions</p>
<?php if(count($revisions)>0){ ?>
<table class='display'>
<thead>
	<th>Type</th>
	<th>Member</th>
	<th>Date</th>
	<th></th>
</thead>
<tbody>
<?php foreach($revisions as $key=>$val) { ?>
<tr>
	<td><?php echo $val['description']; ?></td>
	<td><?php echo $val['first_name']." ".$val['last_name'];?></td>
	<td><?php echo $val['date']; ?></td>
	<td><a class='red_button left' href="<?php echo site_url('roster/revisions/'.$val['id']); ?>">Review</a></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else { ?>
<p>No pending revisions found.</p>
<?php } ?>