<h1 class='meta_headline'>Meta<span class='meta_black'>Live</span></h1>
<h2>Select Your Show</h2>
	<div id='select_show'>
		<ul class='episode_lister'>
			<?php foreach($shows as $key=>$val) echo "<li><a href='#' rel='".$val['nid']."' class='show_selector'>".$val['title']."</a></li>"; ?>
		</ul>
	</div>
	<div id='episode_menu' style='display: none;'>
		<div id='episode_options' class='ui-widget'>
			<button class="ui-state-default ui-corner-all ui-button episode_new_link">Create a New Episode</button>
			<button class="ui-state-default ui-corner-all ui-button" id='episode_edit'>Edit an Existing Episode</button>
		</div>
		<div id='episode_list' style="display:none;">
		</div>
		<div id='episode_form' style='display: none;'>
			<h3>New Episode</h3>
			<form id='new_episode_form' class='ui-widget' name='new_episode_form' action='<?php echo site_url('meta/ajaxData/new_episode'); ?>' method='post'>
				<input type='hidden' id='show_id_storage' name='show_id' value='' />
				<p>
					<label>Title</label>
					<input type="text" id='episode_title' name='episode_title' />
				</p>
				<p>
					<label>Description</label>
					<textarea name='episode_desc'></textarea>
				</p>
				<p>
					<label>Date</label>
					<input type="text" id='episode_date' name='episode_date' />
				</p>
				<table>
					<tr>
						<td style='padding-right: 30px;'><label>Start Time</label>
							<select name='start_hour'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
								<option value='6'>6</option>
								<option value='7' selected="selected">7</option>
								<option value='8'>8</option>
								<option value='9'>9</option>
								<option value='10'>10</option>
								<option value='11'>11</option>
								<option value='12'>12</option>
							</select>
							:
							<select name='start_minutes'>
								<option value='00'>00</option>
								<option value='30'>30</option>
							</select>
							<select name='start_am'>
								<option value='am'>am</option>
								<option value='pm' selected="selected">pm</option>
							</select>
						</td>
						<td><label>Stop Time</label>
							<select name='stop_hour'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
								<option value='6'>6</option>
								<option value='7' selected='selected'>7</option>
								<option value='8'>8</option>
								<option value='9'>9</option>
								<option value='10'>10</option>
								<option value='11'>11</option>
								<option value='12'>12</option>
							</select>
							:
							<select name='stop_minutes'>
								<option value='00'>00</option>
								<option value='30'>30</option>
							</select>
							<select name='stop_am'>
								<option value='am'>am</option>
								<option value='pm' selected="selected">pm</option>
							</select>
						</td>
					</tr>
				</table>
				<p>
					<button class="ui-state-default ui-corner-all ui-button" id='new_episode_submit' >Create episode</button>
				</p>
			</form>
		</div>
	</div>
</div>
<script>
$(function(){
	/*
	*  SECTION 1: CHOOSE YOUR SHOW
	*/
	
	$(".show_selector").click(function(){
		$('#select_show').hide();
		$("h1#title").text($(this).text());
		$("input#show_id_storage").val($(this).attr('rel'));
		$("#episode_menu").fadeIn();
	});
	
	/*
	*  SECTION 2: PICK/CREATE AN EPISODE
	*/
	
	// EDIT EXISTING EPISODE
	
	// Edit existing episode button - loads list of episodes
	$("#episode_edit").click(function(){
		// loads list of episodes
		$.post("<?php echo site_url('meta/ajaxData/get_episodes'); ?>", 
			{ show_id: $("#show_id_storage").val(), format: "ul" }, 
			function(data){
				//outputs data to #episode_list div
				$("#episode_options").hide();
				$("#episode_list").html(data).fadeIn();
			});
	});
	
	
	// NEW EPISODE FORM
	
	// Create New Episode button - loads new episode form
	$(".episode_new_link").live('click',function(){
		$(this).parent().hide();
		$("#episode_form").fadeIn();
	});
	
	// Loads jquery-ui datepicker widget, applies to date field
	$("#episode_date").datepicker();
	
	// Submits form via AJAX...
	$("#new_episode_submit").click(function(){ 
		// ...then saves the new episode ID in a hidden input field...
		$('#new_episode_form').ajaxSubmit({target: "#episode_id_storage"});
		// ... which is then used to load the new playlist
		load_playlist($("#episode_id_storage").val(),$("#episode_title").val())
		return false;
	});
	
});

</script>
</body>
</html>
