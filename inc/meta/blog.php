<?php
$prefix = "etheme_";

$meta_blog = [
  "cover" => "image_url",
  "url_direct" => "text",
];

function add_custom_meta_blog()
{
  add_meta_box(
    'blog_info',                // Unique ID
    'Blog Direct url',          // Box title
    'meta_info_blog_html',      // Content callback, must be of type callable
    'blog'                      // Post type
  );
}

function meta_info_blog_html($post)
{
    global $prefix, $meta_blog;
?>
    <table class="form-table">
      <tbody>   
        <?php foreach ($meta_blog as $key => $type) {
          $meta = $prefix . $key;
        ?> 
          <tr>
            <th scope="row">
              <label for="my-text-field"><?php echo ucfirst($key) ?></label>
            </th>
            <td>
              <?php if ($type == "image_url") { ?>
                <input type="text" name="<?php echo $meta ?>" id="<?php echo $meta ?>" value="<?php echo get_post_meta($post->ID, $meta, true) ?>" style="width: 90%" placeholder="Input URL here or Click Upload..." id="<?php echo $meta ?>"> <button type="button" class="button button-primary" id="<?php echo $meta ?>_btn">Select</button>
                <p style="color: #555;font-size: 95%;"><em>[input url] if you want to use an external image</em></p>
                <br>
                <script>
                  jQuery('#<?php echo $meta ?>_btn').click(function(e) {
                    e.preventDefault();

                    var custom_uploader = wp.media({
                        title: '<?php echo ucfirst($key) ?>',
                        button: {
                          text: 'Select Image'
                        },
                        multiple: false
                      })
                      .on('select', function() {
                        var attachment = custom_uploader.state().get('selection').first().toJSON();
                        jQuery('#<?php echo $meta ?>').val(attachment.url);
                      })
                      .open();
                  });
                </script>
              <?php } ?>
              <?php if ($type == "text") { ?>
                <input type="text" name="<?php echo $meta ?>" id="<?php echo $meta ?>" value="<?php echo get_post_meta($post->ID, $meta, true) ?>" style="width: 100%" placeholder="Input <?php echo $key ?>...">
                <br>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <style>
      #blog_info input{ max-width:300px; }
    </style>
<?php
}

add_action('add_meta_boxes', 'add_custom_meta_blog');

function save_postdata_blog($post_id)
{
  global $prefix, $meta_blog;
  foreach ($meta_blog as $key => $type) {
    $meta = $prefix . $key;
    if (array_key_exists($meta, $_POST)) {
      update_post_meta(
        $post_id,
        $meta,
        $_POST[$meta]
      );
    }
  }
}
add_action('save_post_blog', 'save_postdata_blog');
