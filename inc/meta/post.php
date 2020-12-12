<?php
$prefix = "etheme_";

$meta_post = [
  "chapter" => "text",
  "novel" => "ajax_select",
];

function add_custom_meta_post()
{
  add_meta_box(
    'post_info',                // Unique ID
    'Novel Information',       // Box title
    'meta_info_post_html',      // Content callback, must be of type callable
    'post'                      // Post type
  );
}

function meta_info_post_html($post)
{
  global $prefix, $meta_post;
?>
    <table class="form-table">
      <tbody>
        <?php foreach ($meta_post as $key => $type) {
          $meta = $prefix . $key;
        ?>
          <tr>
            <th scope="row">
              <label for="my-text-field"><?php echo ucfirst($key) ?></label>
            </th>
            <td>
              <?php if ($type == "text") { ?>
                <input type="text" name="<?php echo $meta ?>" id="<?php echo $meta ?>" value="<?php echo get_post_meta($post->ID, $meta, true) ?>" style="width: 100%" placeholder="Input <?php echo $key ?>...">
                <br>
              <?php } ?>
              <?php if ($type == "ajax_select") { ?>
                <select name="<?php echo $meta; ?>" id="<?php echo $meta; ?>" style="width: 100%;">
                  <option value="">Select Novel...</option>
                  <?php
                  $selected = get_post_meta($post->ID, $meta, true);
                  if ($selected) {
                    echo "<option value='" . $selected . "' selected>" . get_the_title($selected) . "</option>";
                  }
                  ?>
                </select>
                <script>
                  jQuery(document).ready(function() {
                    jQuery('#<?php echo $meta; ?>').select2({
                      ajax: {
                        url: ajaxurl,
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                          return {
                            q: params.term,
                            action: 'novel_id_post'
                          };
                        },
                        processResults: function(data) {
                          var options = [];
                          if (data) {

                            jQuery.each(data, function(index, text) {
                              options.push({
                                id: text[0],
                                text: text[1]
                              });
                            });

                          }
                          return {
                            results: options
                          };
                        },
                      },
                    });
                  })
                </script>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
<?php
}

add_action('add_meta_boxes', 'add_custom_meta_post');

function save_postdata_post($post_id)
{
  global $prefix, $meta_post;
  foreach ($meta_post as $key => $type) {
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
add_action('save_post_post', 'save_postdata_post');
