<img src='<?php echo base_url()."assets/images/headings/".$heading_img; ?>' id='heading_img' />
<div id='members_main'>
<div id='toggler'>
	<a href='#' class='status_button active_status_button' id='status_all'>All</a>
	<?php
foreach($status as $key=>$val)
{
echo "<a href='#' class='status_button' id='status_".$key."'>".$val."</a>";
}
?>
	<br style='clear: both;' />
</div>
<table class='roster'>
	<thead>
		<tr>
			<th style='width: 22px;'><input type='checkbox' id='select_all' /></th>
			<th style='width: 180px;'>Name</th>
			<th style='width: 200px;'>Email</th>
			<th style='width: 100px;'>Cell Phone</th>
			<th style='width: 100px;'>College</th>
			<th>Year</th>
			<th>Status</th>
			<th style='width: 66px;'></th>
		</tr>
	</thead>
	<tbody>
		<?php 
$i=0;
foreach($roster as $key=>$val) 
{
	echo "<tr id='member_".$val['member_id']."' class='member status_".$val['status_id']."'>";
	echo "<td id='checktd'><input name='selector' class='member_".$val['member_id']."' type='checkbox' /></td>";
	echo "<td>".$val['last_name'].", ".$val['first_name']."</td>";
	echo "<td>".$val['email_personal']."</td>";
	echo "<td>".$val['phone_mobile']."</td>";
	echo "<td>".$val['college']."</td>";
	echo "<td>".$val['class']."</td>";
	echo "<td>".$val['status']."</td>";
	echo "<td><a href='".site_url('members/view/'.$val['member_id'])."'><img src='../../assets/images/icon_search.png' /></a>";
	echo "<a href='".site_url('members/edit/'.$val['member_id'])."'><img src='../../assets/images/icon_edit.png' /></a>";
	echo "<a href='".site_url('members/delete/'.$val['member_id'])."'><img src='../../assets/images/icon_delete.png' /></a></td></tr>";
	$i++;
} 
?>
	</tbody>
</table>
</div>
<div id='members_menu'>
</div>
<script>
$(function(){
	var qs = $("table.roster tbody tr").quicksearch(
			{		stripeRowClass: ['odd', 'even'],
					position: 'before',
					attached: 'table',
					labelText: 'Live Search',
					delay: 0	
			});	
						
	$("a.status_button").click(function(){
		$('a.active_status_button').removeClass('active_status_button');
		var $id = $(this).attr("id").substr(7);
		$(this).addClass('active_status_button');
		$("#select_all").removeAttr("checked");
		if ( $id != "all" && $id != "" )
		{
			$("tr.member").each(function(){
				if ( $(this).hasClass("status_"+$id) )
				{
					$(this).removeClass("hiddenRow");
					qs.reset_cache();
				}
				else
				{
					$(this).addClass("hiddenRow");
					qs.reset_cache();
				}
			});
		}
		else
		{
			$.each($("tr.member"), function(){
				$(this).removeClass('hiddenRow');
				qs.reset_cache();
			});
		}
	});
	$('#select_all').click(function(){ 
		var checked_status = this.checked;
		$("input:checkbox").each(function(){
			if(!$(this).parent().parent().hasClass('hiddenRow'))
				this.checked = checked_status;
		});
	});

});

</script>
