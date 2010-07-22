<h1>Roster</h1>
<!--<?php if($edit) { ?><a href="<?php echo site_url("roster/add"); ?>" class='osx_button' id='newMember'></a><?php } ?>-->
<div id='members_main'>
<div id='toggler'>
	<!--<a href='#' class='status_button' rel="m.class='2013'">2013</a>
	<a href='#' class='status_button' rel="m.class='2012'">2012</a>
	<a href='#' class='status_button' rel="m.class='2011'">2011</a>
	<a href='#' class='status_button' rel="m.class='2010'">2010</a>-->
	<ul>
	<li><a href='#' class='status_button' id='status_all'>All</a></li>
	<li><a href='#' class='status_button active_status_button' rel="m.status_id=6">Active</a></li>
	<li><a href='#' class='status_button' rel="m.status_id=6 && membership=1">Full Members</a></li>
	<li><a href='#' class='status_button' rel="m.status_id=6 && membership=0">Associate Members</a></li>
	<li id='add_filter_li'><a href='#' class='new_filter' id='add_filter'>+</a>
		<div id='add_filter_menu'>
			<select id='filter'>
				<?php foreach($filters as $key=>$val) { ?>
					<option value="<?php echo $val; ?>"><?php echo $key; ?></option>
				<?php } ?>
			</select>
			<a href="#" id='add_filter_submit'>Add</a><a href='#' id='add_filter_cancel'>X</a>
		</div>
	</li>
	</ul>
	
	
	
	
	<br style='clear: both;' />
</div>
<form id='selection' name='selection'>
<table id='roster' class='display'>
	<thead>
		<tr>
			<th><input type='checkbox' id='select_all' /></th>
			<th>Name</th>
			<th>Email</th>
			<th>Cell Phone</th>
			<th>College</th>
			<th>Year</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody id='roster_content'>
	</tbody>
</table>
<p>With Selected:</p>
<p>
	<a class='red_button left' style='margin-right: 10px;' href='#exportOptions' id='exportData'>Export Data</a>
	<a class='red_button left' href="<?php echo site_url('roster/ajax/request_update'); ?>" id="request_update">Request Data Update</a>
</p>
<br style='clear: both;' />

<div id='exportOptions' style='display: none;'>
	<h3 id='exportstart' style='margin-top: 0px;'>How would you like your data served?</h3>
	<br  style=" clear: both;" />
	<input type='hidden' name='list' id='list' value='' />
	<input type='hidden' name='format' id='format' value='' />
	<a class='exportBucket' id='csv' href='<?php echo site_url('roster/export/csv'); ?>'>
	<img src='<?php echo base_url(); ?>/assets/images/icon_spreadsheet.png'  />
	Spreadsheet </a>
	<a class='exportBucket' id='contact' href='<?php echo site_url('roster/export/contact'); ?>'>
	<img src='<?php echo base_url(); ?>/assets/images/icon_addressbook.png' style='width: 128px;' />
	Contact List </a>
	<a class='exportBucket' id='detailed' href='<?php echo site_url('roster/export/detailed'); ?>'>
	<img src='<?php echo base_url(); ?>/assets/images/icon_sheets.png' style='width: 128px;' />
	Detailed Sheets </a>
	<a class='exportBucket' id='mailinglist' href='<?php echo site_url('roster/export/mailinglist'); ?>'>
	<img src='<?php echo base_url(); ?>/assets/images/icon_mailinglist.png' style='height: 128px;margin-left: 10px;' />
	Mailing List </a>
</div>
</div>
<div id='members_menu'>
</div>
<script>
var $table;
$(function(){	
	$("#add_filter").live('click', function(){
		$(this).hide();
		$("#add_filter_menu").show();
	});
	$("#add_filter_cancel").live("click", function(){
		$("#add_filter").show();
		$("#add_filter_menu").hide();
	});
	$("#add_filter_submit").live("click", function(){
		var where = $("#filter option:selected").val();
		var title = $("#filter option:selected").text();
		$("#add_filter").show();
		$("#toggler ul").append("<li><a href='#' class='status_button status_button' rel='"+where+"'>"+title+"</a></li>");
		$("#add_filter_li").remove().appendTo("#toggler ul");
		$("#add_filter_menu").hide();
	});
	$("a.status_button").live("click", function(){
		$('a.active_status_button').removeClass('active_status_button');
		$(this).addClass('active_status_button');
		$("#select_all").removeAttr("checked");
		load_data($(this).attr("rel"), <?php if($edit) echo 1; ?>);
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
		"aaSorting": [[1,'asc']],
		"aoColumns": [ {"bSortable": false, "sWidth": "2%"}, {"sWidth":"20%"}, {"sWidth":"22%"}, { "sWidth": "11%" },{ "sWidth": "7%" },{ "sWidth": "6%" },{ "sWidth": "7%" },{"bSortable":false }]

	} );

	load_data("m.status_id=6", <?php if($edit)echo $edit; else echo "'0'"; ?>);
	
	
	
	
	$("#exportData").fancybox({
		callbackOnShow: prep_export,
		frameWidth: 700,
		frameHeight: 300,
		padding: 50,
		hideOnContentClick: false
		});
	$("#request_update").click(function(){
		var list = compile_export();
		var href = $(this).attr('href');
		href += "/"+list;
		$(this).attr("href",href);
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
		return list;
	}
	function prep_export()
	{
		var list = compile_export();
		
		$('a.exportBucket').click(function(){			
			var idd = $(this).attr("id");
			var href = $(this).attr('href');
			href += "/"+list;
			$(this).attr("href",href);
		});
	}
});

</script>

	

