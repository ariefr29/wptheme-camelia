<?php
/**
 * Define all your custom post type here.
 */


//  Novel Post type
function novel() {
  $labels = array(
    'name'               => 'Novel Series',
    'singular_name'      => 'Novel',
    'menu_name'          => 'Novel Series',
    'name_admin_bar'     => 'Novel',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Novel',
    'new_item'           => 'New Novel',
    'edit_item'          => 'Edit Novel',
    'view_item'          => 'View Novel',
    'all_items'          => 'All Novel',
    'search_items'       => 'Search Novel',
    'parent_item_colon'  => 'Parent Novel:',
    'not_found'          => 'No Novel found.',
    'not_found_in_trash' => 'No Novel found in Trash.'
  );

  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'rewrite'       => array('slug' => 'novel'),
    'has_archive'   => true,
    'menu_position' => 2,
    'menu_icon'     => 'dashicons-book',
    'supports'      => array('title', 'editor', 'author', 'thumbnail', 'comments'),
  );
  register_post_type('novel', $args);
}
add_action('init', 'novel');

//  Blog Post type
function blog() {
  $labels = array(
    'name'               => 'Blog Post',
    'singular_name'      => 'Blog',
    'menu_name'          => 'Blog Post',
    'name_admin_bar'     => 'Blog',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Blog',
    'new_item'           => 'New Blog',
    'edit_item'          => 'Edit Blog',
    'view_item'          => 'View Blog',
    'all_items'          => 'All Blog',
    'search_items'       => 'Search Blog',
    'parent_item_colon'  => 'Parent Blog:',
    'not_found'          => 'No Blog found.',
    'not_found_in_trash' => 'No Blog found in Trash.'
  );

  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'rewrite'       => array('slug' => 'blog'),
    'has_archive'   => true,
    'menu_position' => 2,
    'menu_icon'     => 'dashicons-welcome-write-blog',
    'supports'      => array('title', 'editor', 'author', 'thumbnail', 'comments'),
  );
  register_post_type('blog', $args);
}
add_action('init', 'blog');