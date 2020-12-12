<footer class="container d-flex mb-4 pb-2 align-items-center">
  <div class="foot-text ml-2 mr-3 ml-sm-1 mr-sm-1"> <?php bloginfo( 'name' ) ?> </div>
  <div class="foot-menu">
  <?php if (has_nav_menu( 'footer_menu' )) {
    wp_nav_menu(array(
      'theme_location'  =>  'footer_menu', 
      'container'       =>  '',
      'menu_class'      =>  'row m-0 p-0 ls-none', 
    ));
  } ?>
  </div>
</footer><!-- footer -->

<?php wp_footer(); include(TEMPLATEPATH . '/assets/js/foot.php'); 
  if (get_option('set_body_code')) {
    echo get_option('set_body_code');
  } ?>
</body>
</html>
