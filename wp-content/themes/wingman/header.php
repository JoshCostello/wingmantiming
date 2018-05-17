<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    <?php if(defined('GOOGLE_ANALYTICS_API_KEY')): ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GOOGLE_ANALYTICS_API_KEY ?>"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', '<?php echo GOOGLE_ANALYTICS_API_KEY; ?>');
        </script>
    <?php endif; ?>

</head>

<body <?php body_class(); ?>>
    <a class="visually-hidden" href="#content"><?php _e( 'Skip to content', 'wingman' ); ?></a>
    <header class="site__header">
        <div class="site__header-inner">
            <a class="brand brand__link" href="<?php bloginfo('url') ?>">
                <img class="brand__logo" src="<?php bloginfo('template_url'); ?>/images/logo.svg" alt="">
            </a>

            <nav class="site__nav site__nav--main site__nav--closed">
              <?php bem_menu('main_nav', 'site-menu', 'site-menu--main'); ?>
            </nav>

            <button class="nav-ui" id="menu-toggle">
                <span class="nav-ui__bar"></span>
                <span class="nav-ui__bar"></span>
            </button>
        </div>
    </header>

    <div id="content">