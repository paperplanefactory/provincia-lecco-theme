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
<meta name="theme-color" content="#3499EF">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#3499EF">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#3499EF">
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
}
global $footer_wrapper;
$footer_width = get_field( 'theme_footer_width', 'option' );
if ( $footer_width === 'full-width' ) {
  $footer_wrapper = 'wrapper-padded-intro';
}
if ( $footer_width === 'contained-width' ) {
  $footer_wrapper = 'wrapper-padded-more';
}
$static_bloginfo_stylesheet_directory = get_bloginfo('stylesheet_directory');
global $today;
$today = date('Y-m-d H:i:s');
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
        if ( has_nav_menu( 'header-menu-above' ) ) {
          wp_nav_menu( array( 'theme_location' => 'header-menu-above', 'container' => 'ul', 'menu_class' => 'header-menu-top' ) );
        }
        ?>
      </div>
    </div>
  </div>
  <div class="wrapper-padded">
    <div class="<?php echo $header_wrapper; ?>">
      <div id="header-structure">
        <div class="logo">
          <a href="<?php echo home_url(); ?>" rel="bookmark" title="Homepage | Sito istituzionale della <?php echo get_bloginfo( 'name' ); ?>" class="absl"></a>
        </div>
        <div class="side-head">
          <ul>
            <?php if ( get_field( 'social_header', 'any-lang' ) == 1 ) : ?>
              <li class="header-social">
                Seguici su
              </li>
              <?php while ( have_rows( 'global_socials', 'option' ) ) : the_row(); ?>
                <li class="header-social">
                  <a href="<?php the_sub_field( 'global_socials_profile_url' ); ?>" target="_blank" aria-label="Visit <?php the_sub_field( 'global_socials_profile_url' ); ?>" rel="noopener">
                    <i class="<?php the_sub_field( 'global_socials_icona' ); ?>" aria-hidden="true"></i>
                  </a>
                </li>
              <?php endwhile; ?>
            <?php endif; ?>
            <li class="search-menu">
              <button class="activate-search activate-search-js button-appearance-normalizer" aria-label="Apri/chiudi pannello di ricerca" data-collapsed="Apri pannello di ricerca" data-expanded="Chiudi pannello di ricerca">
                <span class="lablel">Cerca</span>
                <div class="icon-hold">
                  <span class="icon-search"></span>
                </div>
              </button>
            </li>
            <li class="hamb-menu">
              <div type="button" aria-haspopup="true" aria-expanded="false" aria-label="Apri/chiudi il menu di navigazione" data-collapsed="Apri il menu di navigazione" data-expanded="Chiudi il menu di navigazione" class="hambuger-element ham-activator">
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
          if ( has_nav_menu( 'header-menu-left' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-menu-left', 'container' => 'ul', 'menu_class' => 'header-menu header-menu-js' ) );
          }
          ?>
          <?php
          if ( has_nav_menu( 'header-menu-right' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'container' => 'ul', 'menu_class' => 'header-menu head-navi-side' ) );
          }
          ?>
        </nav>
      </div>
    </div>
  </div>
</header>





<header id="header-compact" class="hidden bg-3 txt-12 white-links paragraph-variant-holder">
  <div class="wrapper-padded">
    <div class="<?php echo $header_wrapper; ?>">
      <div id="header-structure">
        <div class="logo">
          <a href="<?php echo home_url(); ?>" rel="bookmark" title="Homepage | Sito istituzionale della <?php echo get_bloginfo( 'name' ); ?>" class="absl"></a>
        </div>
        <nav class="menu navi">
          <?php
          if ( has_nav_menu( 'header-menu-left' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-menu-left', 'container' => 'ul', 'menu_class' => 'header-menu header-menu-js' ) );
          }
          ?>
          <?php
          if ( has_nav_menu( 'header-menu-right' ) ) {
            wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'container' => 'ul', 'menu_class' => 'header-menu head-navi-side' ) );
          }
          ?>
        </nav>
        <div class="side-head">
          <ul>
            <li class="search-menu">
              <button class="activate-search activate-search-js" aria-label="Apri/chiudi pannello di ricerca" data-collapsed="Apri pannello di ricerca" data-expanded="Chiudi pannello di ricerca">
                <span class="icon-search"></span>
              </button>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</header>





<div id="search-overlay" class="hidden bg-12" aria-expanded="false">
  <div class="scroll-opportunity">
    <div class="wrapper">
      <div class="wrapper-padded">
        <div class="<?php echo $header_wrapper; ?>">
          <div class="search-overlay-structure">
            <button class="search-overlay-title search-overlay-title-js button-appearance-normalizer" aria-label="Chiudi pannello di ricerca"><span class="icon-left-arrow"></span>Cerca</button>
            <div class="search-form overlay-form">
              <form action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" autocomplete="off">
                <label for="search-kw-header-input">Digita una parola chiave per la ricerca:</label>
                <input id="search-kw-header-input" type="text" name="search-kw" class="search-autocomplete search-input-kw-js" placeholder="Cerca informazioni, persone, servizi" aria-label="Digita una parola chiave per la ricerca" />
                <button type="submit" class="search-submit search-submit-js"><span class="icon-search" aria-label="Cerca nel sito"></span></button>
                <button class="search-erase search-erase-js" aria-label="Cancella il contenuto della casella di testo">x</button>
              </form>
              <div class="search-suggestion-area">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div id="head-overlay" class="hidden bg-3 txt-12 white-links paragraph-variant-holder">
  <div class="scroll-opportunity">
    <div class="wrapper">
      <div class="wrapper-padded">
        <div class="<?php echo $header_wrapper; ?>">
          <nav class="menu navi">
            <?php
            if ( has_nav_menu( 'header-menu-left' ) ) {
              wp_nav_menu( array( 'theme_location' => 'header-menu-left', 'container' => 'ul', 'menu_class' => 'header-menu header-menu-js' ) );
            }
            ?>
            <?php
            if ( has_nav_menu( 'header-menu-right' ) ) {
              wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'container' => 'ul', 'menu_class' => 'header-menu head-navi-side' ) );
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

          <div class="flex-hold flex-hold-4 margins-wide footer-block-2 lined-mobile">

            <div class="flex-hold-child">
              <?php the_field( 'informazioni_amministrazione_trasparente', $acf_options_parameter ); ?>
            </div>

            <div class="flex-hold-child">
              <?php the_field( 'informazioni_carta_dei_servizi', $acf_options_parameter ); ?>
            </div>

            <div class="flex-hold-child">
              <?php the_field( 'informazioni_contatti', $acf_options_parameter ); ?>
            </div>

            <div class="flex-hold-child">
              <?php the_field( 'informazioni_newsletter', $acf_options_parameter ); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$meta_query_avvisi = array(
  array(
    'key' => 'scadenza_avviso',
    'value' => $today,
    'compare' => '>=',
  ),
);
$args_avvisi = array(
  'post_type' => 'avviso_cpt',
  'posts_per_page' => 1,
  'meta_query' => $meta_query_avvisi,
);
$my_avvisi = get_posts( $args_avvisi );
if ( !empty ( $my_avvisi ) ) :
 ?>
 <?php foreach( $my_avvisi as $post ) : setup_postdata( $post ); ?>
   <?php include( locate_template( 'template-parts/grid/avviso.php' ) ); ?>
 <?php endforeach; wp_reset_postdata(); ?>
<?php endif; ?>
