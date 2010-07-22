 <h1 id='playlist_headline' class='meta_headline' style='margin-bottom: 0px;'>Meta<span class='meta_black'>Live </span></h1>
 <div id='meta_show_data'>

 </div>
<div id='mixtape'>
	<div id='do_it_live'>
		<h2 id='heading_live'>
			Live
		</h2>
		
		<div id='live_info'>
			<p style='font-weight: bold; color: red; '>
				No tracks are currently playing.
			</p>
			<p>
				To rectify this situation, add some tracks to the right, and then press the play button on the left hand side of the list. Then this message will magically disappear and online viewers will magically know what song you are playing.
			</p>
		</div>
		<div id='live_nav' style='margin-top: 50px; display: none;'>
			<a href='#' class='live_buttons' rel='previous' id='previous_track'>
			</a>
			<a href='#' class='live_buttons' rel='next' id='next_track'>
			</a>
		</div>
		<div id='show_info' style='display: none;'>
			<h2 id='heading_live'>
				Info
			</h2>
		</div>
	</div>
	<div id='the_playlist'>
		<h2 id='heading_playlist'>
			Playlist
		</h2>
		<div id='mixtape_add'>
			<form id='mixtape_add_form' method='post' action='<?php echo site_url('meta/ajaxdata/add_track/'.$this->
				uri->segment(3)); ?>'> 
<!--<h3>Add A New Track</h3>-->
				<table>
					<tr>
						<td>
							<label>
								Artist</label>
						</td>
						<td>
							<label>
								Song</label>
						</td>
						<td />
					</tr>
					<tr>
						<td>
							<input type='text' id='add_artist' name='artist' />
						</td>
						<td>
							<input type='text' id='add_song' name='song' />
						</td>
						<td>
							<a class='post_track' href='#' id='post_track'>
								Add
							</a>
							<span class='post_track' style='display: none;' id='post_loader'>
								<img src="<?php echo base_url(); ?>assets/images/ajax-loader-2.gif" />
							</span>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<ul id='playlist'>
		</ul>
	</div>
</div>
</div>
<script>
var onair = true;
$(function(){
	load_playlist(<?php echo $this->uri->segment(3); ?>);
	
	/*
	/////////////////
	/ PLAYLIST EDITOR
	/////////////////
	*/
	$('#mixtape_add_form').ajaxForm({success: post_track, dataType: 'json', beforeSubmit: toggle_form}); 
	$("#post_track").click(function(){$("#mixtape_add_form").submit()});
	/*
	*  SORTABLE PLAYLIST
	*/
	
	// Instantiates jquery-ui interaction class
	$("ul#playlist").sortable({	handle: '.sort_handle', 
								axis: 'y', 
								cursor: 'move',
								update: function(){
									striper();
									$.post("<?php echo site_url('meta/ajaxData/update_sort'); ?>", {order: $("ul#playlist").sortable('toArray').toString()});
								}});
	
	// Gives items held by the handle a special background class
	$(".sort_handle").live('mousedown',function(){ $(this).parent().addClass("sorting"); })
	$("ul#playlist li").live('mouseup',function(){ $(this).removeClass("sorting"); });
	
	
	/*
	* AUTO COMPLETE SEARCH BOXES
	* Instantiates the jquery autocomplete plugin
	*/
	
	$("#add_artist").autocomplete("<?php echo site_url('meta/ajaxData/artist_search'); ?>", {delay: 50, 'highlight': false});
	$("#add_song").autocomplete("<?php echo site_url('meta/ajaxData/song_search'); ?>", 
	{
		delay: 50,
		'highlight': false,
		// Extra parameter allows songs to be filtered by artist and album
		extraParams: 
		{
			// loads hidden artist_id variable if artist already selected
			artist: function() { return $("#add_artist").val(); }
		},
		
		'scrollHeight': '300px',
		'max': '5',
		'formatItem':function(item, index, total, query)
		{
			var img = "<img class='livesearchimage' src='<?php echo base_url(); ?>assets/images/albums/" + item.album_id + ".jpg' />"
           		return    img + "<div class='livesearchmeta'><span class='livesearchtitle'>" + item.song + "<\/span><span class='livesearchalbum'>" + item.album + "<\/span><\/div>";
       		},
       		dataType:'json',
       		parse: function(data) 
       		{
        		var parsed = [];
        		data = data.songs;
 
        		for (var i = 0; i < data.length; i++) 
        		{
            			parsed[parsed.length] = {
					data: data[i],
					value: data[i].song,
					result: data[i].song
				};
        		}
        		return parsed;
    		},
    		
        });
	/*
	* OTHER FUNCTIONS
	*/

	// Fade out menus and load playlist window
	function load_playlist(episode_id, episode_title)
	{
		$.post("<?php echo site_url("meta/ajaxData/load_playlist"); ?>", 
			{"episode": episode_id}, 
			function(data){
				$("ul#playlist").html(data);
				striper();
			}, 'html');
		$("#mixtape").show();
	}
	
	function striper()
	{
    		$('ul#playlist li').removeClass("stripe-even").removeClass("stripe-odd").removeClass("sorting");
		$('ul#playlist li:even').addClass('stripe-even');
    		$('ul#playlist li:odd').addClass('stripe-odd');
	}
	
	
	function toggle_form ()
	{
		$("#post_track").toggle();
		$("#post_loader").toggle();
		$("#mixtape_add_form input").each (
			function(){
			if ($(this).is(':disabled')) { $(this).removeAttr('disabled');  }
        	else { $(this).attr('disabled', 'disabled'); }}
		)
	}
	
	function post_track(data)
	{
		switch(data.status)
		{
			case "success":
				var track = $(data.html).hide().fadeIn(1000);
				$("ul#playlist").append(track).sortable('refresh');
				$("#mixtape_add_form").clearForm();
				$("#add_song").flushCache();
				$("#add_artist_id").val('');
				$("#add_song_id").val('');
				toggle_form();
				striper();
				$("#add_artist").focus();
				break;
			case "choices":
				$.fn.colorbox({html: data.html});
				$("#cboxClose").css("display","none");
				$("#choices ul li img").click(function(){
					$.post("<?php echo site_url("meta/ajaxData/final_choice"); ?>", 
						{ 
						song_id: $(this).attr("rel"), 
						episode_id: <?php echo $this->uri->segment(3); ?>}, post_track, 'json');
					$.fn.colorbox.close();
				});
				break;
		}
	}
	
	
	$(".play_track").live("click", function(){
		$.post("<?php echo site_url("meta/ajaxData/live_info"); ?>", { id: $(this).parent().attr("id"), type: 'play', episode: <?php echo $this->uri->segment(3); ?> }, go_live, 'json');
	});
	$(".live_buttons").live("click",
		function(){
			$.post("<?php echo site_url("meta/ajaxData/live_info"); ?>", 
				{ 
					id: $("#live_track_id").val(), 
					type: $(this).attr('rel'), 
					episode: <?php echo $this->uri->segment(3); ?> }, 
					go_live, 'json');	
	});
		
	
	$.post("<?php echo site_url('meta/ajaxData/live_info'); ?>",
		{'type':'current', 'episode': '<?php echo $this->uri->segment(3); ?>' }, go_live, 'json');
	
	function go_live( data )
	{
		$("#live_info").hide().html(data.live).fadeIn();
		if(data.hide_controls!=true)
		{
			$("#live_nav").show();
		}
		
		if ( data.status == "tardy" || data.status == "early" )
		{
			$.fn.colorbox({"html": data.alert, "close":"x"});
		}
		if ( data.status == "golive" )
		{
			$.fn.colorbox({"html": data.alert, "close":"x"});
		}
		
	}
	
	function live_warning()
	{
		$.fn.colorbox({"href":"<?php echo site_url('meta/ajaxData/live_warning'); ?>", "close":"x"});
			if(confirm('test'))
			{
				$.post("<?php echo site_url("meta/ajaxData/live_info"); ?>", { id: $(this).parent().attr("id"), type: 'play' }, go_live, 'json');
			}
	}
	
	
	
	function remove_track( $id )
	{
		$.post("<?php echo site_url('meta/ajaxData/remove_track'); ?>", {'playlist_track_id' : $id });
		$("li#"+$id).remove();
		striper();
	}
	$(".track_options").live("click", function(){ 
		$.fn.colorbox({href:$(this).attr("href"), open:true}); 
		return false;
	});
	$("a#flag").live('click', function(){
		$("#default").hide();
		$("#flags").show();
		$.fn.colorbox.resize();
	});
	$("a#delete_track").live("click",function(){
		$.fn.colorbox.close();
		remove_track($(this).attr('rel'));
	});
	$("a.typeset").live('click',  function(){
		$("#type").val($(this).attr("id"));
		$(".button").hide();
		$("h2#flag_what").text("Flag "+$(this).text()).css('margin-bottom','10px');
		$("#finishFlag").show();
		$.fn.colorbox.resize();
	});
	
	$("#artist_tooltip").live("click", function(){
		var $url = "<?php echo site_url("meta/ajaxData/song_info"); ?>/"+$(this).attr("rel");
		$.fn.colorbox({href:$url}); 
		return false;
	});
	$("a#submit_flag").live("click",function(){ 
		$("#form_flag_it").ajaxSubmit();
		$("#flags").hide();
		$("#flagged").show();
		$.fn.colorbox.resize();
	});
	$("a#track_info").live("click", function(){
		//$.fn.colorbox.close();
		$.fn.colorbox({"href": $(this).attr("rel")});
	});
	$("a#go_live_link").live("click", function(){
		var studio = $("#studio_select").val();
		$.post("<?php echo site_url("meta/ajaxData/go_live"); ?>", { studio: $("#studio_select").val(), id: $("#track_id").val(), episode: $("#episode_id_live").val() }, go_live, 'json');
		$.fn.colorbox.close();
	});
	function addMega(){
 		 $(this).addClass("hovering");
  	}

	function removeMega(){
  		$(this).removeClass("hovering");
 	}
 	$("li.mega").mouseover(addMega);
 	$("li.mega").mouseout(removeMega);
 	var notes;
 	var loader_icon = $("<img src='<?php echo base_url(); ?>assets/images/loading.gif' style='margin-top: 5px; margin-left: 10px;' />");
 	$("a#episode_notes").colorbox( {
 		onComplete: function()
 		{ 
 			$("#notes").ckeditor(function(){}, {toolbar:'Normal'});
 			$("#episode_notes_form").submit(function() 
			{
				$(this).children('input:submit').attr('disabled', 'disabled').addClass('disabled_button').after(loader_icon);
				$(this).ajaxSubmit( { success: function() { $.fn.colorbox.close(); }  }); 
				return false; 
			});
 		},
 		onCleanup: function()
 		{ 
 			var e = CKEDITOR.instances['notes']; 
 			e.destroy(); 
 		}
 	});
 	$("a#update_status").colorbox({
 		onComplete: function()
 		{	
			$('#update_status_form').submit(function() 
			{
				$(this).children('input:submit').attr('disabled', 'disabled').addClass('disabled_button').after(loader_icon);
				$(this).ajaxSubmit( { success: function() { $.fn.colorbox.close(); }  });
				return false; 
			});
 		}
 	});

	$.post("<?php echo site_url('api/listeners'); ?>",  
 								null,  
 								function(data)
 								{ 
 									$("#total_listeners").text(" /// "+data+" listeners"); 	
 								});
 	setInterval( 	function()
 					{ 
 						$.post("<?php echo site_url('api/listeners'); ?>",  
 								null,  
 								function(data)
 								{ 
 									$("#total_listeners").text(" /// "+data+" listeners"); 	
 								});
 					}, 30000);
});

</script> 
</body>
</html>
