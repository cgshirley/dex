<!--<h1 class='meta_headline'>Meta<span class='meta_black'>Albums</span></h1>-->
<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#meta"); ?>" id='ticket_link'>Meta</a> | Manage Albums</p>
<table id='artists' class='display'>
<thead>
<tr>
<th>Album Title</th>
<th>Artist</th>
<th>Added...</th>
<th></th>
</tr></thead><tbody>
<?php
foreach($albums as $row)
{
	echo "<tr id='".$row['album_id']."'>";
	echo "<td>".$row['album_title']."</td>";
	echo "<td>".$row['artist_name']."</td>";
	echo "<td>".date("Y-m-d",strtotime($row['date_added']))."</td>";
	echo "<td><a href='".site_url("meta/albums/edit")."/".$row["album_id"]."' class='edit_row'><img src='".base_url()."assets/images/icon_edit.png' /></a></td></tr>";
}
?>
</tbody>
</table>
<a href="<?php echo site_url('admin'); ?>" class='red_button left' > Back to Admin Menu</a>
<div id='dialog' style='display: none'><img src='<?php echo base_url(); ?>assets/images/loading.gif'  style='margin: 0 auto;' /></div>
<script>
var logTable;
$(function(){
	logTable = $("#artists").dataTable( { 
										"bJQueryUI": true,
										"sPaginationType": "full_numbers",
										"iDisplayLength": 15,
										"aaSorting": [[0,'asc']],
										"aoColumns": [ {"sWidth": "35%"}, {"sWidth": "35%"}, {"sWidth":"15%"},   { "bSortable": false, "sWidth": "15%" }]
	});
	/*$(".remove_row").live("click", function(){
		var tr = $(this).parent().parent();
		var artist_id = tr.attr('id');
		$('#dialog').dialog({
			bgiframe: true,
			resizable: false,
			height:300,
			width: 400,
			title:"Delete this artist?",
			modal: true,
			buttons: {
				'Delete': function() {
					$.post("<?php echo site_url('meta/ajaxData/delete_artist'); ?>", 
											{"artist_id": artist_id, "type":"delete"});
					logTable.fnDeleteRow(logTable.fnGetPosition( tr[0] ));
					$(this).dialog('destroy');
				},
				'Merge': function() {
					$(this).dialog('option', 'title', 'Merge artists');
					$(this).dialog('option', 'buttons', 
										{ 'Merge': function(){
											$.post("<?php echo site_url('meta/ajaxData/delete_artist'); ?>", 
											{"artist_id": artist_id, "new_artist_id": $("#merge_options").val(), "type":"merge"});
											$("#dialog").html("<p>Artists successfully merged!</p>");
											$(this).dialog('option', 'title', 'Success!');
											$(this).dialog('option', 'buttons', { 'OK': function(){ 
		logTable.fnDeleteRow(logTable.fnGetPosition( tr[0] )); 
		$(this).dialog('destroy'); } });
											
																		}, 
										  Cancel:  function(){ 
																$(this).dialog('destroy'); }});
					$.post("<?php echo site_url('meta/ajaxData/delete_artist'); ?>", 
						{"artist_id": artist_id, "type":"merge-list"}, function(data)
							{
								$("#dialog").html(data);
							}, 
						"html");
				},
				Cancel: function() {
					$(this).dialog('destroy');
				}
			}
		});
		$(".ui-dialog-titlebar-close").hide();
		$.post("<?php echo site_url('meta/ajaxData/delete_artist'); ?>", {"artist_id": artist_id, "type":"stats"}, function(data)
			{
				$("#dialog").html(data);
			}, "html");
		

		
		
	
	//});*/
	
});
</script>