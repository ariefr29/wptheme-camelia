<?php 
/**
 * Related post : Display
 */
if (!empty($related_posts)) { ?>
    <div class="related-posts">
      <ul class="related-posts-list mb-0 p-0 row">
        <?php
        foreach ($related_posts as $post) {
          setup_postdata($post);
        ?>
        <li class="ls-none jtok w-2 w-sm-4">
          <a class="title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <div class="thumb position-relative">
              <?php cover_image( 'medium', true ); ?>
            </div>
            <h4 class="line-clamp-2"><?php the_title(); ?></h4>
          </a>
        </li>
        <?php } ?>
      </ul>
      <div class="clearfix"></div>
    </div>
<?php
}