<p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("logs"); ?>" id='ticket_link'>Tickets</a> |  <?php echo $ticket['summary']; ?></p>
<div id='ticket'>
<div class='ticket_meta'>
	<span class='author'><?php echo $ticket['author']; ?></span>
	<span class='date'><?php echo date("F jS, Y",strtotime($ticket['created'])); ?><br />
					<?php echo date("g:iA", strtotime($ticket['created'])); ?></span>
</div>
<div class='ticket_post'>
<p><?php echo $ticket['description']; ?></p>
</div>
<br style='clear:both;' />
</div>
<?php foreach($responses as $key=>$val) { ?>
<div id='ticket'>
<div class='ticket_meta'>
	<span class='author'><?php echo $val['author']; ?></span>
	<span class='date'><?php echo date("F jS, Y",strtotime($val['created'])); ?><br />
					<?php echo date("g:iA", strtotime($val['created'])); ?></span>
</div>
<div class='ticket_post'>
<p><?php echo $val['response']; ?></p>
</div>
<br style='clear:both;' />
</div>



<?php } ?>

<a href="#" style='margin-top: 20px;' class='red_button right' id='new_response'>New Response</a>



<div id='ticket_reply' style='display: none;'>
<form id='ticket_reply_form' method='post' >
<input type='hidden' name='ticket_id' value='<?php echo $this->uri->segment(4); ?>' />
	<p>New Response</p>
	<p><textarea id='ticket_reply_form_text' name='response'></textarea></p>
	<p class='left marginless'><input type='checkbox' name='resolution' />Mark as Resolved</p>
	<a href="#" id="submit" class='red_button right'>Submit</a>
</form>
</div>
<script>
$(function(){
	$("#new_response").click(function(){
		$(this).hide();
		$("#ticket_reply").show();
	});
	$("#submit").click(function(){
		$("#ticket_reply_form").submit();
	});
});

</script>