<style>
#default{
	padding: 20px;
	min-height: 175px;
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
	height: 140px;
}
#correction{
	font-family: helvetica, arial;
	font-size: 1.5em;
}
.submit_button{
	background: red;
	font-size: 1.3em;
	text-decoration: none;
	color: white;
	padding: 10px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
}
#flagged{
	width: 250px;
	height: 70px;
}
</style>

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
		<a class='button' id='track_info' href='#' rel="<?php echo site_url('meta/ajaxData/song_info')."/".$track['song_id']; ?>">Info</a>
		<a class='button' id='flag' href="#">Flag</a>
		<a class='button' rel="<?php echo $track['playlist_track_id']; ?>" id='delete_track' href="#" style='margin-right: 0px'>Delete</a>
	</div>
	<br />
</div>
<div id='flags' style='display: none;'>
	<h2 id='flag_what' style='margin-bottom: 25px;'>Flag What?</h2>
	<form method='post' action="<?php echo site_url("meta/ajaxData/add_flag"); ?>" name='flag_it' id='form_flag_it'>
	<a href="#" id='song' class='button typeset'>The Song</a>
	<a href="#" id='artist' class='button typeset'>The Artist</a>
	<a href="#" id='album' class='button typeset' style='margin-right: 0;'>The Album</a>
	<input type='hidden' name='type' id='type' value='' />
	<input type='hidden' name='playlist_track_id' value='<?php echo $track['playlist_track_id']; ?>' />
	<input type='hidden' name='author_id' value='<?php echo $author_id; ?>' />
	<div id='finishFlag'>
		<label>If you have a correction, enter it below [optional]</label><br />
		<input type='text' name='correction' id='correction' /><br /><br />
		<a href='#' class='submit_button' style='font-size: 1.2em;' id='submit_flag' >Flag It</a>
		<br />
	</div>
	</form>
</div>
<div id='flagged' style='display: none;' >

<img src="<?php echo base_url(); ?>assets/images/icon_check.png" alt='Success' style='margin-right: 20px; float: left;' />
<div style='float: left;'><h2 style='margin:0;'>Thanks!</h2>
<p style='margin: 0;'>Flagged successfully.</p></div>
</div>