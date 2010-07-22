<h1 class='meta_headline'>Meta<span class='meta_black'>Logs</span></h1>
<table id='logs' class='display'>
<thead>
<tr>
<th>Time</th>
<th>Song</th>
<th>Artist</th>
<th></th>
</tr></thead><tbody>
<?php
foreach($logs as $row)
{
	echo "<tr id='".$row['log_id']."'><td>";
	//echo date("g:iA j F Y",strtotime($row['log_time']));
	echo $row['log_time'];
	echo "<td>".$row['song_title']."</td><td>".$row['artist_name']."</td>";
	echo "<td><a href='#' class='remove_row'><img src='".base_url()."assets/images/icon_delete.png' /></a></td></tr>";
}
?>
</tbody>
</table>
<script>
var logTable;
$(function(){
	logTable = $("#logs").dataTable( { 
										"bJQueryUI": true,
										"sPaginationType": "full_numbers",
										"iDisplayLength": 15,
										"aaSorting": [[0,'desc']],
										"aoColumns": [ {"sWidth": "16%"}, {"sWidth":"40%"}, null, { "bSortable": false, "sWidth": "2%" }]
	});
	$(".remove_row").live("click", function(){
		var tr = $(this).parent().parent();
		var log_id = tr.attr('id');
		logTable.fnDeleteRow(logTable.fnGetPosition( tr[0] ));
		$.post("<?php echo site_url('meta/ajaxData/remove_log'); ?>", { "log_id": log_id });
	});
});
</script>