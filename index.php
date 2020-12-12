<?php get_header(); ?>


<main id="badan" class="container site-main" role="main">
  <div class="row mt-5">
    
    <div id="primary" class="content-area col-12 col-md-8 mb-5">
      <?php 
        // Blog [Slidshow]
        if (get_option('set_blog_display') == 'show') {
          get_template_part( 'template-parts/post/content', 'blog' ); 
        }

        // Notif Homepage
        if (get_option('set_main_info')) :
          echo '<div class="notip red mb-4 p-4">' . get_option('set_main_info') . '</div>';
        endif;

        // ads header
        set_ads('header');

        if (is_front_page() || is_home()) : 
          echo '<h3 class="h6 main widget-title mb-4 p-2 pl-3 pr-3">New Update</h3>';
        endif;
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          get_template_part( 'template-parts/post/content' );
        endwhile; else : endif;

        // ads footer
        set_ads('footer');
        // Pagination
        paginate();
      ?>
    </div><!-- #primary -->
        
    <?php get_sidebar(); ?>
  
  </div><!-- .row -->
</main><!-- badan -->

<?php get_footer(); ?>
