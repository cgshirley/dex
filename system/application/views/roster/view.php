<h1><?php echo $member_data['last_name'].", ".$member_data['first_name']; ?></h1>
<h3>Contact Information</h3>
<table>
<?php 
if(isset($member_data['email_personal']))
{
	echo "<tr><td>Preferred Email</td><td>".$member_data['email_personal']."</td></tr>";
}
?>
<?php 
if(isset($member_data['email_yale']))
{
	echo "<tr><td>Yale Email</td><td>".$member_data['email_yale']."</td></tr>";
}
?>
</table>
<table>
<?php
foreach($member_data as $key=>$val)
{
	echo "<tr><td>".$key."</td><td>".$val."</td></tr>";
}
?>
</table>