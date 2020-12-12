<?php get_header(); ?>

<main id="badan" class="container" role="main">
  <div class="row mt-5">

    <div id="primary" class="content-area col-12 col-md-8 mb-5">
      <?php 
        #widget title
        the_archive_title('<h3 class="h6 main widget-title mb-4 p-2 pl-3 pr-3">','</h3>');

        set_ads('header');

        #get post
        if ( have_posts() ) : while ( have_posts() ) : the_post();
          get_template_part( 'template-parts/post/content', 'archive' );
        endwhile; else : endif;

        set_ads('footer');

        paginate(); 
      ?>
    </div><!-- #primary -->
        
    <?php get_sidebar(); ?>
  
  </div><!-- .row -->
</main><!-- #badan -->

<?php get_footer(); ?>
