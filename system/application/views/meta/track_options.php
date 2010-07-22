<html>
<head>
<title>Track Options</title>
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/style.css' />
<style>
body { 
	padding: 25px;
}
img#album{
	float: left;
	width: 140px;
	margin-right: 20px;
}
#meta{
	float: left;
	width: 280px;
	display: block;
}
#meta h2{
	color: black;
	font-size: 25px;
	font-weight: bold;
	margin: 0;
}
#meta p{
	color: #aaa;
	font-size: 16px;
	font-weight: bold;
	margin: .4em 0em;
}
#buttons { 
	clear: both;
	padding-top: 10px;
}
.button{
	display: block;
	background: black;
	font-size: 14px;
	text-align: center;
	color: white;
	float: left;
	margin-right: 20px;
	width: 140px;
	padding: 4px 0px 3px;
	font-weight: bold;
	text-decoration: none;
}
.selected { 
	background: #666;
}
#flags h2{
	margin: 0;
}
#flags h3{
	font-weight: bolder;
	margin: .5em 0em;
}
#flags input {
	font-family: helvetica, arial;
}
#finishFlag{
	display: none;
}
#correction{
	font-family: helvetica, arial;
	font-size: 1.5em;
}
</style>
<script src="<?php echo base_url(); ?>assets/javascript/jquery.php"></script>
</head>
<body>
<div id='default'>
	<img src="<?php echo $track['album_url']; ?>" alt="<?php echo $track['album_title']; ?>" id="album" />
	<div id='meta'>
		<h2><?php echo $track['song_title']; ?></h2>
		<p>by <?php echo $track['artist_name']; ?></p>
		<?php if(!empty($track['album_title'])) { ?>
		<p>from <i><?php echo $track['album_title']; ?></i></p>
		<?php } else{ ?>
		<p id='unknown_album'>Album Unknown</p>
		<?php }?>
		
	</div>
	<div id='buttons'>
		<a class='button' target="_BLANK" href="<?php $url = "http://www.last.fm/music/".$track['artist_name']."/_/".$track['song_title'];
		$url = str_replace(" ","+",$url); 
		echo $url; ?>">Info</a>
		<a class='button' id='flag' href="#">Flag</a>
		<a class='button' href="#" style='margin-right: 0px'>Delete</a>
	</div>
</div>
<div id='flags' style='display: none;'>
	<h2 style='margin-bottom: 25px;'>Flag What?</h2>
	<form method='post' action="<?php echo site_url("meta/ajaxData/add_flag"); ?>">
	<a href="#" id='song' class='button typeset'>The Song</a>
	<a href="#" id='artist' class='button typeset'>The Artist</a>
	<a href="#" id='album' class='button typeset' style='margin-right: 0;'>The Album</a>
	<input type='hidden' name='type' id='type' value='' />
	<input type='hidden' name='playlist_track_id' value='<?php echo $track['playlist_track_id']; ?>' />
	<div id='finishFlag'>
		<label>Do you have a correction?</label><br />
		<input type='text' name='correction' id='correction' /><br /><br />
		<input type='submit' value="Flag It" />
	</div>
	</form>
</div>
<script>
$(function(){
	$("a#flag").click(function(){
		$("#default").hide();
		$("#flags").show();
		parent.$("fancy_outer").css("width","300px");
	});
	$("a.typeset").click(function(){
		$("#type").val($(this).attr("id"));
		$(".button").hide();
		$("h2").text("Flag "+$(this).text()).css('margin-bottom','10px');
		$("#finishFlag").show();
	});
});
</script>
</body>
</html>