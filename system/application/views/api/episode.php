<playlist retrieved='<?php echo date('Y-m-d H:i:s'); ?>'>
	<show episode_id='<?php echo $episode_id; ?>'>
	<?php foreach($tracks as $key=>$val)
	{
	?>
		<track id='<?php echo $val['playlist_track_id']; ?>'>
			<song>
				<name><![CDATA[<?php echo $val['song_title']; ?>]]></name>
				<id><?php echo $val['song_id']; ?></id>
			</song>
			<artist>
				<name><![CDATA[<?php echo $val['artist_name']; ?>]]></name>
				<id><?php echo $val['artist_id']; ?></id>
			</artist>
			<album>
				<name><![CDATA[<?php echo $val['album_title']; ?>]]></name>
				<id><?php echo $val['album_id']; ?></id>
			</album>
		</track>
		<?php } ?>
	</show>
</playlist>