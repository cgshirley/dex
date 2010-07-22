<h1 class='meta_headline' id='chart_headline'>
	Meta<span class='meta_black'>Charts</span>
</h1>
<ul id='charts_nav'>
<li><a href='<?php echo site_url('meta/charts/albums'); ?>'>Albums</a></li>
<li><a class='active' href='<?php echo site_url('meta/charts/artists'); ?>'>Artists</a></li>
<li><a href='<?php echo site_url('meta/charts/tracks'); ?>'>Tracks</a></li>
<li><a href='<?php echo site_url('meta/charts/archives'); ?>'>Archives</a></li>
</ul>
<br style='clear: both;' />

<ul class='chart_ranking'>
<?php
for($i=0; $i<10; $i++)
{
	echo "<li><span class='rank'>".($i+1)."</span><span class='name'>".$charts['artists'][$i]['name']."</span></li>";
}
?>
</ul>