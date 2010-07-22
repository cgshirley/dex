<style>
input, textarea { 
	font-size: 20px;
	font-family: 'helvetica neue', helvetica, arial, sans-serif; 
}
label { 
	font-size: 20px;
}
textarea { 
	padding: 10px;
	width: 97%;
}
input[type='text'] { 
	padding: 10px;
	width: 97%;
}
</style>
<h1><?php echo $headline; ?></h1>
<form name='new_ticket' id='new_ticket' method='post' action='<?php echo site_url('help/ticket'); ?>' >
<input type='hidden' value="<?php echo $user_id; ?>" name='author_id' />
<p><label>What seems to be the problem?</label></p>
<p><textarea rows='3' name='description' class='required'></textarea></p>
<p><label>Sum it up with a short title</label></p>
<p><input type='text' value='' name='summary' class='required' /></p>
<p><label>Which studio is the problem in?</label></p>
<!--<p><table>
<tr><td><input name='source'  type='checkbox' value='x'/></td><td>X</td></tr>
<tr><td><input name='source' type='checkbox'  value='am'/></td><td>AM</td></tr>
<tr><td><input name='source' type='checkbox'  value='moon'/></td><td>Moon</td></tr>
<tr><td><input name='source' type='checkbox' value='osx'/></td><td>Computers</td></tr>
<tr><td><input name='source'  type='checkbox' value='xnet'/></td><td>Network</td></tr>
<tr><td><input name='source'  type='checkbox' value='apps'/></td><td>Web Apps</td></tr>
<tr><td><input name='source'  type='checkbox' value='streaming'/></td><td>Streaming</td></tr>
</table>-->

<select name='studio'>
<option>X</option>
<option>Moon</option>
<option>AM</option>
<option>FM</option>
</select></p>
<?php if ( $admin ) { ?>
<?php } else { ?>
<p><label>Is this urgent?</label></p>
<p><input type='checkbox' name='urgent'>Yes. I want an engineer to contact me asap.</p>
<?php } ?>
<a href="#" id="submit" class='red_button left'>Submit</a>
</form>
<script>
$(function(){
	$("#submit").click(function(){
		$("#new_ticket").validate();
		$("#new_ticket").submit();
	});

});
</script>