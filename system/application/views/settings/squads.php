<style>
.title{
	font-size: 1em;
	display: block;
}
.description{
	font-size: .8em;
	display: block;
}
.squad_meta{
}
ul#full li a{
	cursor: pointer;
	outline: none;
	padding-left: 60px;
}
ul#full li a:active{
	outline: none;
}

ul#full li a input{
	margin-left: -10px;
	margin-right: 10px;
}
input.red_button{
	margin-top: 20px;
}
ul#full li.selected a{
background-color: #c3ffb1;
border-bottom: 1px solid white;
background-image: url('<?php echo base_url(); ?>assets/images/icon_check_circle.png');
background-repeat: no-repeat;
background-position: 1% 50%;
padding-left: 60px;
}

</style>
<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("settings"); ?>" id='ticket_link'>Settings</a> | Manage Squads</p>
<?php if(!empty($mine)) { ?>
<h2>Squads You Lead</h2>
<ul class='list' id='mine'>
<?php foreach($mine as $squad) { ?>
	<li><a href="<?php echo site_url('settings/squads/'.$squad['team_id']); ?>"><?php echo $squad['team_title']; ?></a></li>
</ul>
<?php }  ?>
<h2>Squads You're In</h2>
<?php } ?>
<form id='squads' action='<?php echo site_url('settings/squads'); ?>' method='post'>
<ul class='list' id='full'>
	<?php foreach( $team_list as $row ) { ?>
	<li <?php if(!empty($teams[$row['id']])) echo "class='selected' "; ?>>
		<a href="#">
		<input type='hidden' <?php if(empty($teams[$row['id']])) echo "disabled='disabled' "; ?> name='team[]' value='<?php echo $row['id'];?>' class='required left' />
		<div class='squad_meta left'>
			<span class='title'><?php echo $row['title']; ?></span>
			<span class='description'><?php echo $row['description']; ?></span>
		</div>
		<br style='clear: both;'>
		</a>
	</li>
	<?php } ?>
</ul>
<label for='team[]' class='error' style='display: none;'>You must select at least one squad.</label>
<input type='submit' class='red_button left' value='Update Squads' />
<br style='clear: both;' />
</form>

<script>
$(function(){
	$("#squads").validate( {
		rules:  
		{ 
			team:
       			{
       				required: true,
       				minlength: 1
       			}
		}
	} );
	$("#full li a").click(function(){
		$(this).parent().toggleClass('selected');
		var input = $(this).children('input');
		var status = input[0].disabled;
		if(status) input.removeAttr('disabled');
		else input.attr('disabled','disabled');
		return false;
	});
<?php if(!empty($mine)) { ?>
	var roster_table;
	$("ul#mine li a").colorbox( {
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
				roster_table.fnDeleteRow(roster_table.fnGetPosition( tr[0] ));
				var href = $(this).attr('rel');
				$.post(href, { "member_id": member_id });
			});		
		},
		onCleanup: function()
		{
			roster_table = null;
		}
	});
<?php } ?>		
});
</script>

<?php /*
	$("#full li a").click(function(){
		var input = $(this).children('input');
		var status = input[0].checked;
		if(status) input.removeAttr('checked');
		else input.attr('checked','checked');
		return false;
	});


<ul class='list' id='full'>
	<?php foreach( $team_list as $row ) { ?>
	<li <?php if(!empty($teams[$row['id']])) echo "class='selected' "; ?>>
		<a href="#">
		<input type='checkbox' <?php if(!empty($teams[$row['id']])) echo "checked='checked' "; ?> name='team[]' value='<?php echo $row['id'];?>' class='required left' />
		<div class='squad_meta left'>
			<span class='title'><?php echo $row['title']; ?></span>
			<span class='description'><?php echo $row['description']; ?></span>
		</div>
		<br style='clear: both;'>
		</a>
	</li>
	<?php } ?>
</ul>
*/
?>