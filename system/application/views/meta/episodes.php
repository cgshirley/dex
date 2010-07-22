<h1 class='meta_headline'>Meta<span class='meta_black'>Live</span></h1>
<h2>Select Your Show</h2>
	<div id='select_show'>
		<ul class='list'>
		
			<?php foreach($shows as $key=>$val) echo "<li><a href='#' rel='".$val['nid']."' class='show_selector'>".$val['title']."</a></li>"; ?>
		</ul>
	</div>
	<div id='episode_menu' style='display: none;'>
		<div id='episode_list' style="display:none;">
		</div>
	</div>
</div>
<script>
$(function(){
	/*
	*  SECTION 1: CHOOSE YOUR SHOW
	*/
	
	$(".show_selector").click(function(){
		var show_id = $(this).attr('rel');
		$('#select_show').hide();
		$("h1#title").text($(this).text());
		$("input#show_id_storage").val(show_id);
		$("#episode_menu").fadeIn();
		load_episodes(show_id);
	});
	function load_episodes( show_id )
	{
		// loads list of episodes
		$.post("<?php echo site_url('meta/ajaxData/get_episodes'); ?>", 
			{ show_id: show_id, format: "ul" }, 
			function(data)
			{
				//outputs data to #episode_list div
				$("#episode_list").html(data).fadeIn();
			}
		);
	}
	
	
});

</script>
</body>
</html>
