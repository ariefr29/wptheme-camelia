<?php
/**
 * Define the class of your custom widget here
 */
class LatestWidget extends WP_Widget {
  //
}

/**
 * Populer Novel Bulanan
 */
class etheme_novel_popular extends WP_Widget {
  public function __construct() {
    // widget actual processes
    parent::WP_Widget(false,'#Novel - Popular Bulanan');
  }
  public function form( $instance ) {
    echo '
    <p><label for="'.$this->get_field_id('title').'">' . __('Title:') . '<br><input style="width:100%;" id="'.$this->get_field_id('title').'"  name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($instance['title']).'" /></label></p>
    <p><label for="'.$this->get_field_id('posts').'">' . __('Number of Posts:',  'widgets') . '<br><input style="width:100%;"  id="'.$this->get_field_id('posts').'" name="'.$this->get_field_name('posts').'" type="text" value="'.esc_attr($instance['posts']).'" /></label></p>
    ';
  }
  public function update( $new_instance, $old_instance ) {
    // processes widget options to be saved
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['posts'] = strip_tags($new_instance['posts']);
    return $instance;
  }
  public function widget( $args, $instance ) {
    extract($args);

    $title = $instance['title'];
    $num_post = $instance['posts'];
    echo $before_widget;
    if ( $title ) {
      echo $before_title . $title . $after_title;
    } else {
      echo $before_title . 'Populer Bulan Ini' . $after_title;
    }
    echo '<div class="popular-novel">';
    $popularpost = new WP_Query(
        array(
            'post_type' => 'novel',
            'posts_per_page' => $num_post,
            'orderby' => 'meta_value_num',
            'order'=> 'DESC',
            'meta_key' => 'wpb_post_views_count',
            'date_query' => array(
                array(
                    'year' => $today['year'],
                    'month' => $today['mon'],
                )
            ),
        )
    );
    while ( $popularpost->have_posts() ) : $popularpost->the_post();

    echo '<div class="popular-item d-flex align-items-center">';
      echo '<div class="col-auto p-0"><div class="thumb position-relative">';
        cover_image( 'thumbnail', true, $image_link=true );
      echo '</div></div>';

      echo '<div class="col mt-1 pr-0">';
        echo '<h2 class="entry-title mb-1"><a href="'. get_the_permalink() .'" class="kmz line-clamp-2" rel="bookmark">'. get_the_title() .'</a></h2>';
        echo '<div class="met">';
          echo get_post_meta(get_the_ID(), 'etheme_type_novel', true);
        echo '</div><!-- .met -->';
      echo '</div>';
    echo '</div><!-- .popular-item -->';
    
    endwhile;
    echo '</div><!-- .popular-novel -->';
    echo $after_widget;
  }
}


/**
 * Related posts
 * 
 * @global object $post
 * @param array $args
 * @return
 */
function etheme_related_post($args = array()) {
  global $post;

  // default args
  $args = wp_parse_args($args, array(
      'post_id' => !empty($post) ? $post->ID : '',
      'taxonomy' => 'category',
      'limit' => 3,
      'post_type' => !empty($post) ? $post->post_type : 'post',
      'orderby' => 'date',
      'order' => 'DESC'
  ));

  // check taxonomy
  if (!taxonomy_exists($args['taxonomy'])) {
      return;
  }

  // post taxonomies
  $taxonomies = wp_get_post_terms($args['post_id'], $args['taxonomy'], array('fields' => 'ids')); 
  if (empty($taxonomies)) {
      return;
  }

  // query
  $related_posts = get_posts(array(
      'post__not_in' => (array) $args['post_id'],
      'post_type' => $args['post_type'],
      'tax_query' => array(
          array(
              'taxonomy' => $args['taxonomy'],
              'field' => 'term_id',
              'terms' => $taxonomies
          ),
      ),
      'posts_per_page' => $args['limit'],
      'orderby' => $args['orderby'],
      'order' => $args['order']
  ));

  require_once(__DIR__ . '/related-post.php');

  wp_reset_postdata();
}