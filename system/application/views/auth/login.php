<div id="login">
	
    <script language="javascript">
    /* quick hax to make the enter button work, this always annoyed me -sas */
        function kbHit(event, id) {
            var code = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
            if (code == 13) {
                // enter...
                document.getElementById(id).submit();
            }
        }
    </script>
                
	<h2>Login</h2>
	<div class="box">
			<form id="login" method="POST">
			Username/Email:<br />
			<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" class="form" /><?php echo form_error('username'); ?><br /><br />
			Password:<br />
			<input type="password" name="password" onkeydown="kbHit(event, 'login')" value="<?php echo set_value('password'); ?>" size="50" class="form" /><?php echo form_error('password'); ?><br /><br />
			<input type="submit" value="Login" name="login" />
			</form>
			<a href="http://dev.wybcx.com/user/password" class='red_button left'>Forgot password?</a>
	</div>
</div>
