<?php
/*
foreach($logs as $val)
{
	echo "<span class='stream'>".$val['song_title']."</span>";
}*/
echo "<span class='stream'>";
foreach($logs as $val)
{
	echo "<span class='stream_item'>".$val['song_title']." & </span>";
}
echo "</span>";
?>