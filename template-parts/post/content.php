<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="artikel mb-3 p-3 p-md-4 d-flex align-items-center">  

  <div class="col-auto">
    <svg viewBox="0 0 24 24"><path d="M2 3.993A1 1 0 0 1 2.992 3h18.016c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H2.992A.993.993 0 0 1 2 20.007V3.993zM11 5H4v14h7V5zm2 0v14h7V5h-7zm1 2h5v2h-5V7zm0 3h5v2h-5v-2z" fill="currentColor"></path></svg>
  </div>

  <header class="header-entry col">

    <?php the_title( '<h2 class="entry-title h5 mb-1"><a class="line-clamp-2" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

    <div class="entry-meta d-sm-flex">
      <div class="entry-category mr-auto line-clamp-2">
        <?php category_novel(); ?>
      </div>
      <div class="entry-time"><?php the_time('d M, Y'); ?></div>
    </div><!-- .entry-meta --> 

  </header><!-- .header-entry -->

</div><!-- .artikel -->
</article>
