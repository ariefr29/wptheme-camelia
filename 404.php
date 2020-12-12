<?php get_header(); ?>

<style>
  .elm {
    text-align: center;
  }
  .\34 04 {
    font-size: 8rem;
    font-weight: 600;
  }
  .tombol-home {
    background: var(--color-primary);
    color: var(--color-white);
    font-size: 15px;
    padding: 1rem;
    font-weight: 600;
  }
</style>

<main class="container">
  <div class="elm p-5 mt-5 mb-5">
    <div class="404 lh-1 mb-4">404</div>
    <div class="text-not-found mb-4">Page not found</div>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
      <button class="btn tombol-home b-radius lh-1 mb-4">Go Home</button>
    </a>
  </div>
</main>

<?php get_footer(); ?>
