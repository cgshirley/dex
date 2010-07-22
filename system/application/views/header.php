<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/style.css' />

<?php
if(isset($css))
{
	foreach($css as $val)
	{
		echo '<link rel="stylesheet" href="'.base_url().'assets/css/'.$val.'" />';
	}
}

?>
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
<div id='header'>
<div class='wrapper'>
	<h1>WYBC<span style='color: red;'>DEX</span></h1>
	<ul>
		<li style='margin-left: 30px;'><a href="<?php echo site_url(); ?>" <?php if($this->uri->segment(1)=="") echo "class='active'"; ?>>Home</a></li>
		<!--<li><a href="#">Blog</a></li>-->
		<li><a href="<?php echo site_url('meta'); ?>" 
		<?php if($this->uri->segment(1)=="meta") echo "class='active'"; ?>>Meta</a></li>
		<li><a href="<?php echo site_url('roster'); ?>" <?php if($this->uri->segment(1)=="roster") echo "class='active'"; ?>>Roster</a></li>
				<?php
		if($this->auth->validate(20))
		{
			echo "<li><a href='".site_url('admin')."'";
			if($this->uri->segment(1)=="admin") echo "class='active'";
			echo ">Admin</a></li>";
		}
		?>
		<li><a href="<?php echo site_url('help'); ?>" <?php if($this->uri->segment(1)=="help") echo "class='active'"; ?>>Help</a></li>

	</ul>
	<div id='session'>
	
	<?php 
	if($this->session->userdata('logged_in')==TRUE)
	{
	?>
		Hello, <?php echo $this->session->userdata('username'); ?>.
		<br />
		<a href='<?php echo site_url('settings'); ?>'>Settings</a> | <a href="<?php echo site_url('logout'); ?>">Log Out</a>
	<?php
	}
	else
	{
	?>
	<a href='<?php echo site_url('login'); ?>' class='red_button right'>Login</a>
	<?php
	}
	?>
	</div>
	<br style='clear: left;' />
</div>
</div>
<div id='subheader'>
<div class='wrapper'>
<!--<ul>
		<li style='margin-left: -20px;'><a href="#">Playlist Editor</a></li>
		<li><a href="#">View Logs</a></li>
		<li><a href="#">View Charts</a></li>
	</ul>
	<br style='clear:both;' />-->
</div>
</div>
<div id='content'>
<div class='wrapper'>
<?php 
$error = $this->session->flashdata('error');
if ( !empty($error)) {  ?>
<p class='error'><?php echo $error; ?></p>
<?php 

} 

$success= $this->session->flashdata('success');
if ( !empty($success)) {  ?>
<p class='success'><?php echo $success; ?></p>
<?php } ?>