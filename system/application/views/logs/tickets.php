<h1><?php echo $headline; ?></h1>
<table id='tickets' class='display'>
<thead>
<tr>
<th>Summary</th>
<th>Priority</th>
<th>Studio</th>
<th>Added</th>
<th></th>
</tr></thead><tbody>
<?php
foreach($tickets as $row)
{
	echo "<tr id='".$row['ticket_id']."'>";
	echo "<td>".$row['summary']."</td>";
	echo "<td>".$row['priority']."</td>";
	echo "<td>".$row['studio']."</td>";
	echo "<td>".$row['created']."</td>";
	echo "<td><a href='".site_url("logs/ticket/edit")."/".$row["ticket_id"]."' class='edit_row'><img src='".base_url()."assets/images/icon_edit.png' /></a>
	<a href='#' class='remove_row'><img src='".base_url()."assets/images/icon_delete.png' /></a></td></tr>";
}
?>
</tbody>
</table>
<div id='dialog' style='display: none'><img src='<?php echo base_url(); ?>assets/images/loading.gif'  style='margin: 0 auto;' /></div>
<script>
var logTable;
$(function(){
	logTable = $("#tickets").dataTable( { 
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"iDisplayLength": 15,
				"aaSorting": [[3,'desc']],
				"aoColumns": [ {"sWidth": "50%"}, {"sWidth": "8%"}, {"sWidth":"8%"},   {  "sWidth": "26%" },{"bSortable": false,"sWidth":"6%"}]
	});
	$(".remove_row").live("click", function(){
		var tr = $(this).parent().parent();
		var log_id = tr.attr('id');
		logTable.fnDeleteRow(logTable.fnGetPosition( tr[0] ));
		$.post("<?php echo site_url('logs/ajaxData/disable_ticket'); ?>", { "ticket_id": log_id });
	});
});
</script>