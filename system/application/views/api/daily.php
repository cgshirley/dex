<?php
$show=0; ?>

<playlist retrieved='<?php echo date('Y-m-d H:i:s'); ?>' date='<?php echo date('Y-m-d', $date); ?>' >
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
