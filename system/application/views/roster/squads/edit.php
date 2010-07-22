<style>
#container{
	width: 350px;
	padding: 20px 50px 20px;
}
input[type=text], textarea {
	font-family: helvetica, arial, sans-serif;
	font-size: 18px;
	width: 350px;
	padding: 5px;
}

</style>

<div id='container'>
<?php if($edit) { ?>
<h2>Edit Squad</h2>
<form action='<?php echo site_url('roster/squads/edit/'.$squad['team_id']); ?>' method='post' id='edit_squad'>
<?php } else { ?>
<h2>New Squad</h2>
<form action='<?php echo site_url('roster/squads/new'); ?>' method='post' id='new_squad'>
<?php } ?>
<p>
	<label>Name</label>
	<input type='text' name='team_title' value='<?php if(!empty($squad['team_title'])) echo $squad['team_title']; ?>' />
</p>
<p>
	<label>Description</label>
	<textarea name='team_description' rows='5'><?php if(!empty($squad['team_description'])) echo $squad['team_description']; ?></textarea>
</p>
<p>
	<label>Leader</label>
	<select name='team_leader'>
		<?php if($edit) { ?>
		<option value="<?php echo $squad['member_id']; ?>"><?php if(!empty($squad['first_name'])&&!empty($squad['last_name'])) echo $squad['first_name']." ".$squad['last_name']; ?></option>
		<?php } else { ?>
		<option></option>
		<?php } ?>
		<?php foreach($members as $member) { ?>
			<option value="<?php echo $member['member_id']; ?>"><?php echo $member['first_name']." ".$member['last_name']; ?></option>
		<?php } ?>
	</select>
</p>
<p>
<?php if($edit) { ?>
	<input type='submit' class='red_button left' value='Update Squad' />
<?php } else { ?>
	<input type='submit' class='red_button left' value='Create Squad' />
<form action='<?php echo site_url('roster/squads/new'); ?>' method='post' id='new_squad'>
<?php } ?>
	<br style='clear: both;' />
</p>
</form>
</div>