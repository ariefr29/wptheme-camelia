<?php

/**
 * Require all class of your custom widget below.
 * Note that the name of class should be in PascalCase
 */

require_once(__DIR__ . '/LatestWidget.php');

/**
 * Register all class of your custom widget below.
 */
function register_widgets()
{
    // register_widget('LatestWidget');
    register_widget( 'etheme_novel_popular' );
}

add_action('widgets_init', 'register_widgets');

