<?php
/**
 * Define all your custom panel [themeSetting] here.
 */

add_action('admin_menu', 'erba_menu');
function erba_menu() {
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_menu_page('Configuration', 'E-Config', 'administrator','configuration', 'func_config', 'dashicons-admin-generic',9999 );
	add_action( 'admin_init', 'register_erba_settings' );
}

function register_erba_settings() {
	// GENERAL
	register_setting( 'ewb-setgen', 'set_theme_compres');
	register_setting( 'ewb-setgen', 'set_theme_shortcut');
  register_setting( 'ewb-setgen', 'set_main_info' );
  register_setting( 'ewb-setgen', 'set_color_header' );
  register_setting( 'ewb-setgen', 'set_color_background' );
  register_setting( 'ewb-setgen', 'set_color_primary' );
  register_setting( 'ewb-setgen', 'set_color_primary_dark' );
  register_setting( 'ewb-setgen', 'set_background_image' );
  register_setting( 'ewb-setgen', 'set_blog_display' );
  register_setting( 'ewb-setgen', 'set_blog_showpost' );
  register_setting( 'ewb-setgen', 'set_blog_orderby' );
  // ADS
	register_setting( 'ewb-setads', 'set_ads_header' );
	register_setting( 'ewb-setads', 'set_ads_sidebar' );
	register_setting( 'ewb-setads', 'set_ads_footer' );
  // advanced Settings
  register_setting( 'ewb-settings', 'set_head_code' );
  register_setting( 'ewb-settings', 'set_body_code' );
}

function func_config() {
	if (function_exists( 'wp_enqueue_media' )) {
		wp_enqueue_media();
	} else{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
?>
<div class="wrap">
  <form method="post" action="options.php">
    <div class='wrap-swap'>
      <h2><i class="dashicons dashicons-admin-generic" style="position: relative;top: -1px;"></i> Themes Configuration [V1]</h2>
      <div class="clear"></div>
    </div>

  <?php if( isset( $_GET[ 'tab' ] ) ){$active_tab = $_GET[ 'tab' ];}else{$active_tab = 'general' ;} ?>
  <h2 class="nav-tab-wrapper">
    <a href="?page=configuration&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?> <?php  if ($_GET['tab'] == null ) {echo 'nav-tab-active'; } ?>">General</a>
    <a href="?page=configuration&tab=ads" class="nav-tab <?php echo $active_tab == 'ads' ? 'nav-tab-active' : ''; ?>">Ads Options</a>
    <a href="?page=configuration&tab=advanced" class="nav-tab <?php echo $active_tab == 'advanced' ? 'nav-tab-active' : ''; ?>">Advanced Settings</a>
  </h2>
  <?php if( $active_tab == 'general' ) {
    settings_fields( 'ewb-setgen' );
    do_settings_sections( 'ewb-setgen' ); ?>
    <div class="main-config">
      <table class="form-table">
        <tr valign="top">
          <th scope="row">Theme setting</th>
          <td>
          <select name="set_theme_compres">
            <option disabled <?php if(get_option('set_theme_compres')==null) echo 'selected="selected"'; ?>>== Theme Compress ==</option>
            <option value="no" <?php if(get_option('set_theme_compres')=='no') echo 'selected="selected"'; ?>>No</option>
            <option value="yes" <?php if(get_option('set_theme_compres')=='yes') echo 'selected="selected"'; ?>>Yes</option>
          </select>
          <select name="set_theme_shortcut">
            <option disabled >== Anti Copy Paste ==</option>
            <option value="no" <?php if(get_option('set_theme_shortcut')=='no') echo 'selected="selected"'; ?>>Default</option>
            <option value="yes" <?php if(get_option('set_theme_shortcut')=='yes') echo 'selected="selected"'; ?>>Enable</option>
          </select>
          </td>
        </tr>
        <tr valign="top">
					<th scope="row">Custom Color</th>
					<td>
            <input type="text" name="set_color_header" size="10" placeholder="Header Color" value="<?php echo get_option('set_color_header'); ?>">
            <input type="text" name="set_color_background" size="10" placeholder="Background Color" value="<?php echo get_option('set_color_background'); ?>">
            <input type="text" name="set_color_primary" size="10" placeholder="Primary Color" value="<?php echo get_option('set_color_primary'); ?>">
            <input type="text" name="set_color_primary_dark" size="10" placeholder="Primary-hover Color" value="<?php echo get_option('set_color_primary_dark'); ?>">
					</td>
				</tr>
        <tr valign="top" class="btom">
					<th scope="row">Background Image</th>
					<td><input type="text" name="set_background_image" size="35" placeholder="url image" value="<?php echo get_option('set_background_image'); ?>"></td>
        </tr>
        <tr valign="top" class="btom">
          <th scope="row">Blog / Slideshow</th>
          <td>
          <select name="set_blog_display">
          <option disabled>== display ==</option>
            <option value="show" <?php if(get_option('set_blog_display')=='show') echo 'selected="selected"'; ?>>Show</option>
            <option value="none" <?php if(get_option('set_blog_display')=='none') echo 'selected="selected"'; ?>>None</option>
          </select>
          <input type="number" size="10" name="set_blog_showpost" value="<?php echo get_option('set_blog_showpost'); ?>" placeholder="3">
          <select name="set_blog_orderby">
            <option disabled>== order by ==</option>
            <option value="modified" <?php if(get_option('set_blog_orderby')=='modified') echo 'selected="selected"'; ?>>Modified</option>
            <option value="date" <?php if(get_option('set_blog_orderby')=='date') echo 'selected="selected"'; ?>>Date</option>
            <option value="rand" <?php if(get_option('set_blog_orderby')=='rand') echo 'selected="selected"'; ?>>Random</option>
          </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">Info Widget</th>
          <td rowspan="1"><textarea class="large-text code" name="set_main_info" rows="7"><?php echo get_option('set_main_info'); ?></textarea></td>
        </tr>
      </table>
    </div><!-- General -->
  <?php } elseif( $active_tab == 'ads' ) {
    settings_fields( 'ewb-setads' );
    do_settings_sections( 'ewb-setads' ); ?>
    <div class="main-config">
      <table class="form-table">
      <tr valign="top">
      <th scope="row">Ads Header </th>
      <td><textarea type="text/javascript" name="set_ads_header" rows="3" value="<?php echo esc_attr( get_option('set_ads_header') ); ?>" class="large-text code" placeholder="Place your ads code here"><?php echo esc_attr( get_option('set_ads_header') ); ?></textarea></td>
      </tr>
      <tr valign="top">
      <th scope="row">Ads Sidebar </th>
      <td><textarea type="text/javascript" name="set_ads_sidebar" rows="3" value="<?php echo esc_attr( get_option('set_ads_sidebar') ); ?>" class="large-text code" placeholder="Place your ads code here"><?php echo esc_attr( get_option('set_ads_sidebar') ); ?></textarea></td>
      </tr>
      <tr valign="top">
      <th scope="row">Ads Footer </th>
      <td><textarea type="text/javascript" name="set_ads_footer" rows="3" value="<?php echo esc_attr( get_option('set_ads_footer') ); ?>" class="large-text code" placeholder="Place your ads code here"><?php echo esc_attr( get_option('set_ads_footer') ); ?></textarea></td>
      </tr>
      </table>
    </div><!-- ads -->
  <?php } elseif( $active_tab == 'advanced' ) {
    settings_fields( 'ewb-settings' );
    do_settings_sections( 'ewb-settings' ); ?>
    <div class="main-config">
      <table class="form-table">
        <tr valign="top">
          <th scope="row">Head Code </th>
          <td><textarea type="text/javascript" name="set_head_code" rows="3" value="<?php echo esc_attr( get_option('set_head_code') ); ?>" class="large-text code" placeholder="Place your <head> code here"><?php echo esc_attr( get_option('set_head_code') ); ?></textarea></td>
        </tr>
        <tr valign="top">
          <th scope="row">Body code </th>
          <td><textarea type="text/javascript" name="set_body_code" rows="3" value="<?php echo esc_attr( get_option('set_body_code') ); ?>" class="large-text code" placeholder="Place your <body> code here"><?php echo esc_attr( get_option('set_body_code') ); ?></textarea></td>
        </tr>
      </table>
    </div>
  <?php } /*End activeTab == post */ submit_button(); ?>
  </form>

  <style type='text/css'>
    .main-config{background:#FFF;padding:0 25px;margin-top:10px;border:1px solid #ddd}
    .wrap-swap{margin:20px auto 30px}
    .wrap-swap>h2{margin:0;text-transform:uppercase;font-size:21px;padding-top:5px}
    input,select{margin-right:1%;min-width:20%;padding-top:2px !important;padding-bottom:2px !important;border-radius: 2px !important;border-color: #afafaf !important}
    .btom{border-bottom:1px solid #ddd}
  </style>

</div><!-- .wrap -->

<?php } ?>
