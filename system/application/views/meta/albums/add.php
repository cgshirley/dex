 <h1 class='meta_headline' style='margin-bottom: 0px;'>Meta<span class='meta_black'>Albums</span></h1>
 <form name='add_album' id='add_album' action='<?php echo site_url('meta/ajaxData/add_album'); ?>' method='post'>
 <label>Album Title</label>
 <input type='text' name='album' value='' />
 <label>Artist</label>
 <input type='text' name='artist' value='' />
 <input type='submit' value='Preview Album' />
 </form>