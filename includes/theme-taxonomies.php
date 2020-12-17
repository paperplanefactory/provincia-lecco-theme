<?php
// menu iniziale con voci ad espansione dalla 5 in poi - per pagine
function intro_menu_list_cpt_items( $listing_page_cpt_listed ) {
  $args_intro_menu = array(
    'post_type' => $listing_page_cpt_listed,
    'posts_per_page' => -1,
    'orderby'    => 'menu_order',
  );
  $my_intro_menu = get_posts( $args_intro_menu );
  if ( !empty ( $my_intro_menu ) ) {
    $my_intro_menu_items = 0;
    $my_intro_menu_output = '<ul class="page-opening-menu page-opening-menu-js compact">';
    foreach ( $my_intro_menu as $post ) : setup_postdata ( $post );
    $my_intro_menu_items ++;
    if ( $my_intro_menu_items == 6) {
      $my_intro_menu_output .= '<div>';
    }
    $my_intro_menu_output .= '<li><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    endforeach; wp_reset_postdata();
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '</div>';
    }
    $my_intro_menu_output .= '</ul>';
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '<button onclick="pageListMenuControl(this)" class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu" data-collapsed="Espandi voci di menu" data-expanded="Comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

// menu iniziale per sottopagine con voci ad espansione dalla 5 in poi - per pagine
function intro_menu_list_subpage_items() {
  global $post;
  $args_intro_menu = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'orderby'    => 'menu_order',
  );
  $my_intro_menu = get_posts( $args_intro_menu );
  if ( !empty ( $my_intro_menu ) ) {
    $my_intro_menu_items = 0;
    $my_intro_menu_output = '<h6 class="allupper alternate-h6">Aree in '.get_the_title().'</h6>';
    $my_intro_menu_output .= '<ul class="page-opening-menu page-opening-menu-js compact">';
    foreach ( $my_intro_menu as $post ) : setup_postdata ( $post );
    $my_intro_menu_items ++;
    if ( $my_intro_menu_items == 6) {
      $my_intro_menu_output .= '<div>';
    }
    $my_intro_menu_output .= '<li><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'" aria-label="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    endforeach; wp_reset_postdata();
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '</div>';
    }
    $my_intro_menu_output .= '</ul>';
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '<button onclick="pageListMenuControl(this)" class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu" data-collapsed="Espandi voci di menu" data-expanded="Comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

// menu iniziale per pagine genitore con voci ad espansione dalla 5 in poi - per pagine
function intro_menu_list_parent_subpage_items() {
  global $post;
  $page_parent = wp_get_post_parent_id( $post->ID );
  $args_intro_menu = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $page_parent,
    'orderby'    => 'menu_order',
  );
  $my_intro_menu = get_posts( $args_intro_menu );
  if ( !empty ( $my_intro_menu ) ) {
    $my_intro_menu_items = 0;
    $my_intro_menu_output = '<h5 class="allupper">Aree in '.get_the_title($page_parent).'</h5>';
    $my_intro_menu_output .= '<ul class="page-opening-menu page-opening-menu-js compact">';
    foreach ( $my_intro_menu as $post ) : setup_postdata ( $post );
    $my_intro_menu_items ++;
    if ( $my_intro_menu_items == 6) {
      $my_intro_menu_output .= '<div>';
    }
    $my_intro_menu_output .= '<li><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'" aria-label="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    endforeach; wp_reset_postdata();
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '</div>';
    }
    $my_intro_menu_output .= '</ul>';
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '<button onclick="pageListMenuControl(this)" class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu" data-collapsed="Espandi voci di menu" data-expanded="Comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}
// menu iniziale con voci ad espansione dalla 5 in poi - per pagine
function intro_menu_list_parent_parent_subpage_items() {
  global $post;
  $page_parent = wp_get_post_parent_id( $post->ID );
  $page_parent_parent = wp_get_post_parent_id( $page_parent );
  $args_intro_menu = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $page_parent_parent,
    'orderby'    => 'menu_order',
    //'sort_order' => 'asc'
  );
  $my_intro_menu = get_posts( $args_intro_menu );
  if ( !empty ( $my_intro_menu ) ) {
    $my_intro_menu_items = 0;
    $my_intro_menu_output = '<h5 class="allupper">Aree in '.get_the_title($page_parent_parent).'</h5>';
    $my_intro_menu_output .= '<ul class="page-opening-menu page-opening-menu-js compact">';
    foreach ( $my_intro_menu as $post ) : setup_postdata ( $post );
    $my_intro_menu_items ++;
    if ( $my_intro_menu_items == 6) {
      $my_intro_menu_output .= '<div>';
    }
    $my_intro_menu_output .= '<li><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'" aria-label="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    endforeach; wp_reset_postdata();
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '</div>';
    }
    $my_intro_menu_output .= '</ul>';
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '<button onclick="pageListMenuControl(this)" class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu" data-collapsed="Espandi voci di menu" data-expanded="Comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

// menu iniziale con voci ad espansione dalla 5 in poi - per argomenti
function intro_menu_list_argomenti() {
  global $post;
  $args_intro_menu = array(
    'post_type' => 'argomento_cpt',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    //'orderby'    => 'menu_order',
    //'sort_order' => 'asc'
  );
  $my_intro_menu = get_posts( $args_intro_menu );
  if ( !empty ( $my_intro_menu ) ) {
    $my_intro_menu_items = 0;
    $my_intro_menu_output = '<ul class="page-opening-menu page-opening-menu-js compact">';
    foreach ( $my_intro_menu as $post ) : setup_postdata ( $post );
    $my_intro_menu_items ++;
    if ( $my_intro_menu_items == 6) {
      $my_intro_menu_output .= '<div>';
    }
    $my_intro_menu_output .= '<li><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'" aria-label="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    endforeach; wp_reset_postdata();
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '</div>';
    }
    $my_intro_menu_output .= '</ul>';
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '<button onclick="pageListMenuControl(this)" class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu" data-collapsed="Espandi voci di menu" data-expanded="Comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

// elenco di link argomento_tax relativi al singolo contenuto
// il link ha poi un redirect gestito dalle impostazioni del termine di argomento_tax
function list_argomenti_pills() {
  $terms_argomenti = get_the_terms( $post->ID , 'argomenti_tax' );
  if ( $terms_argomenti != null ) {
    //$output = '<h5 class="light">Argomenti</h5>';
    $output .= '<div class="tags-holder">';
    foreach( $terms_argomenti as $term_argomenti ) {
    $output .= '<a href="' . esc_url( get_term_link( $term_argomenti ) ) . '" class="tag-button filled-button" title="Vedi tutti i contenuti in '.$term_argomenti->name.'" aria-label="Vedi tutti i contenuti in '.$term_argomenti->name.'">'.$term_argomenti->name.'</a>';
    unset($term_activity);
    }
    $output .= '</div>';
    echo $output;
  }
}

// elenco di tutti i link argomento_tax
// il link ha poi un redirect gestito dalle impostazioni del termine di argomento_tax
function list_all_argomenti_pills() {
  $taxonomies = get_terms( array(
    'taxonomy' => 'argomenti_tax',
    'hide_empty' => true,
    //'number' => 10
  )
);

// Random order
shuffle($taxonomies);

// Get first $max items
$taxonomies = array_slice($taxonomies, 0, 10);

// Sort by name
usort($taxonomies, function($a, $b){
  return strcasecmp($a->name, $b->name);
});

foreach( $taxonomies as $tax ) {
  $output .= '<a href="' . esc_url( get_term_link( $tax ) ) . '" class="tag-button filled-button" title="Vedi tutti i contenuti in '.$tax->name.'" aria-label="Vedi tutti i contenuti in '.$tax->name.'">'.$tax->name.'</a>';
}
echo $output;

}


// elenco di tutti i link per le altre tassonomie relative al singolo contenuto
// il link ha poi un redirect gestito dalle impostazioni del termine di ogni tassonomia
function content_tax() {
  global $post;
  $post_type = get_post_type( $post->ID );
  switch ( $post_type ) {
    case 'amministrazione_cpt' :
    $taxonomy = 'amministrazione_tax';
    break;
    case 'post' :
    $taxonomy = 'category';
    break;
    case 'servizi_cpt' :
    $taxonomy = 'servizi_tax';
    break;
    case 'documenti_cpt' :
    $taxonomy = 'documenti_tax';
    break;
    case 'page' :
    $taxonomy = 'page_cpt';
    break;
  }
  if ( $taxonomy === 'page_cpt' ) {

  }
  else {
    //$parent_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );
    $parent_terms = wp_get_post_terms( $post->ID, $taxonomy );
    foreach ( $parent_terms as $pterm ) {
      $tax_icon = get_field('taxonomy_term_icon', $pterm->taxonomy . '_' . $pterm->term_id);
      $content_tax_list = '<h6 class="allupper">';
      $content_tax_list .= '<a href="' . get_term_link( $pterm ) . '" title="Archivio '.$pterm->name.'" aria-label="Archivio '.$pterm->name.'" class="'.$tax_icon.'">';
      $content_tax_list .= $pterm->name;
      $content_tax_list .= '</a>';
      $terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
      if ( !empty( $terms ) ) {
        $content_tax_list .= ' / ';
        $content_tax_list .= '<span class="child-cats">';
        foreach ( $terms as $term ) {
          //$sub_tax_icon = get_field('taxonomy_term_icon', $term->taxonomy . '_' . $term->term_id);
          //$content_tax_list .= '<a href="' . get_term_link( $term ) . '" title="Archivio '.$term->name.'" aria-label="Archivio '.$term->name.'" class="'.$sub_tax_icon.'">' . $term->name . '</a>';
          $content_tax_list .= '<a href="' . get_term_link( $term ) . '" title="Archivio '.$term->name.'" aria-label="Archivio '.$term->name.'">' . $term->name . '</a>';
        }
        $content_tax_list .=  '</span>';
      }
      $content_tax_list .=  '</h6>';
    }
  }

  echo $content_tax_list;
}

// elenco delle sole icone (mini) di tutti i link per le altre tassonomie relative al singolo contenuto
// il link ha poi un redirect gestito dalle impostazioni del termine di ogni tassonomia
function content_tax_icon() {
  global $post;
  $post_type = get_post_type( $post->ID );
  switch ( $post_type ) {
    case 'amministrazione_cpt' :
    $taxonomy = 'amministrazione_tax';
    break;
    case 'post' :
    $taxonomy = 'category';
    break;
    case 'servizi_cpt' :
    $taxonomy = 'servizi_tax';
    break;
    case 'documenti_cpt' :
    $taxonomy = 'documenti_tax';
    break;
  }
  $icon_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => 0, 'hide_empty' => false ) );
  foreach ( $icon_terms as $pterm ) {
    $tax_icon = get_field('taxonomy_term_icon', $pterm->taxonomy . '_' . $pterm->term_id);
    if ( $tax_icon != '' ) {
      $content_tax_list .= '<a href="' . get_term_link( $pterm ) . '" title="Archivio '.$pterm->name.'" aria-label="Archivio '.$pterm->name.'" class="green-link">';
      $content_tax_list .= '<span class="mini-icon '.$tax_icon.'">';
      $content_tax_list .= '</span>';
      $content_tax_list .= '</a>';
    }
  }

  echo $content_tax_list;
}

// elenco delle sole icone (maxi) di tutti i link per le altre tassonomie relative al singolo contenuto
// il link ha poi un redirect gestito dalle impostazioni del termine di ogni tassonomia
function content_tax_maxi_icon() {
  global $post;
  $post_type = get_post_type( $post->ID );
  switch ( $post_type ) {
    case 'amministrazione_cpt' :
    $taxonomy = 'amministrazione_tax';
    break;
    case 'post' :
    $taxonomy = 'category';
    break;
    case 'servizi_cpt' :
    $taxonomy = 'servizi_tax';
    break;
    case 'documenti_cpt' :
    $taxonomy = 'documenti_tax';
    break;
    case 'argomento_cpt' :
    $taxonomy = 'argomenti_tax';
    break;
  }

  $icon_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => 0, 'hide_empty' => false ) );
  foreach ( $icon_terms as $pterm ) {
    $tax_icon = get_field('taxonomy_term_icon', $pterm->taxonomy . '_' . $pterm->term_id);
    if ( $tax_icon != '' ) {
      $content_tax_list .= '<div>';
      $content_tax_list .= '<a href="' . get_term_link( $pterm ) . '" title="Archivio '.$pterm->name.'" aria-label="Archivio '.$pterm->name.'" class="green-link">';
      $content_tax_list .= '<span class="maxi-icon '.$tax_icon.'">';
      $content_tax_list .= '</span>';
      $content_tax_list .= '</a>';
      $content_tax_list .= '</div>';
    }
  }
  echo $content_tax_list;
}

// paginazione in single argomento_cpt
add_action( 'template_redirect', function() {
    if ( is_singular( 'argomento_cpt' ) ) {
        global $wp_query;
        $page = ( int ) $wp_query->get( 'page' );
        if ( $page > 1 ) {
            // convert 'page' to 'paged'
            $wp_query->set( 'page', 1 );
            $wp_query->set( 'paged', $page );
        }
        // prevent redirect
        remove_action( 'template_redirect', 'redirect_canonical' );
    }
}, 0 ); // on priority 0 to remove 'redirect_canonical' added with priority 10

// elenco delle voci di tassonomia per i filtri della pagina risultati di ricerca
function search_results_tax_listing( $tax_name, $tax_slug, $tax_search_parameter, $js_name ) {
  $taxonomies = get_terms( array(
    'taxonomy' => $tax_slug,
    'hide_empty' => true,
    'parent' => 0
  )
);
$output = '<div>';
$output .= '<button onclick="event.preventDefault(); pageSearchReultsControl(this)" id="page-search-cats-expander-'.$js_name.'" class="page-search-cats-expander page-search-cats-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi filtri di ricerca in '.$tax_name.'"><span class="icon-js icon-left-arrow-tip"></span><span class="text-js">'.$tax_name.'</span></button>';
$output .= '<ul id="page-search-cats-listing-'.$js_name.'" class="page-search-cats-listing page-search-cats-listing-js">';
foreach( $taxonomies as $tax ) {
  $output .= '<li>';
  $output .= '<button onclick="pageSearchElementChecker(this)" id="button-check-cat-'.$tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$tax->name.'"><span class="icon-js"></span>'.$tax->name.'</button>';
  $output .= '<input type="checkbox" name="'.$tax_search_parameter.'" value="'.$tax->term_id.'" id="hidden-input-set-'.$tax->term_id.'-js" class="hidden-input-set-js">';
  $child_taxonomies = get_terms( array(
    'taxonomy' => $tax_slug,
    'hide_empty' => true,
    'parent' => $tax->term_id
  )
);
if ( !empty( $child_taxonomies ) ) {
  $output .= '<ul>';
  foreach( $child_taxonomies as $child_tax ) {
    $output .= '<li>';
    $output .= '<button onclick="pageSearchElementChecker(this)" id="button-check-cat-'.$child_tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$child_tax->name.'"><span class="icon-js"></span>'.$child_tax->name.'</button>';
    $output .= '<input type="checkbox" name="'.$tax_search_parameter.'" value="'.$child_tax->term_id.'" id="hidden-input-set-'.$child_tax->term_id.'-js" class="hidden-input-set-js">';
    $output .= '</li>';
  }
  $output .= '</ul>';
}
  $output .= '</li>';
}
$output .= '</ul>';
$output .= '</div>';
echo $output;
}

// elenco delle voci di tassonomia argomenti_tax per i filtri della pagina risultati di ricerca
function search_results_argomenti_tax_listing() {
  $taxonomies = get_terms( array(
    'taxonomy' => 'argomenti_tax',
    'hide_empty' => true
  )
);
$my_intro_menu_items = 0;
$my_intro_menu_output = '<ul class="page-search-cats-listing page-opening-menu page-search-cats-listing-argomenti page-opening-menu-js compact">';
foreach( $taxonomies as $tax ) {
  $my_intro_menu_items ++;
  if ( $my_intro_menu_items == 6) {
    $my_intro_menu_output .= '<div>';
  }
  $my_intro_menu_output .= '<li>';
  $my_intro_menu_output .= '<button onclick="pageSearchElementChecker(this)" id="button-check-cat-'.$tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$tax->name.'"><span class="icon-js"></span>'.$tax->name.'</button>';
  $my_intro_menu_output .= '<input type="checkbox" name="argomenti_tax[]" value="'.$tax->term_id.'" id="hidden-input-set-'.$tax->term_id.'-js" class="hidden-input-set-js">';
  $my_intro_menu_output .= '</li>';
  }
  if ( $my_intro_menu_items > 5) {
    $my_intro_menu_output .= '</div>';
  }
  $my_intro_menu_output .= '</ul>';
  if ( $my_intro_menu_items > 5) {
    $my_intro_menu_output .= '<button onclick="event.preventDefault(); pageListMenuControl(this)" id="page-search-cats-listing-argomenti-rest-js" class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
  }
echo $my_intro_menu_output;
}

// elenco di tutte le pagine pubblicate per la pagina "mappa del sito"
function page_site_map() {
  $args_sitemap = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'orderby'    => 'menu_order',
    'post_parent' => 0
    //'sort_order' => 'asc'
  );
  $my_sitemap = get_posts( $args_sitemap );
  if ( !empty ( $my_sitemap ) ) {
    foreach ( $my_sitemap as $post ) : setup_postdata ( $post );
    $my_intro_menu_output .= '<h4><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'" aria-label="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></h4>';
    $args_child_itemap = array(
      'post_type' => 'page',
      'posts_per_page' => -1,
      'orderby'    => 'menu_order',
      'post_parent' =>$post->ID
    );
  $my_child_sitemap_pages = get_posts( $args_child_itemap );
  foreach ( $my_child_sitemap_pages as $post ) : setup_postdata ( $post );
  $my_intro_menu_output .= '<h5>- <a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'" aria-label="'.get_the_title($post->ID).'">'.get_the_title($post->ID).'</a></h5>';
  endforeach;
    endforeach; wp_reset_postdata();
  }
  echo $my_intro_menu_output;
}

// generazione dei bottoni con link alla pagina dei risultati di ricerca (utilizzato in single-argomento_cpt.php)
function from_argomento_to_search( $tax_queried, $tax_listed, $argomento_page_listing_term, $block_name, $page_name, $counter ) {
  $search_results_url = get_field( 'archives_url_ricerca', 'any-lang' );
  $category_query_multiple = get_terms(
    array(
      'taxonomy' => $tax_listed,
      'hide_empty' => false,
    )
  );

  foreach( $category_query_multiple as $category_tax ) {
    $category_query_longlist .= '&'.$tax_queried.'[]='.$category_tax->term_id.'';
  }
  echo $button = '<a href="'.$search_results_url.'?argomenti_tax[]='.$argomento_page_listing_term.''.$category_query_longlist.'" class="square-button green filled" title="Archivio '.$block_name.' in '.$page_name.'" aria-label="Archivio Amministrazione in <?php the_title(); ?>">Altro ('.$counter.')</a>';
}

// grande fiction - quando visualizzo un contenuto singolo aggiungo tramite JS la classe per la pagina corrente all'header
function current_page_from_single_cpt() {
  global $post;
  $post_type = get_post_type( $post->ID );
  switch ( $post_type ) {
    case 'amministrazione_cpt' :
    ?>
      <script type="text/javascript">
      $('#header .menu-item-282, #header-compact .menu-item-282').addClass('current-page-ancestor');
      </script>
    <?php
    break;
    case 'post' :
    ?>
      <script type="text/javascript">
      $('#header .menu-item-283, #header-compact .menu-item-283').addClass('current-page-ancestor');
      </script>
    <?php
    break;
    case 'servizi_cpt' :
    ?>
      <script type="text/javascript">
      $('#header .menu-item-284, #header-compact .menu-item-284').addClass('current-page-ancestor');
      </script>
    <?php
    break;
    case 'documenti_cpt' :
    ?>
      <script type="text/javascript">
      $('#header .menu-item-285, #header-compact .menu-item-285').addClass('current-page-ancestor');
      </script>
    <?php
    break;
  }
}
add_action('wp_footer', 'current_page_from_single_cpt');

// grande fiction - marco i filtri di ricerca nella pagina dei risultati di ricerca in base ai parametri URL presenti
function check_my_checkboxes() {
  if ( $_GET['amministrazione_tax'] ) {
    ?>
    <script type="text/javascript">
    $('#page-search-cats-expander-amministrazione').attr('aria-expanded', true);
    $('#page-search-cats-expander-amministrazione').find('.icon-js').addClass('icon-expand').removeClass('icon-left-arrow-tip');
    $('#page-search-cats-listing-amministrazione').slideDown(150);
  </script>
  <?php
    foreach($_GET['amministrazione_tax'] as $item){
      ?>
      <script type="text/javascript">
      $('#button-check-cat-<?php echo $item; ?>-js').find('.icon-js').addClass('checked icon-check');
      $('#hidden-input-set-<?php echo $item; ?>-js').prop('checked', true);
    </script>
    <?php
    }
  }

  if ( $_GET['servizi_tax'] ) {
    ?>
    <script type="text/javascript">
    $('#page-search-cats-expander-servizi').attr('aria-expanded', true);
    $('#page-search-cats-expander-servizi').find('.icon-js').addClass('icon-expand').removeClass('icon-left-arrow-tip');
    $('#page-search-cats-listing-servizi').slideDown(150);
  </script>
  <?php
    foreach($_GET['servizi_tax'] as $item){
      ?>
      <script type="text/javascript">
      $('#button-check-cat-<?php echo $item; ?>-js').find('.icon-js').addClass('checked icon-check');
      $('#hidden-input-set-<?php echo $item; ?>-js').prop('checked', true);
    </script>
    <?php
    }
  }

  if ( $_GET['category_tax'] ) {
    ?>
    <script type="text/javascript">
    $('#page-search-cats-expander-novita').attr('aria-expanded', true);
    $('#page-search-cats-expander-novita').find('.icon-js').addClass('icon-expand').removeClass('icon-left-arrow-tip');
    $('#page-search-cats-listing-novita').slideDown(150);
  </script>
  <?php
    foreach($_GET['category_tax'] as $item){
      ?>
      <script type="text/javascript">
      $('#button-check-cat-<?php echo $item; ?>-js').find('.icon-js').addClass('checked icon-check');
      $('#hidden-input-set-<?php echo $item; ?>-js').prop('checked', true);
    </script>
    <?php
    }
  }

  if ( $_GET['documenti_tax'] ) {
    ?>
    <script type="text/javascript">
    $('#page-search-cats-expander-documenti').attr('aria-expanded', true);
    $('#page-search-cats-expander-documenti').find('.icon-js').addClass('icon-expand').removeClass('icon-left-arrow-tip');
    $('#page-search-cats-listing-documenti').slideDown(150);
  </script>
  <?php
    foreach($_GET['documenti_tax'] as $item){
      ?>
      <script type="text/javascript">
      $('#button-check-cat-<?php echo $item; ?>-js').find('.icon-js').addClass('checked icon-check');
      $('#hidden-input-set-<?php echo $item; ?>-js').prop('checked', true);
    </script>
    <?php
    }
  }

  if ( $_GET['argomenti_tax'] ) {
    ?>
    <script type="text/javascript">
    $('#page-search-cats-listing-argomenti-rest-js').attr('aria-expanded', true);
    $('#page-search-cats-listing-argomenti-rest-js').find('.icon-js').removeClass('icon-expand').addClass('icon-collapse-1');
    $('#page-search-cats-listing-argomenti-rest-js').prev('.page-opening-menu-js').find('div').slideDown(150);
    $('#page-search-cats-listing-argomenti-rest-js').find('.text-js').text('Nascondi');
  </script>
  <?php
    foreach($_GET['argomenti_tax'] as $item){
      ?>
      <script type="text/javascript">
      $('#button-check-cat-<?php echo $item; ?>-js').find('.icon-js').addClass('checked icon-check');
      $('#hidden-input-set-<?php echo $item; ?>-js').prop('checked', true);
    </script>
    <?php
    }
  }
}
add_action('wp_footer', 'check_my_checkboxes');

// aggiungo filtro per listing in back end amministrazione_cpt / amministrazione_tax
function amministrazione_tax_filter_amministrazione_cpt() {
	global $typenow;

	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('amministrazione_tax');

	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'amministrazione_cpt' ){

		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Mostra tutte $tax_name</option>";
				foreach ($terms as $term) {
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'amministrazione_tax_filter_amministrazione_cpt' );





// aggiungo filtro per listing in back end documenti_cpt / documenti_tax
function documenti_tax_filter_documenti_cpt() {
	global $typenow;

	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('documenti_tax');

	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'documenti_cpt' ){

		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Mostra tutte $tax_name</option>";
				foreach ($terms as $term) {
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'documenti_tax_filter_documenti_cpt' );
