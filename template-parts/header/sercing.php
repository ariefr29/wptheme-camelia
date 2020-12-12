<?php
/**
 * Displays header sercing
 */
?>

<div class="searchbar p-3 position-center">
<form action="<?php bloginfo('url'); ?>" id="form" class="position-relative" method="get" role="search">
  <input id="s" type="text" placeholder="Search ..." name="s">
  <input type="hidden" name="post_type" value="novel" />
  <span class="closez lh-0 position-center-right" onclick="toggle('.searchbar', 'show')">
    <svg width="1em" height="1em" viewBox="0 0 24 24"><path d="M12 10.586l4.95-4.95l1.414 1.414l-4.95 4.95l4.95 4.95l-1.414 1.414l-4.95-4.95l-4.95 4.95l-1.414-1.414l4.95-4.95l-4.95-4.95L7.05 5.636z" fill="currentColor"></path></svg>
  </span>
</form>
</div>