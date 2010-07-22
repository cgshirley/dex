
<h1>Member Data Verification</h1>
<p>Hello, WYBC member! From time to time, we like everyone to check in and verify the information we have stored in our member database. So here is how you can help: First, click your name below. We will send an email to you with a special link. Click this link and it will take you to a page with your information on it. Fix any errors you notice and then click submit. Thanks for your help!</p>
<ul>
<?php
foreach ( $roster as $key=>$val )
{
	echo "<li><a href='".site_url('roster/verify/thanks/'.$val['member_id'])."'>".$val['last_name'].", ".$val['first_name']."</a></li>";
}
?>
</ul>