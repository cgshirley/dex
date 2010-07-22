<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#roster"); ?>" id='ticket_link'>Roster</a> | Events</p>

<table id='events' style='width: 100%' class='display'>
<thead>
	<tr>
		<th>Title</th>
		<th>Type</th>
		<th>Date</th>
		<th></th>
	</tr>
</thead>
<tbody>
<?php foreach($events as $key=>$val) { ?>
<tr id='<?php echo $val->event_id; ?>'>
	<td><a href="<?php echo site_url('roster/events/view/'.$val->event_id); ?>"><?php echo $val->title; ?></a></td>
	<td><?php echo ucfirst($val->type); ?></td>
	<td><?php echo date("n/j/o", strtotime($val->start_date)); ?></td>
	<td><a href='#' class='remove_row'><img src='<?php echo base_url(); ?>assets/images/icon_delete.png' /></a></td>
</tr>
<?php } ?>
</tbody>
</table>
<a class='red_button left' id='new_squad' style='margin-top: 20px;' href="<?php echo site_url('roster/events/new'); ?>">New Event</a>

<script>
var events_table;
$(function(){
	events_table = $("#events").dataTable({
		"bJQueryUI": true,
		"bPaginate": false,
		"iDisplayLength": 10,
		"aaSorting": [[2,'asc']]});
	});
	$(".remove_row").live("click", function(){
		var answer = confirm("Are you sure you want to delete this event?");
		if(answer)
		{
			var tr = $(this).parent().parent();
			var event_id = tr.attr('id');
			events_table.fnDeleteRow(events_table.fnGetPosition( tr[0] ));
			$.post("<?php echo site_url('roster/ajax/delete_event'); ?>", { "event_id": event_id });
		}
	});
	$("#new_squad").colorbox( {
		onComplete: function(){
			$("#start_date").datepicker();
		}
	});
</script>

