<?php if (get_option('set_theme_shortcut')=='yes') { ?>
<script>
  /**
   * Disable shortcut
   */
  document.onkeydown = function(e) {
    /* f12 */
    if(event.keyCode == 123) {
    return false;
    }
    /* ctrl + i */
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    return false;
    }
    /* ctrl + j */
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    return false;
    }
  }
</script>
<? } ?>