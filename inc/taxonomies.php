<?php
/**
 * Define all your custom taxonomy here.
 */


// Status
function status_tax()
{
  register_taxonomy(
    'status',
    array('novel'),
    array(
      'label' => 'Status',
      'show_ul' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'hierarchical' => false,
    )
  );
}
add_action('init', 'status_tax');

// Genre 
function genres()
{
  register_taxonomy(
    'genres',
    array('novel'),
    array(
      'label' => 'Genres',
      'show_ul' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'hierarchical' => false,
    )
  );
}
add_action('init', 'genres');

// Country / Negara
function country()
{
  register_taxonomy(
    'country',
    array('novel'),
    array(
      'label' => 'Country',
      'show_ul' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'hierarchical' => false,
    )
  );
}
add_action('init', 'country');

// Author(s)
function authors()
{
  register_taxonomy(
    'authors',
    array('novel'),
    array(
      'label' => 'Author(s)',
      'show_ul' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'hierarchical' => false,
    )
  );
}
add_action('init', 'authors');
