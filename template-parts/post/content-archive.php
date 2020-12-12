<?php
/**
 * Template part for displaying archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<article id="post-<?php the_ID(); ?>" class="arc">
<div class="artikel mb-3 p-2 p-md-3 d-flex">  

  <div class="col-auto p-0">
    <div class="thumb position-relative">
      <?php cover_image( 'medium', true, $image_link=true ); ?>
    </div>
  </div>

  <div class="header-entry col mt-1 pr-1">
    <?php the_title( '<h2 class="entry-title h5 mb-2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    <div class="entry-meta">
      <div class="meta mb-2 d-flex">
        <?php echo get_chapterList_info('totalViews', false) . get_chapterList_info('totalChapter', false) ?>
      </div>
      <div class="excerpt line-clamp-2">
        <?php the_excerpt(); ?>
      </div>
      <div class="genres line-clamp-1">
        <?php echo get_the_term_list($post->ID, 'genres', '', '', ''); ?>
      </div>
    </div><!-- .entry-meta --> 
  </div><!-- .header-entry -->

</div><!-- .artikel -->
</article>
