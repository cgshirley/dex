<style>
body{
	background: #333;
}
#header ul li a.active {
	background-image:url("<?php echo base_url(); ?>assets/images/triangle-333.png");
}
#anime{
	margin-left:-830px;
	margin-top:187px;
	position:absolute;
} 
.dash_module{
	background: white;
	display: block;
	padding: 35px;
}
.dash_module h2 {
	font-size: 2em;
	margin: 0px 0px 20px;
}
#dash_blog_wrapper{
	width:550px;
	float: left;
	margin-top: 50px;
	margin-right: 40px;
}

.dash_blog{
	border-bottom: 1px solid #ccc;
	margin-bottom: 10px;
	padding: 10px 0px;
}
.dash_blog_header h3{
	margin: 0px;
}
.dash_blog_header h3 a{
	font-size: 20px;
	color: black;
	text-decoration: none;
}
.dash_blog_fulltext{
	display: none;
}
.dash_blog_summary{
	font-size: 14px;
}
.dash_blog_meta{
	color: #aaa; 
	font-weight: normal; 
	display: block; 
	font-size: 14px;
}
#dash_menu {
	float: left;
	margin-top: 50px;
	width: 320px;
}
.dash_menu_item {
	width: 250px;
}
#golive{
	text-decoration: none;
	color: red;
	font-size: 2em;
	text-transform: uppercase;
	font-weight: bold;
}
#golive:hover{ 
	background: black; ;
}
#golive .meta_black { 
	color: black;
}
#golive:hover .meta_black{
	color: white;
}
#golive .caption{
	color:#AAAAAA;
	display:block;
	font-size:14px;
	font-weight:normal;
	text-transform:none;
}
</style>
<!--
<img src="<?php echo base_url(); ?>assets/images/pokedex.jpg" />
<img src="<?php echo base_url(); ?>assets/images/pokedex-animation.gif" id='anime' />-->
<div id='dash_blog_wrapper' class='dash_module'>
<h2>Updates</h2>
<?php if ($feed->data): ?>
	<?php $items = $feed->get_items(0,5); ?>
		<?php  foreach ($items as $item): ?>
			<div class='dash_blog'>
				<div class='dash_blog_header'>
					<h3><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?> 
					<span class='dash_blog_meta'><?php if ($author = $item->get_author())
					{
						echo "By ".$author->get_name()." | ";
					}
					?>
					<?php echo $item->get_date('F jS Y'); ?></span></a></h3>
					</div>
				<div class='dash_blog_content'>
					<p class='dash_blog_summary'><?php echo $item->get_description(); ?></p>
					<div class='dash_blog_fulltext'>
						<?php echo $item->get_content(); ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
<?php endif; ?>
</div>
<div id='dash_menu'>
	<!--<div class='dash_menu_item '>-->
		<a id='golive' class='dash_module'  href='<?php echo site_url('meta/episodes'); ?>'>Meta<span class="meta_black">Live</span>
		<span class='caption'>Click here to start DJing your show.</span></a>
	<!--</div>-->
	<div class='dash_module' style='margin-top: 20px;'>
	<h2>Links</h2>
	<ul class='xoxo blogroll list'>
		<li><a href="http://wybcdjs.com/?page_id=31">EBoard Calendar</a></li>
		<li><a href="http://wybcdjs.com/?page_id=28">Member Events &amp; Outside Events</a></li>
		
		<li><a href="http://spreadsheets.google.com/viewform?formkey=dGgtclc5Q2o2V3BuX1JZMzdaWUY4YUE6MA">Reserve studio space!</a></li>
		<li><a href="http://wybcdjs.com/?page_id=23">WYBC AM 1340 Schedule</a></li>
		<li><a href="http://wybcdjs.com/?page_id=25">WYBC Moon (Production Room) Occupancy</a></li>
		<li><a href="http://wybcdjs.com/?page_id=18">WYBCX Schedule</a></li>
		<li><a target="_blank" title="Register your show for the Spring semester!" href="http://spreadsheets.google.com/viewform?formkey=dGdTRlFBSzQzVlFUR2t2ZkdVS0NMc3c6MA">Spring 2010 Show Applications</a></li>
		<li><a href="http://spreadsheets.google.com/viewform?formkey=dHQ2ZjA5X0dfT1hKQUczeS1hMEItYlE6MA">Request reimbursement</a></li>
<li><a title="Apply for a show!" href="http://spreadsheets.google.com/viewform?formkey=dGdTRlFBSzQzVlFUR2t2ZkdVS0NMc3c6MA">Spring 2010 Show App (NEW!)</a></li>
<li><a href="http://wybcdjs.com/groups/djcentral/wiki">Wiki</a></li>

	</ul>
	</div>

</div>