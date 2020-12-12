<?php

if (!function_exists('etheme_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function etheme_setup() {
        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain('etheme');

        // Add default posts and comments RSS feed links to head.
	    add_theme_support( 'automatic-feed-links' );


        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus(
            array(
                'main_menu'   => esc_html__('Main Menu', 'etheme'),
                'footer_menu' => esc_html__('Footer Menu', 'etheme'),
            )
        );

        /**
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    }
}
add_action('after_setup_theme', 'etheme_setup');

// pingback url auto-discovery header for singularly identifiable articles.
add_action( 'wp_head', 'etheme_pingback_header' );
function etheme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' )) );
	}
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar Right', 'etheme'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'etheme'),
            'before_widget' => '<section id="%1$s" class="sidbox mb-3 mb-md-4 p-4 %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="h5 mb-3 widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action('widgets_init', 'theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function theme_assets()
{
    ## CSS
    wp_enqueue_style('reboot-style', get_template_directory_uri() . '/assets/css/reboot.css', array(), null);
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), null);

    ## JS
    wp_enqueue_script('theme-script', get_template_directory_uri() .'/assets/js/index.js', array(), null, true);

    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_assets');


function enqueue_select2_jquery()
{
    wp_register_style('select2css', '//cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css', false, '1.0', 'all');
    wp_register_script('select2', '//cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array('jquery'), '1.0', true);
    wp_enqueue_style('select2css');
    wp_enqueue_script('select2');
}
add_action('admin_enqueue_scripts', 'enqueue_select2_jquery');

// Ajax Search Series
add_action('wp_ajax_novel_id_post', 'novel_id_post_ajax_callback');
function novel_id_post_ajax_callback() {

    $return = array();

    $search_results = new WP_Query(array(
        's' => $_GET['q'],
        'post_status' => 'publish',
        'post_type' => 'novel',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => 25,
    ));

    if ($search_results->have_posts()) :
        while ($search_results->have_posts()) : $search_results->the_post();
            $title = (mb_strlen($search_results->post->post_title) > 70) ? mb_substr($search_results->post->post_title, 0, 69) . '...' : $search_results->post->post_title;
            $return[] = array($search_results->post->ID, $title);
        endwhile;
    endif;
    echo json_encode($return);
    die;
}

// Remove Category & Tags from post
function unregister_tags_categories()
{
    unregister_taxonomy_for_object_type('post_tag', 'post');
    unregister_taxonomy_for_object_type('category', 'post');
}
add_action('init', 'unregister_tags_categories');

// Remove Featured image from post
function remove_thumbnail_box()
{
    remove_meta_box('postimagediv', 'post', 'side');
}
add_action('do_meta_boxes', 'remove_thumbnail_box');

/**
 * Additional features to allow styling of the theme.
 */
require get_template_directory() . '/inc/set-functions.php';

/**
 * Requires the custom widgets
 */
require get_template_directory() . '/widgets/index.php';
