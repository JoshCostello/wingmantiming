<?php

// ==========================================================================
//    LOAD SCRIPTS
// ==========================================================================
function add_scripts() {
  if(!is_admin()) {
    wp_deregister_script("jquery");
    wp_register_script("jquery", "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js", false, '1.12.4', true);
    wp_enqueue_script("jquery");
    wp_enqueue_script("app", get_template_directory_uri()."/dist/scripts/app.js", array("jquery"), false, true);
    // wp_enqueue_script("media-check", get_template_directory_uri()."/js/plugins/media-check.js", array("jquery"), false, true);
    // wp_enqueue_script("nav", get_template_directory_uri()."/js/nav.js", array("media-check"), false, true );
    // wp_enqueue_script("lazyload-images", get_template_directory_uri()."/js/min/lazyload-images.js", null, false, true );
  }

  //load for admin and frontend
  if (defined('GOOGLE_MAPS_API_KEY')) {
    // wp_enqueue_script('google-maps-api',  'https://maps.googleapis.com/maps/api/js?v=3&key='.GOOGLE_MAPS_API_KEY, null, false, true);
  }

}
add_action('wp_enqueue_scripts', 'add_scripts');


// REMOVE EMOJI ICONS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


// ==========================================================================
//    LOAD STYLES
// ==========================================================================
function add_stylesheets() {
  if (!is_admin()) {
    // wp_enqueue_style("gforms_formsmain_css", GFCommon::get_base_url() . "/css/formsmain.min.css", null, GFCommon::$version);
    // wp_enqueue_style('master', get_template_directory_uri().'/css/master.css', array('gforms_formsmain_css'), '1.0.0', 'all');
    wp_enqueue_style('master', get_template_directory_uri().'/dist/css/app.css', null, '1.0.0', 'all');
  }
}
add_action('wp_enqueue_scripts', 'add_stylesheets', 99);  //priority added so theme styles are loaded after plugins


// ==========================================================================
//    MENUS
// ==========================================================================
function register_nav() {
    register_nav_menu('main_nav',__( 'Main Menu' ));
    register_nav_menu('util_nav',__( 'Utility Menu' ));
    register_nav_menu('footer_nav',__( 'Footer Menu' ));
} add_action( 'init', 'register_nav' );


// ==========================================================================
//    WIDGETS
// ==========================================================================
function register_widget_area() {
    register_sidebar( array(
        'name'          => 'Blog Widgets',
        'id'            => 'blog-widgets',
        'before_widget' => '<div class="blog-widgets">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
} add_action( 'widgets_init', 'register_widget_area' );


// ==========================================================================
//    CUSTOM ADMIN LOGIN LOGO
// ==========================================================================
function custom_login_logo() {
    echo '
    <style type="text/css">
      <!--login screen background-->
      body.login {

      }
      <!--login screen logo -->
      .login h1 a {
        background-image: none;
        width: 100%;
        background-image: url("../images/logo.png");
      }
      <!-- links below login box -->
      .login #backtoblog a,
      .login #nav a {

      }
      .login #backtoblog a:hover,
      .login #nav a:hover,
      .login #backtoblog a:focus,
      .login #nav a:focus {

      }

      <!-- login button -->
      .login .button-primary,
      .login .button-primary:hover,
      .login .button-primary:active,
      .login .button-primary:focus {

      }
      .login .button-primary:hover,
      .login .button-primary:focus {

      }
      .login input[type=text]:focus,
      .login input[type=password]:focus,
      .login input[type=checkbox]:focus {

      }
    </style>';
}
add_action('login_head', 'custom_login_logo');

// Changes the link of the logo on the login page
function custom_login_link() {
  return get_bloginfo('url');
}
add_filter('login_headerurl','custom_login_link');



// ==========================================================================
//  RESET SOME WORDPRESS DEFAULTS
// ==========================================================================

/*
 * when oembed is youtube or vimeo,
 * wrap code in a class to make it responsive.
 * otherwise just return the typical embed code
 */
function custom_oembed_filter($html, $url, $attr, $post_ID) {
    if(strpos($url,'youtube') !== false || strpos($url,'youtu.be') !== false || strpos($url,'vimeo') !== false) {
        return '<div class="flexible-video">'.$html.'</div>';
    }
    else {
        return $html;
    }
}
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

/*
 * by default, images are set to link to the attachment,
 * this resets the default so images are not links
 */
function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );

    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);


//remove welcome screen
remove_action('welcome_panel', 'wp_welcome_panel');

//hide wordpress version
function wpb_remove_version() {
  return '';
}
add_filter('the_generator', 'wpb_remove_version');


//change dashboard footer text
function remove_footer_admin () {
  echo '<a href="http://www.joshuacostello.com" target="_blank">Joshua Costello</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');


// ==========================================================================
//  USEFUL FUNCTIONS
// ==========================================================================

function get_the_slug() {
    $slug = basename(get_permalink());
    return $slug;
}

function get_top_level_parent_slug() {
    global $post;
    $parent = array_reverse(get_post_ancestors($post->ID));
    $first_parent = get_page($parent[0]);
    return $first_parent->post_name;
}

function get_the_parent_slug() {
    global $post;
    if($post->post_parent == 0) return '';
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
}

function is_blog() {
    global  $post;
    $posttype = get_post_type($post );
    return ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) && ( $posttype == 'post' ) ) ? true : false;
}

function add_blog_nav_active_class( $classes, $item ) {
    if ( is_blog() && $item->title == 'Blog' ) {
        $classes[] = 'current_page_item';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'add_blog_nav_active_class', 10, 2 );