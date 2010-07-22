<style>
#song_info{
	width: 750px;
	height: 400px;
	display: block;
}
</style>
<div id='song_info'>
<h1><?php echo $artist->artist_name; ?></h1>
<h2>Bio</h2>
<p><?php echo $artist->info['bio']['summary']; ?></p>
<h2>Links</h2>
<ul id='artist_links'>
	<li><a href="http://en.wikipedia.org/wiki/<?php echo str_replace(" ","_",$artist->artist_name); ?>" class="artist_link">Wikipedia</a></li>
	<li><a href="http://last.fm/music/<?php echo str_replace(" ","+",$artist->artist_name);?>" class="artist_link">Last.fm</a></li>
	<li><a href="http://www.pollstar.com/eventSearch.aspx?SearchBy=<?php echo str_replace(" ","+",$artist->artist_name); ?>" class="artist_link">Tour Dates</a></li>
</ul>
</div>