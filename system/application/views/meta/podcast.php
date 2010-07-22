<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
</head>

<body id='podcasting'>
<div id='podcasting'>
<form action='<?php site_url("songs/ajaxData/start_recording"); ?>'>
<input type="text" name='show_name' />
<p>
	<label>
	<input type="radio" name="timing" value="automatic" id="timing_0" />
		Automatic length</label>
	<br />
	<label>
	<input type="radio" name="timing" value="manual" id="timing_1" />
		Manual start/stop</label>
	<br />
</p>
</form>
</div>
</body>
</html>
