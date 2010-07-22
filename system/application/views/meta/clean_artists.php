<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#meta"); ?>" id='ticket_link'>Meta</a> | Clean Artists</p>
<h2>Flagged Artists</h2>
<?php if(empty($flagged)) { ?>
<p>No artists were flagged. Yay!</p>
<?php } else {?>
<ul>
<?php 
foreach($flagged as $val)
{
	echo "<li><span style='color: red'>".$val['artist_name']."</span> => ".$val['new']."</li>";
}
?>
</ul>
<?php } ?>
<h2>All New Artists</h2>
<?php if(empty($flagged)) { ?>
<p>No new artists found.</p>
<?php } else {?>
<table id='artists'>
<thead>
<tr>
<th>Artist</th>
<th>Listeners</th>
<th>Last.fm URL</th>
</tr>
</thead>
<tbody>
<?php
foreach($artists as $val)
{
	echo "<tr><td>".$val['name']."</td><td>".$val['stats']['listeners']."</td><td>".$val['url']."</td></tr>";
}

?>
</tbody>
</table>

<?php } ?>
<a href="<?php echo site_url('admin'); ?>" class='red_button left' > Back to Admin Menu</a>
<script>
var logTable;
$(function(){
	$("#artists").css("width", "100%");
	logTable = $("#artists").dataTable( { 
					"bJQueryUI": true
	});
	
});
</script>