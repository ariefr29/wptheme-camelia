<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php if (get_option('set_head_code')) {
  echo get_option('set_head_code');
} ?>

<link rel="preconnect" href="https://fonts.gstatic.com">
<?php if (is_singular( 'post' )) { ?>
  <link href="https://fonts.googleapis.com/css2?family=Mali:ital,wght@0,400;0,600;1,400;1,600&family=Nunito:ital,wght@0,400;0,700;1,400;1,700&family=Zilla+Slab:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet"> 
<?php } ?>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<?php wp_head(); 
  include(TEMPLATEPATH . '/assets/css/stylekondisi.php'); 
  include(TEMPLATEPATH . '/assets/js/head.php'); 
?>
</head>

<?php 
// Anti Copy Paste
$nocopas = (get_option('set_theme_shortcut')=='yes') ? 'oncopy="return false" oncut="return false" oncontextmenu="return false"' : null ; 
?>
<body <?php echo $nocopas; ?>>
<!-- Start Condition When JS Disable -->
<noscript>
  <div class="notip p-4">
    <p>Javascript pada browser anda tidak aktif.</p>
    <p>Beberapa fungsi/fitur mungkin mengalami error. Untuk memperbaikinya harap aktifkan Javascript, lalu refresh kembali browser.</p>
  </div>
</noscript>
<!-- End Condition When JS Disable -->
<div id="bgsidemenu"></div> <!-- Slide hover background for menu -->

<header id="header" class="site-header <?php echo (is_singular( 'post' )) ? 'd-none': ''; ?> position-relative" role="banner">
  <div class="container position-relative p-2 p-md-3">
    <?php 
      get_template_part( 'template-parts/header/site', 'branding' );
      get_template_part( 'template-parts/header/navigation' );
      get_template_part( 'template-parts/header/sercing' ); 
    ?>
  </div><!-- .container -->
</header>
