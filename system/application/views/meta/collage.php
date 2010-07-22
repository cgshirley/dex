<?php
foreach($logs as $row)
{
	echo "<img src='".base_url()."assets/images/albums/".$row['album_id'].".jpg' style='float: left; width: 100px; margin: 5px 5px 0px 0px;' />";
}
?>