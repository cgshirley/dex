<style>
#song_info{
	width: 760px;
	height: 400px;
	display: block;
	padding: 0px;
}
#padding { 
	width: 700px;
	height: 330px;
	margin: 0 auto;
}
ul#artist_links {
	border-top: 1px solid black;
	list-style: none;
	padding-left: 0px;
	width: 200px;
}
ul#artist_links li a{
	color: black;
	text-decoration: none;
	display: block;
	border-bottom: 1px solid black;
	padding: 8px;
}
ul#artist_links li a:hover{
	background: black;
	color: white;
}
p#bio_summary{
	font-size: 12px;
	width: 220px;
}
p#bio_summary a{
	background: black;
	color: white;
	text-decoration: none;
	padding: 2px;
}
p#bio_summary a:hover{
	background: red;
}
#bio {
	float: left;
	width: 220px;
	margin-right: 30px;
}
#links {
	float: left;
	width: 205px;
	margin-right: 30px;
}
#stats{
	float: left;
	width: 200px;
}
</style>
<div id='song_info'> <div id='padding'>
<h1><?php echo $artist->artist_name; ?></h1>
<div id='bio'>
<h2>Bio</h2>
<p id='bio_summary'><?php echo $artist->info['bio']['summary']; ?></p>
</div>
<div id='links'>
<h2>Links</h2>
<ul id='artist_links'>
	<li><a target="_blank" href="http://en.wikipedia.org/wiki/<?php echo str_replace(" ","_",$artist->artist_name); ?>" class="artist_link">Wikipedia</a></li>
	<li><a target="_blank" href="http://last.fm/music/<?php echo str_replace(" ","+",$artist->artist_name);?>" class="artist_link">Last.fm</a></li>
	<li><a target="_blank" href="http://www.pollstar.com/eventSearch.aspx?SearchBy=<?php echo str_replace(" ","+",$artist->artist_name); ?>" class="artist_link">Tour Dates</a></li>
</ul>
</div>
<div id='stats'>
<h2>Stats</h2>
<p>This album has been played:</p>

<p><?php echo $album['stats']['month']; ?> times in the past month.</p>
<p><?php echo $album['stats']['total']; ?> times total.</p>
</div>
</div>
</div>