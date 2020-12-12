<?php get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
    $novel_ID = get_post_meta(get_the_ID(), 'etheme_novel', true); ?>

<div class="sideRight box-shadow">
  <div class="cover m-auto mb-3 p-3">
    <div class="gambar m-3 ml-auto mr-auto">
      <?php cover_image('medium'); ?>
    </div>
    <div class="meta-desc">
      <div class="entry-title">
        <?php echo category_novel(); ?>
      </div>
      <div class="daftar-isi mt-2">Table of Content</div>
    </div>
  </div><!-- .cover -->
  <ul class="chapterlist ls-none m-0 p-0">
    <?php 
      echo chapterlist($novel_ID, 'ASC', $post->ID, 2);
      wp_reset_postdata();
    ?>
  </ul><!-- .chapterlist -->
</div><!-- .sideRight -->

<div class="progress-container">
  <div class="progress-bar"></div>
</div><!-- progress-container -->

<div class="toolbar-container row container m-auto p-0 pl-sm-3 pr-sm-3">
  <div class="col-12 mt-2 pl-0 pr-0 position-relative">
    <div class="toolbar-reader d-flex position-relative p-1">
      <?php nextprev(); ?>
      <div class="cahnge-style ml-auto">
        <button onclick="toggleStyle()" class="btn dropbtn d-flex align-items-center m-1 p-2" title="Style">
          <div class="close-toggle"></div>
          <svg viewBox="0 0 24 24" width="24" height="24"><path d="M11.246 15H4.754l-2 5H.6L7 4h2l6.4 16h-2.154l-2-5zm-.8-2L8 6.885L5.554 13h4.892zM21 12.535V12h2v8h-2v-.535a4 4 0 1 1 0-6.93zM19 18a2 2 0 1 0 0-4a2 2 0 0 0 0 4z" fill="currentColor"></path></svg>
        </button>
      </div>
      <button class="list-chapter btn d-flex align-items-center m-1 p-2" title="List Chapter">
        <svg viewBox="0 0 24 24" height="24" width="24"><path d="M8 4h13v2H8V4zm-5-.5h3v3H3v-3zm0 7h3v3H3v-3zm0 7h3v3H3v-3zM8 11h13v2H8v-2zm0 7h13v2H8v-2z" fill="currentColor"></path></svg>
      </button>
      <?php options_style("position-absolute"); ?>
    </div> <!-- .toolbar-reader -->
  </div><!-- .col-12 -->
</div><!-- .toolbar-container -->

<main id="badan" class="container site-main" role="main">
  <div class="row mt-2">
    <div id="primary" class="content-area col-12 mb-5 p-0 p-sm-3">

      <article id="post-<?php the_ID(); ?>" <?php post_class('read-novel'); ?>>
        <header class="header-entry col mb-5" style="text-align:center;">
          <?php the_title( '<h1 class="entry-title h3 mb-1">', '</h1>' ); ?>
          <div class="entry-meta">
            <div class="entry-category"><?php category_novel(); ?></div>
          </div><!-- .entry-meta --> 
        </header><!-- .header-entry -->

        <div class="artikel p-4">
          <div class="entry-content pl-sm-4 pr-sm-4 pt-sm-2">
            <?php set_ads('header'); the_content(); set_ads('footer'); ?>
          </div><!-- .entry-content -->
        </div><!-- .artikel -->

        <div class="footer-entry mt-4 p-2 ml-auto">
          <?php echo e_share("mb-2"); ?>
          <div class="kolom-bawah d-flex justify-content-around align-items-center">
            <?php nextprev(); ?>
            <div class="tombol-show-comment ml-2 p-2 tablinks" onclick="openTab(event, 'Komentar')">Show Comments</div>
          </div>
        </div>

        <div id="Komentar" class="tabcontent bg-white col mt-4 p-4 p-sm-5">
          <?php comments_template(); ?>
        </div><!-- #Komentar -->
      </article><!-- post-<?php the_ID(); ?> -->

    </div><!-- #primary -->
  </div><!-- .row -->
</main><!-- #badan -->

<?php endwhile; else : endif;
get_footer(); ?>
