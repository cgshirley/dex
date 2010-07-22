<?php if( !empty($othershow) ){ ?>
<span id='played_by'><i><?php echo $othershow; ?></i> is On The Air.</span>
<?php } ?>
<img style='width: 200px;' src='<?php echo $album_img; ?>' />
<p><span  style='font-weight: bold; font-size: 1.2em;'><?php echo $song; ?></span><br /> 
<span id='artist_tooltip' rel='<?php echo $song_id; ?>'><?php echo $artist_name; ?></span></p>
<input type='hidden' id='live_track_id' value='<?php echo $track_id; ?>' />

