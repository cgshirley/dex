<div id="login">
	<?php if(!empty($error)) echo "<p class='error'>".$error."</p>"; ?>
	<h2>Login</h2>
	<div class="box">
			<form method="POST" id='loginform'>
			Email:<br />
			<input type="text" name="email" value="" size="50" class="form" /><br /><br />
			Password:<br />
			<input type="password" name="password" value="" size="50" class="form" /><br /><br />
			<a href="#" id='submit' class='red_button left'>Login</a>
			</form>
			<p style='clear: both;margin-top: 50px;'><a style='color: #333; ' href="http://dev.wybcx.com/user/password">Forgot your password?</a></p>
	</div>
</div>
<script>
$(function(){
	$("#submit").click(function(){
		$("#loginform").submit();
	});
});
</script>