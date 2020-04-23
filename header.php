<?php
// Paperplane _blankTheme - template per header.
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#000000">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#000000">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#000000">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
wp_head();
global $acf_options_parameter;
if (function_exists('pll_the_languages')) {
  $acf_options_parameter = pll_current_language('slug');
}
else {
  $acf_options_parameter = 'any-lang';
}
global $header_wrapper;
global $mega_menu_wrapper;
$header_width = get_field( 'theme_header_width', 'option' );
if ( $header_width === 'full-width' ) {
  $header_wrapper = '';
  $mega_menu_wrapper = '';
}
if ( $header_width === 'contained-width' ) {
  $header_wrapper = 'wrapper-padded-intro';
  $mega_menu_wrapper = 'mega-menu-holder-contained';
}
global $footer_wrapper;
$footer_width = get_field( 'theme_footer_width', 'option' );
if ( $footer_width === 'full-width' ) {
  $footer_wrapper = '';
}
if ( $footer_width === 'contained-width' ) {
  $footer_wrapper = 'wrapper-padded-intro';
}
$static_bloginfo_stylesheet_directory = get_bloginfo('stylesheet_directory');
?>
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/favicon-16x16.png">
<link rel="manifest" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/ms-icon-144x144.png">
</head>

<body>

<div id="preheader"></div>
<header id="header" class="bg-3 txt-12 white-links paragraph-variant-holder">
  <div class="wrapper bg-2 header-first-stripe">
    <div class="wrapper-padded">
      <div class="<?php echo $header_wrapper; ?>">
        <?php
        if ( has_nav_menu( 'footer-menu' ) ) {
          wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'ul', 'menu_class' => 'header-menu-top' ) );
        }
        ?>
      </div>
    </div>
  </div>
  <div class="wrapper-padded">
    <div class="<?php echo $header_wrapper; ?>">
      <div id="header-structure">
        <div class="logo">
          <a href="<?php echo home_url(); ?>" rel="bookmark" title="homepage - <?php echo get_bloginfo( 'name' ); ?>" class="absl"></a>
        </div>
        <div class="side-head">
          <ul>
            <li>
              Seguici su
            </li>
            <?php while ( have_rows( 'global_socials', 'option' ) ) : the_row(); ?>
              <li class="header-social">
                <a href="<?php the_sub_field( 'global_socials_profile_url' ); ?>" target="_blank" aria-label="Visit <?php the_sub_field( 'global_socials_profile_url' ); ?>" rel="noopener">
                  <i class="<?php the_sub_field( 'global_socials_icona' ); ?>" aria-hidden="true"></i>
                </a>
              </li>
            <?php endwhile; ?>
            <li class="search-menu">
              <button class="activate-search activate-search-js">
                Cerca
                <div class="icon-hold">
                  <span class="icon-search"></span>
                </div>

              </button>
            </li>
            <li class="hamb-menu">
              <div type="button" aria-haspopup="true" aria-expanded="false" aria-label="Navigation" class="hambuger-element ham-activator">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
            </li>
          </ul>
        </div>
        <nav class="menu navi">
          <?php
          if ( has_nav_menu( 'header-menu' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'ul', 'menu_class' => 'header-menu header-menu-js' ) );
          }
          ?>
          <?php
          if ( has_nav_menu( 'header-menu' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'ul', 'menu_class' => 'header-menu head-navi-side' ) );
          }
          ?>
        </nav>
      </div>
    </div>
  </div>
</header>
<?php include( locate_template( 'template-parts/grid/mega-menu.php' ) ); ?>

<div id="head-overlay" class="hidden no-bg">
  <div class="scroll-opportunity">
    <div class="wrapper">
      <nav class="menu">
        <?php
        if ( has_nav_menu( 'overlay-menu-mobile' ) ) {
          wp_nav_menu( array( 'theme_location' => 'overlay-menu-mobile', 'container' => 'ul', 'menu_class' => 'overlay-menu-mobile-css overlay-menu-mobile-js' ) );
        }
        ?>
      </nav>

      <?php if ( have_rows( 'global_socials', 'option' ) ) : ?>
        <ul class="inline-socials">
          <?php while ( have_rows( 'global_socials', 'option' ) ) : the_row(); ?>
            <li>
              <a href="<?php the_sub_field( 'global_socials_profile_url' ); ?>" target="_blank" aria-label="Visit <?php the_sub_field( 'global_socials_profile_url' ); ?>" rel="noopener">
                <i class="<?php the_sub_field( 'global_socials_icona' ); ?>" aria-hidden="true"></i>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
