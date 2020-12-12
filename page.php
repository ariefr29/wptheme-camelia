<?php get_header(); ?>

<style>
.container {--max-width: 1080px;}
.entry-content {
  font-size: 15px;
  line-height: 27px;
}
.entry-content p {
  margin-bottom: 1.5rem;
}
</style>

<?php while ( have_posts() ) : the_post(); ?>
<main id="badan" class="container site-main" role="main">
  <div class="row mt-5">

    <div id="primary" class="content-area col-12 col-md-8 mb-5">
      <?php get_template_part( 'template-parts/post/content', 'page' ); ?>
    </div><!-- #primary -->
        
    <?php get_sidebar(); ?>
  
  </div><!-- .row -->
</main><!-- #badan -->
<?php endwhile; ?>

<?php get_footer(); ?>
