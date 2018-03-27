<?php

$theme_includes = [
'inc/theme_support.php',
// 'inc/aq_resizer.php',
'inc/acf_layout.php',
'inc/acf_customization.php',
// 'inc/custom_post_types.php',
// 'inc/custom_toolbar.php',
'inc/bem_nav_walker.php',
'inc/gravity_forms.php',
'inc/hex2rgba.php',
'inc/shortcodes.php',
'inc/setup.php',
];


foreach ($theme_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
