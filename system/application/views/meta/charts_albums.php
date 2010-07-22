<h1 class='meta_headline' id='chart_headline'>
	Meta<span class='meta_black'>Charts</span>
</h1>
<ul id='charts_nav'>
<li><a class='active' href='<?php echo site_url('meta/charts/albums'); ?>'>Albums</a></li>
<li><a href='<?php echo site_url('meta/charts/artists'); ?>'>Artists</a></li>
<li><a href='<?php echo site_url('meta/charts/tracks'); ?>'>Tracks</a></li>
<li><a href='<?php echo site_url('meta/charts/archives'); ?>'>Archives</a></li>
</ul>
<br style='clear: both;' />

<ul class='chart_ranking'>
<?php
for($i=0; $i<10; $i++)
{
	//echo "<img src='".base_url()."assets/images/albums/".$charts['albums'][$i]['id'].".jpg' style='width: 100px;' /> <p>".$charts['albums'][$i]['artist']."</p>";
	echo "<li><span class='rank'>".($i+1)."</span><span class='name'>".$charts['albums'][$i]['title']." <span class='gray'> /// ".$charts['albums'][$i]['artist']."</span></span></li>";
}
?>
</ul>