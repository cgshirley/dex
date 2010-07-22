<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#roster"); ?>" id='ticket_link'>Roster</a> | Manage Drupal Accounts</p>

<p><?php echo $member_count; ?> Active Members Total</p>
<p><?php echo $accountless_count; ?> Members without Drupal Accounts</p>
<p><a href="<?php echo site_url('roster/drupal/update'); ?>" class='red_button left '>Sync WYBCDJ & Drupal</a></p>
<br style='clear: both;' />
<br />
<table >
<thead>
<tr><th>Name</th><th>Drupal ID</th></tr>
</thead>
<tbody>
<?php foreach($members as $obj)
{
	echo "<tr><td>".$obj->last_name.", ".$obj->first_name.".</td>";
	echo "<td>".$obj->drupal_id."</td></tr>";
}
?>
</tbody>
</table>
<a href="<?php echo site_url('admin'); ?>" class='red_button left' > Back to Admin Menu</a>