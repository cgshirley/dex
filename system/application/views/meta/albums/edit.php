 <!--<h1 class='meta_headline' style='margin-bottom: 30px;'>Meta<span class='meta_black'>Albums</span></h1>-->
 <p class='breadcrumb' id='ticket_breadcrumb' ><a href="<?php echo site_url("admin"); ?>" id='ticket_link'>Admin</a> | <a href="<?php echo site_url("admin/index#meta"); ?>" id='ticket_link'>Meta</a> | <a href='<?php echo site_url('meta/albums'); ?>'>Manage Albums</a> | Edit Album</p>
 <form class='ui-widget' name='edit_album' id='edit_album' action='<?php echo site_url('meta/ajaxData/edit_album'); ?>' method='post'>
 <input type='text' id='title_h1' name='album' value='<?php echo $album['title']; ?>' />
 <input type='hidden' id='show_id' name='show_id' value="<?php echo $this->uri->segment(4); ?>" />
<p id='artist'>by <?php echo $album['artist']; ?></p>
 <h3>Tracks</h3>
<table id='tracks' style='border-collapse: collapse;'>
<thead>
  <tr>
    <th style='width: 100px;'>Track #</th>
    <th>Title</th>
    <th>Play count</th>
    <th>Delete?</th>
  </tr>
 </thead>
 <tbody>
 <?php 
 foreach($album['tracks'] as $key=>$val)
 {
	echo "<tr>";
 	echo "<td id='track_number'><input name='song_track_".$val['id']."' value='".$val['track']."' /></td>";
 	echo "<td id='title'><input name='song_title_".$val['id']."' value='";
 	print htmlentities($val['title'], ENT_QUOTES);
 	echo "' /></td>";
 	echo "<td>".$val['stats']['total']."</td>";
 	echo "<td><input type='checkbox' name='delete_".$val['id']."' /></td></tr>";
 }
 ?>
 
 </tbody></table>
  <input type='submit' value='Edit this Album' />
 </form>
 <style>
 th{
 	text-align: left;
 }
 #title_h1{
 	font-size: 24px;
 }
 #track_number input{ 
 	width: 60px;
 }
 #title input{
 	width: 350px;
 }
 #artist{
 	border-bottom: 5px solid black;
	margin-top:10px;
	padding-bottom:30px;
}