<?php
/**
 * Displays header navigation
 */
?>

<div id="mySidenav" class="sidenav box-shadow">

  <div class="btn d-flex justify-content-center align-items-center p-2 p-md-3">
    <span id="closeNav" class="closebtn">
      <svg width="1em" height="1em" viewBox="0 0 24 24"><path d="M12 10.586l4.95-4.95l1.414 1.414l-4.95 4.95l4.95 4.95l-1.414 1.414l-4.95-4.95l-4.95 4.95l-1.414-1.414l4.95-4.95l-4.95-4.95L7.05 5.636z" fill="currentColor"></path></svg>
    </span>
  </div>

  <?php wp_nav_menu(array(
    'theme_location'  =>  'main_menu', 
    'container'       =>  '',
    'menu_class'      =>  'menulist m-4 p-4', 
  )); ?>

</div><!-- #mySidenav -->