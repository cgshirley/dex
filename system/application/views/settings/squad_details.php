<style>
#container{
	width: 600px;
	min-height: 400px;
	padding: 20px 50px;
}
</style>
<div id='container'>
<h2><?php echo $squad['team_title']; ?> Roster</h2>
<table class='display' id='squad_roster' style='font-size: 12px;'>
<thead>
<tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th style='width: 50px;'></th>
</tr>
</thead>
<tbody>
<?php foreach($members as $member) { ?>
<tr id='<?php echo $member['member_id']; ?>'>
	<td><?php echo $member['first_name']; ?></td>
	<td><?php echo $member['last_name']; ?></td>
	<td><a href='#' rel='<?php echo site_url('settings/squads/delete_member/'.$squad['team_id']); ?>' class='remove_member'><img src="<?php echo base_url(); ?>assets/images/icon_delete.png" title="Delete This Member" /></a>
	</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>