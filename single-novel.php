<?php get_header(); 
if (have_posts()) : while (have_posts()) : the_post();

# Variable meta
$title        = get_post_meta($post->ID, 'etheme_original_title', true);
$other_title  = get_post_meta($post->ID, 'etheme_associated_names', true);
$type         = get_post_meta($post->ID, 'etheme_type_novel', true);
$year         = get_post_meta($post->ID, 'etheme_year', true);
$source       = get_post_meta($post->ID, 'etheme_source', true);
$tl           = get_post_meta($post->ID, 'etheme_translate', true);
$dltitle      = get_post_meta($post->ID, 'etheme_download_title', true);
$dlbox        = get_post_meta($post->ID, 'etheme_download_box', true);

# Taxonomy
$status   = get_the_term_list($post->ID, 'status');
$genre    = get_the_term_list($post->ID, 'genres', '', '', '');
$authors  = get_the_term_list($post->ID, 'authors', '', ' ', '');
$country  = get_the_term_list($post->ID, 'country');
?>

<style>
.container { 
  max-width: 1040px;
  font-size:15px;
}
</style>
<main id="badan" class="container site-main" role="main">
  <div id="novel" class="row mt-5">
  
    <div class="kiri col-12 col-md-3 mr-md-4 pr-md-2">
      <div class="d-flex justify-content-center">
        <div class="cover mb-3 b-radius position-relative" style="max-width: 250px;"><?php cover_image(); ?></div>
      </div>
      <div class="meta mb-3 d-flex justify-content-center">
        <?php echo get_chapterList_info('totalViews') . get_chapterList_info('totalChapter') ?>
      </div><!-- .meta -->
      <?php if ($type) {
        echo '<div class="btn status b-radius bg-primary">'.$type.'</div>';
      } ?>
      <div class="info mb-5 p-4 bg-white b-radius">
        <?php 
          if($other_title){ echo '<li class="nani ls-none"><b>Associated Names</b> <span>'.$other_title.'</span> </li>'; }
          if($country){ echo '<li class="nani ls-none"><b>Country</b> <span>'.$country.'</span> </li>'; }
          if($authors){ echo '<li class="nani ls-none"><b>Author(s)</b> <span>'.$authors.'</span> </li>'; }
          if($year){ echo '<li class="nani ls-none"><b>Released</b> <span>'.$year.'</span> </li>'; }
          if($status){ echo '<li class="nani ls-none"><b>Status</b> <span>'.$status.'</span> </li>'; }
          if($source){ echo '<li class="nani ls-none"><b>Source</b> <span>'.$source.'</span> </li>'; }
          if($tl){ echo '<li class="nani ls-none"><b>Translation</b> <span>'.$tl.'</span> </li>'; }
        ?>
      </div><!-- .info -->
    </div><!-- .kiri -->

    <div class="kanan col-12 col-md p-0 pl-sm-3 pr-sm-3">
      <div class="batas p-4 bg-white b-radius">
        <header class="header-entry p-sm-1 mb-3">
          <?php the_title( '<h1 class="entry-title h3 color-primary" style="margin-bottom: .75rem;">', '</h1>' ); ?>
          <div class="genres">
            <?php echo get_the_term_list($post->ID, 'genres', '', '', ''); ?>
          </div>
        </header><!-- .header-entry -->
        
        <div class="sinopsis p-sm-1 b-radius">
          <?php the_content(); ?>
        </div><!-- .sinopsis -->
        
        <?php 
          #Ads Header
          set_ads('header');
          #Latest Chapter
          $cp = new WP_Query([ 'showposts' => 1, 'post_type'  => 'post', 'meta_key' => 'etheme_novel', 'meta_value' => get_the_ID() ]);
          if ($cp->have_posts()) : while ($cp->have_posts()) : $cp->the_post(); ?>
            <div class="l-chapter d-md-flex mt-2 mb-2 p-3">
              <div class="item-title mb-2 mb-md-0">Latest Chapter</div>
              <a class="item-chapter mr-3" href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                <span><?php echo the_title(); ?></span>
              </a>
              <div class="item-time ml-auto d-md-flex align-items-center"><?php the_time('d M, Y'); ?></div>
            </div>
          <?php endwhile;
        endif; wp_reset_postdata();
        ?>
        
        <div class="col p-1">
          <div class="tab d-sm-flex">
            <button class="tablinks active" onclick="openTab(event, 'ChapterList')"><span>Chapter List</span></button>
            <?php if($dltitle) { ?>
              <button class="tablinks" onclick="openTab(event, 'DownloadBox')"><span><?php echo $dltitle; ?></span></button>
            <?php } #if downloadTitle active ?> 
            <button class="tablinks" onclick="openTab(event, 'RelatedPost')"><span>More from authors</span></button>
            <button class="tablinks" onclick="openTab(event, 'Komentar')"><span>Comments</span></button>
          </div><!-- .tab -->

          <div id="ChapterList" class="tabcontent" style="display: block;">
            <?php echo chapterlist($post->ID, 'ASC', null, 1);
                  wp_reset_postdata(); ?>
          </div><!-- #ChapterList -->
          <?php if($dltitle) { ?>
            <div id="DownloadBox" class="col mt-3 tabcontent"><?php echo $dlbox; ?></div><!-- #DownloadBox -->
          <?php } #for active dlBox you must actived downloadTitle ?>
          <div id="RelatedPost" class="col mt-3 tabcontent">
            <?php etheme_related_post(array(
              'taxonomy' => 'authors',
              'limit' => 4
              )); ?>
          </div><!-- #RelatedPost -->
          <div id="Komentar" class="col mt-3 tabcontent"><?php comments_template(); ?></div><!-- #Komentar -->
        </div><!-- .col -->

      </div><!-- .batas -->
        <?php set_ads('footer'); echo e_share("bg-white box-shadow mt-4 mb-5 p-2"); ?>
    </div><!-- .kanan -->

  </div><!-- .row -->
</main><!-- #badan -->

<?php endwhile; endif;
get_footer(); ?>
