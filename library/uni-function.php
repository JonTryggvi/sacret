<?php 
  if(!function_exists('uni_partial')){
    function uni_partial($path, $args = [], $echo = true) {
      if (!empty($args)) {
        extract($args);
      }
      if ($echo) {
        include(locate_template($path . '.php'));
        return;
      }
      ob_start();
      include(locate_template($path . '.php'));
      return ob_get_clean();
    }
  }