<?php

/*
 * shortcode to create a sitemap
 * optional attributes -- exclude: comma separated list of page ids to exclude
 * example: [sitemap exclude="3,10,12"]
 */
function sitemap_shortcode( $atts ) {
    $all_pages = wp_list_pages('title_li=&echo=0&exclude='.$atts['exclude']);
    return '<ul class="sitemap">'.$all_pages.'</ul>';
}
add_shortcode( 'sitemap', 'sitemap_shortcode' );


/*
 * Global Items
 * attributes -- item: value of acf field to get from site globals
 * example -- [global item="phone"]
 */
function global_shortcode ($atts) {
  if (isset($atts['item'])) {
    return get_field($atts['item'], 'options');
  }
}
add_shortcode('global', 'global_shortcode', 10);
