 <h1 class='meta_headline' style='margin-bottom: 0px;'>Meta<span class='meta_black'>Admin </span></h1>

<a href="<?php echo site_url('meta/artists'); ?>">Manage Artists</a>
<h2>Tasks</h2>
<ul id="tasks">
<li><a href='#' rel='reset_db'>Reset Database</a></li>
</ul>
</div>
<script>
$(function(){
	$("ul#tasks li a").click(function(){
		var task = $(this).attr("rel");
		$.post("<?php echo site_url('meta/ajaxData'); ?>/"+task);
	});
});
</script>