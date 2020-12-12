<?php
/*
Template Name: Novel List
*/
get_header(); ?>

<style>
  .kolist{text-align:center;list-style:none!important;margin:0!important;padding:0!important}
  .kolist .lst{display:inline-block;width:5%;margin:3px;margin-bottom:0}
  .kolist .lst a{display:block;width:100%;padding:3px;border:solid 1px;margin-bottom:5px;color:#4d9bc7}
  .kolist .lst a:hover{color:#f5cf25}
  .kolist .lst:nth-child(2n+1) a:hover{color:#3ae822}
  .kolist .lst:nth-child(3n+1) a:hover{color:#f64e4e}

  .letter-group {
    overflow: hidden;
  }
  .letter-cell .entry-title {
    background: var(--color-primary);
    color: var(--bg-boxed) !important;
    width: 40px;
    height: 40px;
  }
  @media only screen and (max-width: 782px) {
  
  }
  @media only screen and (max-width: 568px) {
  .kolist .lst{width:9%}
  }
</style>

<div class="container">
  <div class="artikel mt-4 mt-sm-5 mb-4 mb-sm-5 p-4 p-md-5">

    <?php the_title( '<h1 class="entry-title h3 mb-3 color-primary">', '</h1>' ); ?>
    <ul class="kolist"> <li class="lst"><a href="##">#</a></li><li class="lst"><a href="#A">A</a></li><li class="lst"><a href="#B">B</a></li><li class="lst"><a href="#C">C</a></li><li class="lst"><a href="#D">D</a></li><li class="lst"><a href="#E">E</a></li><li class="lst"><a href="#F">F</a></li><li class="lst"><a href="#G">G</a></li><li class="lst"><a href="#H">H</a></li><li class="lst"><a href="#I">I</a></li><li class="lst"><a href="#J">J</a></li><li class="lst"><a href="#K">K</a></li><li class="lst"><a href="#L">L</a></li><li class="lst"><a href="#M">M</a></li><li class="lst"><a href="#N">N</a></li><li class="lst"><a href="#O">O</a></li><li class="lst"><a href="#P">P</a></li><li class="lst"><a href="#Q">Q</a></li><li class="lst"><a href="#R">R</a></li><li class="lst"><a href="#S">S</a></li><li class="lst"><a href="#T">T</a></li><li class="lst"><a href="#U">U</a></li><li class="lst"><a href="#V">V</a></li><li class="lst"><a href="#W">W</a></li><li class="lst"><a href="#X">X</a></li><li class="lst"><a href="#Y">Y</a></li><li class="lst"><a href="#Z">Z</a></li></ul>
  
    <div class="daftar-novel row mt-4 mt-md-5">
      <?php
        $args = array(
          'showposts' => -1,
          'post_type' => ['novel'],
          'orderby' => 'title',
          'order' => 'ASC',
        );
        $posts_per_row = '';
        $curr_letter = '';
        $post_count = '';
        query_posts($args);

        if (have_posts()) {
          $in_this_row = 0;
          while (have_posts()) {
            the_post();
            $first_letter = strtoupper(substr(apply_filters('the_title', $post->post_title), 0, 1));
            if ($first_letter != $curr_letter) {
              if (++$post_count > 1) {
                  end_prev_letter();
              }
              start_new_letter($first_letter);
              $curr_letter = $first_letter;
            }
            if (++$in_this_row > $posts_per_row) {
              ++$in_this_row; // Account for this first post
            } ?>

            <li class="jdl-series"> <a class='nama' rel="<?php the_id(); ?>" itemprop="url" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>

          <?php
          }
          end_prev_letter();          
        }
      ?>
    </div><!-- .daftar-novel -->

  </div><!-- .artikel -->
</div><!-- .container -->

<?php get_footer(); ?>

<?php
function end_prev_letter() {
  echo "</ul><!-- .series-group -->";
  echo "</div><!-- .letter-group -->";
}
function start_new_letter($letter) {
  echo "<div class='letter-group d-sm-flex mt-3 sidbox col-12 col-md-6 p-3'>";
  echo "<div class='letter-cell mr-3'><a class='entry-title h3 d-inline-block lh-1 b-radius d-flex align-items-center justify-content-center' name='$letter'>$letter</a></div>";
  echo "<ul class='series-group ls-none p-0'>";
}
?>