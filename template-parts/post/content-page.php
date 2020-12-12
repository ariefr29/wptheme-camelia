<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @example usage: get_template_part( 'template-parts/content', 'page' );
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('artikel mb-3 p-3 p-sm-4'); ?>>
	<header class="header-entry">
		<?php the_title( '<h1 class="entry-title h3 mb-3">', '</h1>' ); ?>
  </header><!-- .entry-header -->
  
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->