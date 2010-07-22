<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/style.css' />
<style>
body{
	background: black;
}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.php"></script>
<?php
if(isset($ckeditor)&&$ckeditor==TRUE)
{
	echo '<script type="text/javascript" src="'.base_url().'assets/ckeditor/ckeditor.js"></script><script type="text/javascript" src="'.base_url().'assets/ckeditor/adapters/jquery.js"></script>';
}
if(isset($js))
{
	foreach($js as $val)
	{
		echo '<script type="text/javascript" src="'.base_url().'assets/javascript/'.$val.'"></script>';
	}
}
?>
</head>
<body>

<div class='wrapper' id='application'>