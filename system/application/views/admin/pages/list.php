<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> |  Manage Page Content</p>
<!--<a href="<?php echo site_url('admin/pages/new'); ?>">New Page Content Area</a>-->
<table class='display'>
<thead>
	<th>Group</th>
	<th>Name</th>
	<th>Title</th>
</thead>
<tbody>
<?php foreach($pages as $key=>$obj) { ?>
	<tr>
		<td><?php echo ucfirst($obj->group); ?></td>
		<td><?php echo $obj->name; ?></td>
		<td><a href="<?php echo site_url('admin/pages/edit/'.$obj->id); ?>"><?php echo $obj->title; ?></a></td>
	</tr>
<?php } ?>
</table>
<script>
$(function(){
	$(".display").dataTable({
		"bJQueryUI": true,
		"bPaginate": false,
		"iDisplayLength": 10
		});
	});
});