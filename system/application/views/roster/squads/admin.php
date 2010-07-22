<h1>Squads</h1>
<table class='display'>
<thead>
	<tr>
		<th style='width: 250px;'>Name</th>
		<th style='width: 400px;'>Description</th>
		<th>Leader</th>
		<th style='width: 80px;'></th>
	</tr>
</thead>
<tbody>
<?php foreach($squads as $squad) { ?>
	<tr id="<?php echo $squad['team_id']; ?>">
		<td><?php echo $squad['team_title']; ?></td>
		<td><?php echo $squad['team_description']; ?></td>
		<td><?php if(!empty($squad['first_name'])&&!empty($squad['last_name'])) echo $squad['first_name']." ".$squad['last_name']; ?></td>
		<td>
			<a href='<?php echo site_url('settings/squads/'.$squad['team_id']); ?>' class='edit_squad_roster'>
				<img src="<?php echo base_url(); ?>assets/images/icon_user.png" alt='Edit Roster' title='Edit Roster' />
			</a>
			<a href='<?php echo site_url('roster/squads/edit/'.$squad['team_id']); ?>' class='edit_squad'>
				<img src="<?php echo base_url(); ?>assets/images/icon_edit.png" alt='Edit' title='Edit' />
			</a>
			<a href='<?php echo site_url('roster/squads/delete/'.$squad['team_id']); ?>' class='delete_squad'>
				<img src="<?php echo base_url(); ?>assets/images/icon_delete.png" alt='Delete' title='Delete' />
			</a>
		</td>
	</tr>	
<?php } ?>
</tbody>
</table>
<a class='red_button left' id='new_squad' style='margin-top: 20px;' href="<?php echo site_url('roster/squads/new'); ?>">New Squad</a>
<br style='clear: both;' />
<script>
$(function(){
	var roster_table;
	$(".edit_squad").colorbox();
	$("#new_squad").colorbox();
	$(".edit_squad_roster").colorbox( {
		height: 620,
		onComplete: function()
		{
			roster_table = $("#squad_roster").dataTable({ 
										"bJQueryUI": true,
										"sPaginationType": "full_numbers",
										"iDisplayLength": 10,
										"aaSorting": [[1,'asc']],
										"aoColumns": [ null, null, { "bSortable": false, "sWidth": "6%" }]
		});
			$(".remove_member").live("click", function(){
				var tr = $(this).parent().parent();
				var member_id = tr.attr('id');
				var row = roster_table.fnGetPosition( tr[0] );
				roster_table.fnDeleteRow(row);
				var href = $(this).attr('rel');
				$.post(href, { "member_id": member_id });
			});		
		},
		onCleanup: function(){
			roster_table = null;
		}
	});
});
</script>