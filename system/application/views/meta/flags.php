<!--<h1 class='meta_headline'>Meta<span class='meta_black'>Flags</span></h1>-->
<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#meta"); ?>" id='ticket_link'>Meta</a> | Flags</p>
<table id='flags' class='display'>
<thead>
<tr>
<th>Type</th>
<th>Item</th>
<th>Correction</th>
<th>Date</th>
<th></th>
</tr></thead><tbody>
<?php
foreach($flags as $row)
{
	echo "<tr id='".$row['id']."'>";
	echo "<td>".ucwords($row['type'])."</td>";
	echo "<td>".$row['item']."</td>";
	echo "<td>".$row['correction']."</td>";
	echo "<td>".$row['created']."</td>";
	echo "<td><a href='#' class='remove_row'><img src='".base_url()."assets/images/icon_check.png' style='width: 16px;' /></a></td></tr>";
}
?>
</tbody>
</table>
<a href="<?php echo site_url('admin'); ?>" class='red_button left' > Back to Admin Menu</a>
<script>
var flagTable;
$(function(){
	flagTable = $("#flags").dataTable( { 
										"bJQueryUI": true,
										"sPaginationType": "full_numbers",
										"iDisplayLength": 15,
										"aaSorting": [[3,'desc']],
										"aoColumns": [ {"sWidth": "10%"}, {"sWidth":"33%"}, {"sWidth":"33%"}, { "sWidth": "20%" }, {"sWidth": "4%", "bSortable": false} ]
	});
	$(".remove_row").live("click", function(){
		var tr = $(this).parent().parent();
		var log_id = tr.attr('id');
		flagTable.fnDeleteRow(flagTable.fnGetPosition( tr[0] ));
		$.post("<?php echo site_url('meta/ajaxData/resolved_flag'); ?>", { "flag_id": log_id });
	});
});
</script>