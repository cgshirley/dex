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
	echo '<script type="text/javascript" src="'.base_url().'assets/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="'.base_url().'assets/ckeditor/adapters/jquery.js"></script>';
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
<div id='alt_header'>
<div class='wrapper'>
<table>
<tr>
	<td>
		<ul id='backmenu'>
			<li>
				<a href="#" class='meta_topnav' id='go_back'>Menu</a>
					<div id='file_menu'>
		<div class='menu_top'><div class='menu_top_bg'></div></div>
		<div class='menu_content'>
			<table>
			<tr><td>
				<span class='bucket_title'>Options</span>
				<ul>
					<li><a href='<?php echo site_url('meta/episode_notes'.'/'.$episode_id); ?>' id='episode_notes'>Edit Episode Notes</a></li>
					<li><a href="<?php echo site_url('meta/update_status'); ?>" id='update_status'>Update Your Status</a></li>
				</ul>
			</td><td>
				<span class='bucket_title'>When Finished</span>
				<ul>
					<li><a href='<?php echo site_url('meta/episodes'); ?>'>Choose Another Show</a></li>
					<!--<li><a href='<?php echo site_url('meta/automate'); ?>'>Switch to Automation</a></li>-->
					<li><a href='<?php echo site_url('logout'); ?>'>Logout</a></li>
				</ul>
			</td></tr></table>		</div>
	</div>
			</li>
		</ul>
	</td>
	<td>
		<span id='episode_title'><?php echo $episode['title']; ?></span><span id='total_listeners'></span>
	</td>
</tr>
</table>
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
<div class='wrapper'>