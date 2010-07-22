
<h1>Roster</h1>
<div id='members_main'>
<div id='toggler'>

	<a href='#' class='status_button active_status_button' rel="m.status_id=6">Active</a>
	
	<a href='#' class='status_button' rel="m.class='2010'">2010</a>
	<a href='#' class='status_button' rel="m.class='2011'">2011</a>
	<a href='#' class='status_button' rel="m.class='2012'">2012</a>
	<a href='#' class='status_button' rel="m.class='2013'">2013</a>
	<br style='clear: both;' />
</div>

<form id='selection' name='selection'>
<table id='roster' class='display'>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Cell Phone</th>
			<th>College</th>
			<th>Year</th>
			<th></th>
		</tr>
	</thead>
	<tbody id='roster_content'>
	</tbody>
</table>
</div>
<div id='members_menu'>
</div>
<script>
var $table;
$(function(){						
	$("a.status_button").click(function(){
		$('a.active_status_button').removeClass('active_status_button');
		$(this).addClass('active_status_button');
		$("#select_all").removeAttr("checked");
		load_data($(this).attr("rel"), 0);
		return false;
	});
	$('#select_all').click(function(){ 
		var checked_status = this.checked;
		$("input:checkbox").each(function(){
			if(!$(this).parent().parent().hasClass('hiddenRow'))
				this.checked = checked_status;
		});
	});

	function load_data($where, $edit)
	{
		$("#roster_content").html("<td colspan='7' style='text-align: center;'><span style='color: #ccc; font-size: 11px; padding-top: 30px; display: block;'>Loading</span> <br><img style='margin-bottom: 20px;' src='<?php echo base_url(); ?>assets/images/loading.gif' /></td>");
		$.post("<?php echo site_url("roster/ajax/fetch_roster_rows"); ?>", 
			{ where : $where, edit: $edit }, 
			function(data){
				$("#roster_content").html("");
				$table.fnClearTable();
				$table.fnAddData(data);
			}, 
			"json");
	}
	$table = $('#roster').dataTable( {
		"bJQueryUI": true,
		"bPaginate": false,
		"iDisplayLength": 10,
		"aaSorting": [[0,'asc']],
		"aoColumns": [ {"sWidth":"30%"}, {"sWidth":"30%"}, { "sWidth": "11%" },{ "sWidth": "7%" },{ "sWidth": "6%" },{"bSortable":false }]

	} );

	load_data("m.status_id=6", 0);
	
	
	
	
	$("#exportData").fancybox({
		callbackOnShow: compile_export,
		frameWidth: 700,
		frameHeight: 300,
		padding: 50,
		hideOnContentClick: false
		});
	
	
	function compile_export(){
		var list = "";
		var i = 0;
		$("input.selections").each(function(){
			if($(this).is(":checked"))
			{
				list += $(this).val()+"-";
				i++;
			}
		});
		
		$('a.exportBucket').click(function(){			
			var idd = $(this).attr("id");
			var href = $(this).attr('href');
			href += "/"+list;
			$(this).attr("href",href);
		});
		
	}
});

</script>

	




