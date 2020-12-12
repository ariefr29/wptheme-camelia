<?php

/**
 * Requires the custom post types
 */
require __DIR__ . '/custom-post-types.php';

/**
 * Requires the custom panel
 */
require __DIR__ . '/panel.php';

/**
 * Requires the custom taxonomies
 */
require __DIR__ . '/taxonomies.php';

/**
 * Requires the custom meta
 */
require __DIR__ . '/meta.php';

/**
 * Requires the compres
 */
if (get_option('set_theme_compres')=='yes') {
  require __DIR__ . '/compres.php';
}

/**
 * View Count Post
 */
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function wpb_get_post_views($postID){
     $count_key = 'wpb_post_views_count';
     $count = get_post_meta($postID, $count_key, true);
     if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
     return "0";
    }
    return $count;
}

// the_excerpt
function exc_length(){ return 21; }
function exc_more(){ return '...' ;}
add_filter('excerpt_length', 'exc_length');
add_filter('excerpt_more', 'exc_more');

// Cover Image
function cover_image( $image_size='medium_large', $image_class=false, $image_link=false ) {
  $image_class = ( $image_class == true ) ? 'position-cover poster' : 'cover-thumbnail' ;
  $novel_ID = get_post_meta(get_the_ID(), 'etheme_novel', true);

  if ( is_singular('post') && has_post_thumbnail($novel_ID) || has_post_thumbnail($novel_ID) ) { 
    $gmbar = get_the_post_thumbnail($novel_ID, $image_size, array('alt' => the_title_attribute(array('echo' => false)), 'class' => $image_class));
    // for Thumbnail + link
    if($image_link == true) {
      echo '<a href=" '.get_the_permalink().' ">' .$gmbar. '</a>';
    } else {
      echo $gmbar;
    }
  } else { 
    $gmbr_ID = (is_singular('post')) ? $novel_ID : get_the_ID() ;
    $gmbr = get_post_meta( $gmbr_ID, 'etheme_cover', true );
    $gmbar = '<img src="'.$gmbr.'" alt="'. get_the_title($novel_ID) .'" class="'.$image_class.'">'; 
    // for Thumbnail + link
    if($image_link == true) {
      echo '<a href=" '.get_the_permalink().' ">' .$gmbar. '</a>';
    } else {
      echo $gmbar;
    }
  }
}

// Chapter List
function chapterlist($id, $sort, $current, $mode)
{
  $args = [
    'showposts' => -1,
    'post_type'  => 'post',
    'meta_key' => 'etheme_novel',
    'meta_value' => $id,
    'orderby'    => ['etheme_chapter' => $sort, 'post_date' => $sort]
  ];
  $list = new WP_Query($args);
  if ($list->have_posts()) {
    while ($list->have_posts()) {
      $list->the_post();
      switch ($mode) {
        case 1: ?>
          <a href="<?php the_permalink(); ?>">
            <li class="chaplist ls-none">
              <?php 
              $chap = get_post_meta($id, 'etheme_chapter', true);
              $chap = ($chap == true) ? $chap . ' – ' : '' ; ?>
              <span><?php echo $chap ; the_title(); ?></span>
            </li>
          </a> <?php
          break;
        
        case 2:
          if ($current === get_the_ID()) { ?>
              <li class="active lh-1 p-3"> <?php the_title(); ?> </li>
          <?php } else { ?>
            <li class="lh-1"> 
              <a class="d-block p-3" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
            </li>
          <?php }
          break;
      } 
    }
  } else {
    echo '<div class="col mt-3">Chapter not available yet.</div>';
  }
}

// Total views allChapter
function get_chapterList_info($mode, $txt=true) {
  $args = [
    'showposts' => -1,
    'post_type'  => 'post',
    'meta_key' => 'etheme_novel',
    'meta_value' => get_the_ID()
  ];
  $list = new WP_Query($args);
  if ($list->have_posts()) {
    $i = 0;
    while ($list->have_posts()) {
      $list->the_post();
      // loop data
      switch ($mode) {
        case 'totalViews':
          $total[$i] = wpb_get_post_views(get_the_ID());
          break;
        case 'totalChapter':
          $total[$i] = 1;
          break;
      }
      $i++;
    }
    // show data 
    switch ($mode) {
      case 'totalViews':
        echo '<div class="d-flex align-items-center">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1.13em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);width: inherit;height: inherit;margin-right: 5px;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 576 512"><path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144a143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79a47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z" fill="#626262"></path><rect x="0" y="0" width="576" height="512" fill="rgba(0, 0, 0, 0)"></rect></svg>';
        echo array_sum($total);
        $text = ($txt==true) ? ' Reads' : '' ;
        echo $text;
        echo '</div>';
        break;
      case 'totalChapter':
        echo '<div class="d-flex align-items-center">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);width: inherit;height: inherit;margin-right: 5px;" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path d="M80 368H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm0-320H16A16 16 0 0 0 0 64v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16V64a16 16 0 0 0-16-16zm0 160H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm416 176H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z" fill="#626262"></path><rect x="0" y="0" width="512" height="512" fill="rgba(0, 0, 0, 0)"></rect></svg>';
        echo array_sum($total);
        $text = ($txt==true) ? ' Part' : '' ;
        echo $text;
        echo '</div>';
        break;
    }
  }
  wp_reset_query();
}

// Category novel for post
function category_novel() {
  $novel_ID = get_post_meta(get_the_ID(), 'etheme_novel', true);

  if ($novel_ID == true) { 
    echo '<a href="' . get_the_permalink($novel_ID) . '" rel="category tag" title="' . get_the_title($novel_ID) . '">';
    echo get_the_title($novel_ID);
    echo '</a>';
  } else {
    the_category(' ', ' '); 
  }
}

// NextPrev chapter series
function nextprev() {
  $id = get_the_ID();
  $novel_ID = get_post_meta($id, 'etheme_novel', true);

  $all_posts = new WP_Query(array(
    'orderby'    => ['etheme_chapter' => 'ASC', 'post_date' => 'ASC'],
    'meta_query' => array(
      array(
        'key' => 'etheme_novel',
        'value' => $novel_ID,
        'compare' => '=',
      )
    ),
    'posts_per_page' => -1
  ));

  foreach ($all_posts->posts as $key => $value) {
    if ($value->ID == $id) {
      $nextID = $all_posts->posts[$key + 1]->ID;
      $prevID = $all_posts->posts[$key - 1]->ID;
      break;
    }
  }
  
  if ($prevID) { ?>
    <a href="<?= get_the_permalink($prevID) ?>" title="Previous Chapter" class="color-text" rel="previous">
      <button class="prev btn d-flex align-items-center m-1 p-2">
        <svg viewBox="0 0 24 24" width="24" height="24"><path d="M7.828 11H20v2H7.828l5.364 5.364l-1.414 1.414L4 12l7.778-7.778l1.414 1.414z"></path></svg>
      </button>
    </a>
  <?php } else {
    echo '<div class="prev btn d-flex align-items-center m-1 p-2" style="opacity: .3;"> <svg viewBox="0 0 24 24" width="24" height="24"><path d="M7.828 11H20v2H7.828l5.364 5.364l-1.414 1.414L4 12l7.778-7.778l1.414 1.414z"></path></svg> </div>';
  }
  if ($nextID) { ?>
    <a href="<?= get_the_permalink($nextID) ?>" title="Next Chapter" class="color-text" rel="next">
      <button class="next btn d-flex align-items-center m-1 p-2">
        <svg width="24" height="24" viewBox="0 0 24 24"><path d="M16.172 11l-5.364-5.364l1.414-1.414L20 12l-7.778 7.778l-1.414-1.414L16.172 13H4v-2z"></path></svg>
      </button>
    </a>
  <?php } else {
    echo '<div class="next btn d-flex align-items-center m-1 p-2" style="opacity: .3;"> <svg width="24" height="24" viewBox="0 0 24 24"><path d="M16.172 11l-5.364-5.364l1.414-1.414L20 12l-7.778 7.778l-1.414-1.414L16.172 13H4v-2z"></path></svg> </div>';
  }
}

// Options Stlye Display
function options_style($class=null) {
  ?>
  <div class="options-style p-2 <? echo $class ?>">
    <span class="w-1 m-1">Font</span>
    <div class="setFont-family d-flex p-1">
      <select id="input-font" class="input"  onchange="changeFont (this);" style="width: 100%;">
        <option disabled >== Font Family ==</option>
        <option value="var(--font-family-arvo)">Serif</option>
        <option value="var(--font-family-nunito)">Sans Serif</option>
        <option value="var(--font-family-mali)">Mali</option>
        <option value="var(--font-family-ubuntu-mono)">Monospace</option>
      </select>
    </div><!-- .setFont-family -->
    <div class="setFont-size d-flex justify-content-between">
      <button id="down-font-size" class="btn btn-size justify-content-center align-items-center col m-1">Aa–</button>
      <button id="up-font-size" class="btn btn-size justify-content-center align-items-center col m-1">Aa+</button>
    </div><!-- .setFont-size -->

    <div class="d-md-block d-flex justify-content-between mt-1">
      <div class="d-none d-md-block">
        <span class="w-1 m-1">Width</span>
        <div class="set-width-size d-flex justify-content-between">
          <button id="down-width" class="btn d-flex  justify-content-center align-items-center m-1 col">
            <svg width="42" height="16" viewBox="0 0 42 16" fill="context-fill">
              <path d="M14.5,7 L8.75,1.25 L10,-1.91791433e-15 L18,8 L17.375,8.625 L10,16 L8.75,14.75 L14.5,9 L1.13686838e-13,9 L1.13686838e-13,7 L14.5,7 Z"/>
              <path d="M38.5,7 L32.75,1.25 L34,6.58831647e-15 L42,8 L41.375,8.625 L34,16 L32.75,14.75 L38.5,9 L24,9 L24,7 L38.5,7 Z" transform="translate(33.000000, 8.000000) scale(-1, 1) translate(-33.000000, -8.000000)"/>
            </svg>
          </button>
          <button id="up-width" class="btn d-flex justify-content-center align-items-center m-1 col">
            <svg width="44" height="16" viewBox="0 0 44 16">
              <path d="M14.5,7 L8.75,1.25 L10,-1.91791433e-15 L18,8 L17.375,8.625 L10,16 L8.75,14.75 L14.5,9 L1.13686838e-13,9 L1.13686838e-13,7 L14.5,7 Z" transform="translate(9.000000, 8.000000) scale(-1, 1) translate(-9.000000, -8.000000)"/>
              <path d="M40.5,7 L34.75,1.25 L36,-5.17110888e-16 L44,8 L43.375,8.625 L36,16 L34.75,14.75 L40.5,9 L26,9 L26,7 L40.5,7 Z"/>
            </svg>
          </button>
        </div><!-- .set-width-size -->
      </div><!-- .d-none -->

      <div style="width:100%">
        <span class="w-1 m-1">Line Height</span>
        <div class="set-lh-size d-flex justify-content-between">
          <button id="down-lh" class="btn d-flex justify-content-center align-items-center m-1 col">
            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="24" viewBox="0 0 38 24">
              <rect x="0" y="5" width="28" height="2"/>
              <rect x="0" y="11" width="38" height="2"/>
              <rect x="0" y="17" width="18" height="2"/>
            </svg>
          </button>
          <button id="up-lh" class="btn d-flex justify-content-center align-items-center m-1 col">
            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="24" viewBox="0 0 38 24">
              <rect x="0" y="1" width="28" height="2"/>
              <rect x="0" y="11" width="38" height="2"/>
              <rect x="0" y="21" width="18" height="2"/>
            </svg>
          </button>
        </div><!-- .set-lh-size -->
      </div><!-- width 100% -->

      <div style="width:100%">
        <span class="w-1 m-1">Line Break</span>
        <div class="set-mb-size d-flex">
          <button id="down-mb" class="btn col m-1">
            <svg viewBox="0 0 24 24" width="18" height="18">
              <path fill="context-fill" d="M0,13.5v-3h24v3H0z"></path>
            </svg>
          </button>
          <button id="up-mb" class="btn col m-1">
            <svg viewBox="0 0 24 24" width="18" height="18">
              <path fill="context-fill" d="M24,13.5H13.5V24h-3V13.5H0v-3h10.5V0h3v10.5H24V13.5z"></path>
            </svg>
          </button>
        </div><!-- .set-mb-size -->
      </div><!-- width 100% -->
    </div><!-- .d-md-block -->

    <div class="set-other d-flex justify-content-between">
      <button id="boxez" class="btn d-flex justify-content-center align-items-center col m-2 p-2 b-radius">Boxed</button>
      <button id="reset" class="btn d-flex justify-content-center align-items-center col m-2 p-2 bg-primary">
        <svg viewBox="0 0 1024 1025" width="19" height="19" class="mr-1"><path d="M512 897v110q-30 30-50 10L268 861q-12-12-12-28.5t12-28.5l194-156q20-20 50 10v111q114 0 216.5-29.5t167-81.5T960 545q0-13 9.5-22.5T992 513t22.5 9.5t9.5 22.5q0 81-42 149T868.5 805.5T705 873t-193 24zm50-519q-20 20-50-10V257q-114 0-216.5 29t-167 81.5T64 481q0 13-9.5 22.5T32 513t-22.5-9.5T0 481q0-82 42-149.5t113.5-111T319 153t193-24V18q30-29 50-9l194 156q12 12 12 28.5T756 222z" fill="currentColor"></path></svg>
        Reset
      </button>
    </div><!-- set-other -->

    <div class="modus-background d-flex justify-content-between mt-1 pt-2 p-1">
      <button class="btn w-3 light" onclick="bgModus('light')"><div class="bg-option p-2" style="background:#fff;color:#222">Light</div></button>
      <button class="btn w-3 sepia" onclick="bgModus('sepia')"><div class="bg-option p-2">Sepia</div></button>
      <button class="btn w-3 dark" onclick="bgModus('dark')"><div class="bg-option p-2">Dark</div></button>
    </div><!-- .modus-background -->
  </div><!-- .options-style -->
  <?php
}

// Share
function e_share($add_class=null) {
  global $post;
  $postlink  = get_permalink($post->ID);
  $posttitle = get_the_title($post->ID);
  $html = '<div class="share-entry d-flex '.$add_class.'">';
  $html .= '<a class="bg-tw p-2 d-flex justify-content-center align-items-center" title="Share on Twitter" rel="external" href="http://twitter.com/share?text='.$posttitle.'&url='.$postlink.'"><svg style="transform: rotate(360deg);font-size: 20px;" width="1em" height="1em" viewBox="0 0 24 24"><path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814a11.874 11.874 0 0 1-8.62-4.37a4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101a4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732a11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9c0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z" fill="currentColor"></path></svg> <span class="ml-1">Tweet</span></a>';
  $html .= '<a class="bg-fb p-2 ml-2 d-flex justify-content-center align-items-center" title="Share on Facebook" rel="external" href="http://www.facebook.com/share.php?u=' . $postlink . '"><svg style="transform: rotate(360deg);font-size: 20px;" width="1em" height="1em" viewBox="0 0 24 24"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z" fill="currentColor"></path></svg> <span class="ml-1">Share</span></a>';
  $html .= '<a class="bg-wa p-2 ml-2 d-flex justify-content-center align-items-center" title="Share on Whatsapp" rel="external" href="whatsapp://send?text='.$posttitle.' on '.$postlink.'"><svg style="transform: rotate(360deg);font-size: 20px;" width="1em" height="1em" viewBox="0 0 24 24"><path d="M7.253 18.494l.724.423A7.953 7.953 0 0 0 12 20a8 8 0 1 0-8-8a7.95 7.95 0 0 0 1.084 4.024l.422.724l-.653 2.401l2.4-.655zM2.004 22l1.352-4.968A9.954 9.954 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10a9.954 9.954 0 0 1-5.03-1.355L2.004 22zM8.391 7.308c.134-.01.269-.01.403-.004c.054.004.108.01.162.016c.159.018.334.115.393.249c.298.676.588 1.357.868 2.04c.062.152.025.347-.093.537a4.38 4.38 0 0 1-.263.372c-.113.145-.356.411-.356.411s-.099.118-.061.265c.014.056.06.137.102.205l.059.095c.256.427.6.86 1.02 1.268c.12.116.237.235.363.346c.468.413.998.75 1.57 1l.005.002c.085.037.128.057.252.11c.062.026.126.049.191.066a.35.35 0 0 0 .367-.13c.724-.877.79-.934.796-.934v.002a.482.482 0 0 1 .378-.127c.06.004.121.015.177.04c.531.243 1.4.622 1.4.622l.582.261c.098.047.187.158.19.265c.004.067.01.175-.013.373c-.032.259-.11.57-.188.733a1.155 1.155 0 0 1-.21.302a2.378 2.378 0 0 1-.33.288a3.71 3.71 0 0 1-.125.09a5.024 5.024 0 0 1-.383.22a1.99 1.99 0 0 1-.833.23c-.185.01-.37.024-.556.014c-.008 0-.568-.087-.568-.087a9.448 9.448 0 0 1-3.84-2.046c-.226-.199-.435-.413-.649-.626c-.89-.885-1.562-1.84-1.97-2.742A3.47 3.47 0 0 1 6.9 9.62a2.729 2.729 0 0 1 .564-1.68c.073-.094.142-.192.261-.305c.127-.12.207-.184.294-.228a.961.961 0 0 1 .371-.1z" fill="currentColor"></path></svg> <span class="ml-1">Share</span></a>';
  $html .= '</div><!-- .share-entry -->';
  return $html;
}

// Set Ads
function set_ads($mode) {
  switch ($mode) {
    case 'header':
      if (get_option('set_ads_header')) {
        echo '<div class="ikln mb-4">' . get_option('set_ads_header') . '</div>';
      }
      break;
    case 'sidebar':
      if (get_option('set_ads_sidebar')) {
        echo '<div class="ikln mb-4">' . get_option('set_ads_sidebar') . '</div>';
      } else {
        ?>
        <div class="ikln mb-4">
          <div class="maxwidth-noikln m-auto" style="max-width:300px;">
            <div class="noikln bg-cover" style="background-image:url(<?php echo get_template_directory_uri() . '/assets/img/300px.jpg'; ?>)"></div>
          </div>
        </div>
        <?php
      }
      break;
    case 'footer':
      if (get_option('set_ads_footer')) {
        echo '<div class="ikln mt-4">' . get_option('set_ads_footer') . '</div>';
      }
      break;
  } ?>
  <?php
}

// Paginate
function paginate(\WP_Query $wp_query = null, $echo = true) {
  if (null === $wp_query) {
    global $wp_query;
  }
  $pages = paginate_links(
    [
      'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
      'format'       => '?paged=%#%',
      'current'      => max(1, get_query_var('paged')),
      'total'        => $wp_query->max_num_pages,
      'type'         => 'array',
      'show_all'     => false,
      'end_size'     => 1,
      'mid_size'     => 1,
      'prev_next'    => true,
      'prev_text'    => __('Prev'),
      'next_text'    => __('Next'),
      'add_args'     => false,
      'add_fragment' => ''
    ]
  );
  if (is_array($pages)) { 
    $pagination = '<div class="paginate"><ul class="pagination mt-3 p-0 ls-none d-flex justify-content-center">';
    foreach ($pages as $page) {
      $pagination .= '<li class="page-item ' . (strpos($page, 'current') !== false ? 'active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
    }
    $pagination .= '</ul></div>';
    if ($echo) {
      echo $pagination;
    } else {
      return $pagination;
    }
  }
  return null;
}