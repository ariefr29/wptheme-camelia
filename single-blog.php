<?php get_header(); 
if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="container p-0">

  <header class="header-content mb-4 p-4 artikel">
    <div class="thumbnail mb-3">
      <?php cover_image(); ?>
    </div>
    <?php the_title('<h1 class="entry-title h4 mb-0">', '</h1>'); ?>
  </header>

  <div class="content mb-4 p-4 artikel">
    <?php the_content(); ?>
  </div>

  <div class="footer-entry mb-5 p-3 bg-white">
    <?php echo e_share("mb-3"); ?>
    <button class="tombol-show-comment btn p-2" onclick="toggle('#Komentar', 'd-block')">Show Comments</button>
    <div id="Komentar" class="p-4 d-none">
      <?php comments_template(); ?>
    </div><!-- #Komentar -->
  </div><!-- footer-entry -->

</main><!-- main.container -->

<?php endwhile; endif; 
get_footer(); ?>