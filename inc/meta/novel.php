<?php
$prefix = "etheme_";

$meta_novel = [
  "cover" => "image_url",
  "original_title" => "text",
  "associated_names" => "text",
  "type_novel" => "text",
  "year" => "text",
  "source" => "text",
  "translate" => "text",
  "download_title" => "text",
  "download_box" => "wysiwyg",
];

function add_custom_meta_novel()
{
  add_meta_box(
    'novel_info',                 // Unique ID
    'Novel Information',          // Box title
    'meta_info_novel_html',      // Content callback, must be of type callable
    'novel'                      // Post type
  );
}

function meta_info_novel_html($post)
{
    global $prefix, $meta_novel;
?>
    <table class="form-table">
      <tbody>   
        <?php foreach ($meta_novel as $key => $type) {
          $meta = $prefix . $key;
        ?> 
          <tr <?php $a = ($key == "download_title") ? 'style="border-top: 2px dashed #aaa;"' : ''; echo $a; ?>>
            <th scope="row">
              <?php $a = ($key == "download_title") ? '<br><br>' : ''; echo $a; ?>
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
                <?php $a = ($key == "download_title") ? '<br><br>' : ''; echo $a; ?>
                <input type="text" name="<?php echo $meta ?>" id="<?php echo $meta ?>" value="<?php echo get_post_meta($post->ID, $meta, true) ?>" style="width: 100%" placeholder="Input <?php echo $key ?>...">
                <?php $a = ($key == "download_title") ? '<p style="color: #555;font-size: 95%;"><em>ex : PDF Download</em></p>' : '<br>'; echo $a; ?>
              <?php } ?>
              <?php if ($type == "wysiwyg") { ?>
                <?php wp_editor(get_post_meta($post->ID, $meta, true), $meta, [
                  "media_buttons" => false
                ]) ?>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <style>
      #novel_info input{ max-width:300px; }
    </style>
<?php
}

add_action('add_meta_boxes', 'add_custom_meta_novel');

function save_postdata_novel($post_id)
{
  global $prefix, $meta_novel;
  foreach ($meta_novel as $key => $type) {
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
add_action('save_post_novel', 'save_postdata_novel');
