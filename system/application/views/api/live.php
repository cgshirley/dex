<?php
$show=0;
/*

<playlist retrieved='<?php echo date('Y-m-d H:i:s'); ?>'>
<?php for($i=0; $i<count($logs); $i++){
		if ($logs[$i]['episode_id']!=$logs[$i-1]['episode_id']) { ?>
	<show episode_id='<?php echo $logs[$i]['episode_id']; ?>'>
	<?php } ?>
		<track id='<?php echo $logs[$i]['playlist_track_id']; ?>' time="<?php echo $logs[$i]['log_time']; ?>">
			<song>
				<name><![CDATA[<?php echo $logs[$i]['song_title']; ?>]]></name>
				<id><?php echo $logs[$i]['song_id']; ?></id>
			</song>
			<artist>
				<name><![CDATA[<?php echo $logs[$i]['artist_name']; ?>]]></name>
				<id><?php echo $logs[$i]['artist_id']; ?></id>
			</artist>
			<album>
				<name><![CDATA[<?php echo $logs[$i]['album_title']; ?>]]></name>
				<id><?php echo $logs[$i]['album_id']; ?></id>
			</album>
		</track>
		<?php if ($logs[$i]['episode_id']!=$logs[$i+1]['episode_id']) { ?>
			</show>
			<?php } } ?>

</playlist>

*/
?>
<playlist retrieved='<?php echo date('Y-m-d H:i:s'); ?>'>
<?php foreach($logs as $id=>$show) { ?>
	<show episode_id='<?php echo $id; ?>' show_id='<?php echo $show['show_id']; ?>' show_title = '<?php echo $show['title']; ?>'>
	<?php foreach($show as $key=>$track) { ?>
		<track id='<?php echo $track['playlist_track_id']; ?>' time="<?php echo $track['log_time']; ?>">
			<song>
				<name><![CDATA[<?php echo $track['song_title']; ?>]]></name>
				<id><?php echo $track['song_id']; ?></id>
			</song>
			<artist>
				<name><![CDATA[<?php echo $track['artist_name']; ?>]]></name>
				<id><?php echo $track['artist_id']; ?></id>
			</artist>
			<album>
				<name><![CDATA[<?php echo $track['album_title']; ?>]]></name>
				<id><?php echo $track['album_id']; ?></id>
			</album>
		</track>
		<?php } ?>
	</show>
	<?php } ?>
</playlist>
