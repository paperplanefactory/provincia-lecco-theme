<?php
// registro la gestione dei menu, esempio header e footer
function register_theme_menus() {
  register_nav_menus(
    array(
      'header-menu-left' => __( 'Header Menu Sinistra' ),
      'header-menu-right' => __( 'Header Menu Destra' ),
      'header-menu-above' => __( 'Header Menu Sopra' ),
      'footer-menu-amministrazione' => __( 'Footer Menu Amministrazione' ),
      'footer-menu-servizi' => __( 'Footer Menu Servizi' ),
      'footer-menu-novita' => __( 'Footer Menu Novità' ),
      'footer-menu-documenti' => __( 'Footer Menu Documenti' ),
      'footer-menu-legal' => __( 'Footer Menu Info Legali' ),
      //'overlay-menu-desktop' => __ ( 'Overlay Menu Desktop' ),
      'overlay-menu-mobile' => __ ( 'Overlay Menu Mobile' )
    )
  );
}
add_action( 'init', 'register_theme_menus' );

// necessita di ACF PRO - aggiunge un pannello per gestire ulteriori impostazioni del tema
if( function_exists('acf_add_options_page') ) {
  // gestione tema per admin
  $option_page = acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title' 	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability' 	=> 'update_core',
		'redirect' 	=> false
	));
  $parent = acf_add_options_page(array(
    'page_title' 	=> 'Impostazioni sito',
		'menu_title'	=> 'Impostazioni sito',
		'capability'	=> 'update_core',
		//'menu_slug' 	=> 'impostazioni-sito',
		//'redirect'		=> false
	));
  // social
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Gestione social',
		'menu_title' 	=> 'Gestione social',
		'parent_slug' 	=> $parent['menu_slug'],
	));

  // verifico che sia attivo Polylang
  if ( function_exists( 'PLL' ) ) {
    $langs_parameters = array(
      'hide_empty' => 0,
      'fields' => 'slug'
    );
    $languages = pll_languages_list($args);
  }
  else {
    $languages = array('any-lang');
  }
  foreach ( $languages as $lang ) {
    // gestione footer
    acf_add_options_sub_page( array (
      'page_title' => 'Gestione header/footer (' . strtoupper( $lang ) . ')',
      'menu_title' => __('Gestione header/footer (' . strtoupper( $lang ) . ')', 'text-domain'),
      'menu_slug'  => "gestione-footer-${lang}",
      'post_id'    => $lang,
      'parent_slug'     => $parent['menu_slug'],
    ) );
    // gestione archivi
    acf_add_options_sub_page( array (
      'page_title' => 'Gestione archivi (' . strtoupper( $lang ) . ')',
      'menu_title' => __('Gestione archivi (' . strtoupper( $lang ) . ')', 'text-domain'),
      'menu_slug'  => "gestione-archivi-${lang}",
      'post_id'    => $lang,
      'parent_slug'     => $parent['menu_slug'],
    ) );
  }
}

// show flamingo to editors
add_filter( 'flamingo_map_meta_cap', 'for_editors_flamingo_map_meta_cap' );
function for_editors_flamingo_map_meta_cap( $meta_caps ) {
	$meta_caps = array_merge( $meta_caps, array(
		'flamingo_edit_contacts' => 'edit_pages',
		'flamingo_edit_inbound_messages' => 'edit_pages',
	) );

	return $meta_caps;
}


add_action('admin_head', 'my_custom_acf_css');
function my_custom_acf_css() {
  echo '<style>
  [data-name*="choose_module"] {
    background-color: #2867c5 !important;
    color: #FFFFFF;
  }
  .acf-label.acf-accordion-title, .acf-label.acf-accordion-title:hover  {
    background-color: #989898 !important;
    color: #000000;
  }


  </style>';
}
