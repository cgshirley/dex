<style>
input[type=text]{
	width: 100%; 
	font-size: 1.4em; 
	font-family: helvetica, arial, sans-serif;
	padding: 5px 5px 1px;
}
#hint{
	padding: 20px; 
	background: #eee; 
	font-style: italic;
}
.code {
	font-style: normal;
	font-weight: bold;
}
table thead tr th {
	text-align: left;
}

</style>
<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/pages"); ?>" id='ticket_link'>Manage Page Content</a> |  Edit</p>
<h2><?php echo $content->title; ?></h2>
<form action="<?php echo site_url("admin/pages/save/".$content->id); ?>" method="post">
<?php if($type=="email") { ?>
<p>
	<label>Subject</label>
	<input type='text' name='subject' value='<?php echo $content->subject; ?>' style='' />
</p>
<p>
	<label>Body</label>
<?php } ?>
<input type='hidden' name='id' value="<?php echo $content->id; ?>" />
<textarea name='body' id='body'><?php echo $content->body; ?></textarea>
<?php if($type=="email") { ?>
</p>
<div id='hint'>
To insert dynamic data, you can use special tags:
<table>
<thead><tr><th style='width: 300px;'>Tag</th><th>Description</th></tr></thead>
<tbody>
<tr><td><span class='code'>{first_name}</span></td><td>First Name</td></tr>
<tr><td><span class='code'>{last_name}</span></td><td>Last Name</td></tr>
<tr><td><span class='code'>{name}</span></td><td>First Name + Last Name</td></tr>
</tbody></table>
</div>
<?php } ?>
<input type='submit' value="Update" class='red_button left' style='margin:25px 0px;' />
</form>
<script>
$(function(){
	$("#body").ckeditor(function(){}, {});
});
</script>