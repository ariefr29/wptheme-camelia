<?php get_header(); ?>

<main id="badan" class="container" role="main">
  <div class="row mt-5">

    <div id="primary" class="content-area col-12 col-md-8 mb-5">
      <h3 class="h6 main widget-title mb-4 p-2 pl-3 pr-3"> Search for: <?php echo get_search_query(); ?> </h3>
      <?php 

        set_ads('header');

        if ( have_posts() ) : while ( have_posts() ) : the_post();
          if (get_post_type(get_the_ID()) == "novel") {
            get_template_part( 'template-parts/post/content', 'archive' );
          }
        endwhile; 
          else : echo '<div class="p-4">Not Available</div>';
        endif;

        set_ads('footer');

        paginate(); 
      ?>
    </div><!-- #primary -->
    
    <?php get_sidebar(); ?>
  
  </div><!-- .row -->
</main><!-- #badan -->

<?php get_footer(); ?>
