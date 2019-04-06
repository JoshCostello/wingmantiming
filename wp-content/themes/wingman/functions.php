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


add_filter('manage_meet_posts_columns', 'set_custom_edit_meet_columns');

function set_custom_edit_meet_columns($columns)
{
    $date = $columns['date'];
    unset($columns['date']);

    $columns['meet_date'] = __('Meet Date', 'wingman-meet-date');

    $columns['date'] = $date;

    return $columns;
}

add_action('manage_meet_posts_custom_column', 'custom_meet_column', 10, 2);

function custom_meet_column($column, $post_id)
{
    switch ($column) {
    // display the value of an ACF (Advanced Custom Fields) field
    case 'meet_date':
      echo get_field('start_date', $post_id);
      break;

  }
}

add_filter('manage_edit-meet_sortable_columns', 'set_custom_meet_sortable_columns');

function set_custom_meet_sortable_columns($columns)
{
    $columns['meet_date'] = 'meet_date';

    return $columns;
}

add_action('pre_get_posts', 'meet_custom_orderby');

function meet_custom_orderby($query)
{
    if (! is_admin()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('start_date' == $orderby) {
        $query->set('meta_key', 'start_date');
        $query->set('orderby', 'meta_value');
    }
}
