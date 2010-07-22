<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#roster"); ?>" id='ticket_link'>Roster</a> | <a href="<?php echo site_url("roster/events"); ?>" id='ticket_link'>Events</a> | View</p>

<h1><?php echo $info->title; ?></h1>
<a href="#" id='all_present' class='red_button left' style='margin-right: 20px;'>Mark Everyone Present</a>
<a href="#" id='all_absent' class='red_button left'>Mark Everyone Absent</a>
<form id='attendence' name='attendence' method="post" action="<?php echo site_url('roster/ajax/attendence'); ?>">
<input type='hidden' name='event_id' value='<?php echo $info->event_id; ?>' />
<table class='display'>
<thead>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Present</th>
		<th>Excused<br />Absence</th>
		<th>Unexcused<br />Absence</th>
		<th></th>
	</tr>
</thead>
<tbody>
<?php foreach($attendees as $key=>$val) { ?>
<tr id='<?php echo $val->member_id; ?>'>
	<td>
		<?php echo $val->first_name; ?>
	</td>
	<td>
		<?php echo $val->last_name; ?>
	</td>
	<td class='radio_box'>
		<input class='present status_<?php echo $val->member_id; if($val->present==1) echo " selected' checked='true"; ?>' type='radio' name='status_<?php echo $val->member_id; ?>' value='present' <?php if($val->present==1) echo "checked='true'"; ?> />
	</td>
	<td class='radio_box'>
		<input class='excused status_<?php echo $val->member_id; if($val->present==0&&$val->excused==1) echo " selected' checked='true"; ?>' type='radio' name='status_<?php echo $val->member_id; ?>' value='excused' />
	</td>
	<td class='radio_box'>
		<input class='absent status_<?php echo $val->member_id; if($val->present==0&&$val->excused==0) echo " selected' checked='true"; ?>' type='radio' name='status_<?php echo $val->member_id; ?>' value='absent' <?php if($val->present==0&&$val->excused==0) echo "checked='true'"; ?> />
	</td>
	<td>
		<a href='#' class='remove_row'>
			<img src='<?php echo base_url(); ?>assets/images/icon_delete.png' />
		</a>
	</td>
</tr>
<?php } ?>
</table>
<input type='submit' class='submit' value="Update Attendence" />
</form>
<script>
var events_table;
$(function(){

	events_table = $(".display").dataTable({
		"bJQueryUI": true,
		"bPaginate": false,
		"iDisplayLength": 10,
		"aaSorting": [[1,'asc']],
		"aoColumns": [ null, null, {"sWidth":"7%", "bSortable": false}, {"sWidth":"7%", "bSortable": false},{"sWidth":"7%", "bSortable": false},{ "sWidth": "5%", "bSortable": false }]
		});
	});
	
	$(".remove_row").live("click", function(){
		var answer = confirm("Are you sure you want to uninvite this person?");
		if(answer)
		{
			var tr = $(this).parent().parent();
			var member_id = tr.attr('id');
			events_table.fnDeleteRow(events_table.fnGetPosition( tr[0] ));
			$.post("<?php echo site_url('roster/ajax/uninvite'); ?>", { "member_id": member_id, "event_id": <?php echo $info->event_id; ?>  });
		}
	});
	$("#attendence").ajaxForm();
	$("#all_present").click(function(){
		$("input.present").attr('checked', 'checked');
	});
	$("#all_absent").click(function(){
		$("input.absent").attr('checked', 'checked');
	});
	$("td.radio_box").click(function(){
		$(this).children("input").attr("checked","checked");
	});
	$("input.selected").attr('checked', 'checked');
</script>