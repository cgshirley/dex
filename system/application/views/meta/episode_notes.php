<style>
#container{
	width: 600px;
	height: 450px;
	padding: 20px 50px;
}
</style>
<div id='container'>
<h2>Edit Episode Notes</h2>
<form class='big' action='<?php echo site_url('meta/episode_notes/'.$episode_id); ?>' id='episode_notes_form' method='post'>
<!--<p>
	<label>Title</label>
	<input type='text' name='title' value='<?php echo $notes['title']; ?>' />
</p>-->
<p>
	<textarea id='notes' name='notes'><?php echo $notes['body']; ?></textarea>
</p>
	<input type='submit' class='red_button left' value='Update Notes' onFocus="this.blur()" />
</form>
</div>