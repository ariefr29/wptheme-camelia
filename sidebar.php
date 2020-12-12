<aside id="sidebar" class="col-12 col-md-4 mb-4">
  <?php set_ads('sidebar'); ?>
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
  <?php endif; ?>
</aside>
