<?php
/*
Template Name: Genre List
*/
?>
<?php get_header(); ?>

<style>
  .darkmode {
    display: none !important;
  }
  .genre-list > li {
    padding-left: 10px;
    padding-right: 10px;
  }
  a.genres-title {
    font-size: 18px;
    text-align: center;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 3px;
    background: var(--opacity-black);
    border-radius: 4px;
    text-decoration: none;
    position: relative;
    transition: all .2s ease-in-out;
    color: var(--color-text);
  }
  a.genres-title:before {
    content: '';
    border: 1px solid var(--color-primary);
    opacity: .5;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    margin: 10px;
  }
  a.genres-title:hover {
    background: var(--opacity-black-dark);
    color: var(--color-primary) !important;
  }

  @media only screen and (max-width: 768px) {
    a.genres-title {
      font-size: 15px;
      font-weight: 600;
      letter-spacing: 2px;
    }
  }
</style>

<div class="container p-4">
  <?php the_title( '<h1 class="entry-title h3 mb-3 color-primary">', '</h1>' ); ?>
  <ul class="genre-list row ls-none p-1 mb-0">
  <?php $args = array('orderby' => 'name', 'parent' => 0 );
  $taxonomies = get_terms( 'genres', $args );
  foreach ( $taxonomies as $taxonomy ) {
    echo '
    <li class="col-6 col-sm-4 mb-3">
      <a class="genres-title p-3 p-md-4 d-flex align-items-center justify-content-center" href="' . get_category_link( $taxonomy->term_id ) . '">' . $taxonomy->name . '</a>
    </li>
    ';
  } ?>
</ul>
</div>

<script>
  function $(el) {
    return document.querySelector(el)
  }
  
  if (localStorage.getItem("theme") == "dark") {} else {
    $("body").classList.toggle("dark");
  }
</script>
<?php get_footer(); ?>
