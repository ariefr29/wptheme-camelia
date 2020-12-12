<?php
$showpost = get_option('set_blog_showpost') ?: 3 ;
$orderby  = get_option('set_blog_orderby') ?: 'modified' ;

$relakan = new WP_Query(array(
  'post_type' => 'blog',
  'showposts' => $showpost,
  'orderby'   => $orderby,
)); ?>

<div class="blog-artikel b-radius mb-4">
  <ul id="slides" style="padding-top:47.5%">
    <?php $i = 0; while($relakan->have_posts()) : $relakan->the_post(); $i++; 
      // variabel for add class html to first element slide
      $showing = ($i == 1) ? 'showing' : '' ; 
      
      // if direct link true
      $cover = get_post_meta($post->ID, 'etheme_cover', true);
      $link  = get_post_meta($post->ID, 'etheme_url_direct', true);
      $link  = ($link == true) ? $link : get_the_permalink(); 
      ?>

      <li class="slide <?= $showing ?>">
        <a href="<?= $link ?>" class="transition-toggle" tabindex="0">
          <h2 class="h5 title mb-4 p-3 position-bottom transition-slide-top-small"><?php the_title(); ?></h2>
          <?php if ($cover == true) {
            echo '<img class="position-top-center" src="' .$cover. '" alt="' .get_the_title(). '">';
          } else {
            cover_image(); 
          } ?>
        </a>
      </li><!-- .slide -->
    <?php endwhile; ?><?php wp_reset_postdata(); ?>
  </ul><!-- #slides -->
</div><!-- .blog-artikel -->
