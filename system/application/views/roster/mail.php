<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Send Mail</title>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
</head>

<body>
<form action='<?php echo site_url('roster/send_mail'); ?>' method="post" name='email'>
<input name='to' type='text' />
<input name='subject' type='text' />
<textarea name='email' id='email'></textarea>
<script type="text/javascript">
				CKEDITOR.replace( 'email' );
			</script>
<input type='submit' />
</form>

</body>
</html>
