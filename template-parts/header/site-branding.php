<?php
/**
 * Displays header site branding
 */
?>

<div class="site-branding d-flex justify-content-between align-items-center">

	<!-- <div class="site-branding-logo order-1"></div> -->

  <div class="site-branding-text position-center">
		<?php if ( is_front_page() ) : ?>
			<h1 class="site-title h2 mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<h2 class="site-title h2 mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
		<?php endif; ?>
    
		<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<p class="site-description d-none"><?php echo $description; ?></p>
		<?php endif; ?>
	</div><!-- .site-branding-text -->

	<div class="header-left order-first lh-0">
		<span id="openNav" class="icon menu">
			<svg viewBox="0 0 24 24"><path d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z"></path></svg>
		</span>
	</div><!-- .header-left -->
    
	<div class="header-right lh-0 d-flex">
		<span class="icon sercing" onclick="toggle('.searchbar', 'show')">
			<svg viewBox="0 0 24 24"><path d="M18.031 16.617l4.283 4.282l-1.415 1.415l-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9s9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7c-3.868 0-7 3.132-7 7c0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"></path></svg>
		</span>
		<span class="icon darkmode">
			<svg class="moon" viewBox="0 0 24 24"><path d="M11.38 2.019a7.5 7.5 0 1 0 10.6 10.6C21.662 17.854 17.316 22 12.001 22C6.477 22 2 17.523 2 12c0-5.315 4.146-9.661 9.38-9.981z" fill="currentColor"></path></svg>
			<svg class="sun" viewBox="0 0 24 24"><path d="M12 18a6 6 0 1 1 0-12a6 6 0 0 1 0 12zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636L5.636 7.05L3.515 4.93zM16.95 18.364l1.414-1.414l2.121 2.121l-1.414 1.414l-2.121-2.121zm2.121-14.85l1.414 1.415l-2.121 2.121l-1.414-1.414l2.121-2.121zM5.636 16.95l1.414 1.414l-2.121 2.121l-1.414-1.414l2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z" fill="currentColor"></path></svg>
		</span>
	</div><!-- .header-right -->
		
</div><!-- .site-branding -->