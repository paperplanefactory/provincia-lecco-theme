<?php
// menu iniziale con voci ad espansione dalla 5 in poi - CPT
function intro_menu_list_cpt_items( $listing_page_cpt_listed ) {
  $args_intro_menu = array(
    'post_type' => $listing_page_cpt_listed,
    'posts_per_page' => -1,
    'orderby'    => 'menu_order',
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
    $my_intro_menu_output .= '<li><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    endforeach; wp_reset_postdata();
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '</div>';
    }
    $my_intro_menu_output .= '</ul>';
    if ( $my_intro_menu_items > 5) {
      $my_intro_menu_output .= '<button class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

// menu iniziale con voci ad espansione dalla 5 in poi
function intro_menu_list_subpage_items() {
  global $post;
  $args_intro_menu = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'orderby'    => 'menu_order',
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
      $my_intro_menu_output .= '<button class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

function intro_menu_list_parent_subpage_items() {
  global $post;
  $page_parent = wp_get_post_parent_id( $post->ID );
  $args_intro_menu = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $page_parent,
    'orderby'    => 'menu_order',
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
      $my_intro_menu_output .= '<button class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

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
      $my_intro_menu_output .= '<button class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}


function intro_menu_list_argomenti() {
  global $post;
  $args_intro_menu = array(
    'post_type' => 'argomento_cpt',
    'posts_per_page' => -1,
    'orderby'    => 'menu_order',
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
      $my_intro_menu_output .= '<button class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
    }

  }
  echo $my_intro_menu_output;
}

function list_argomenti_pills() {
  $terms_argomenti = get_the_terms( $post->ID , 'argomenti_tax' );
  if ( $terms_argomenti != null ) {
    $output = '<h5 class="light">Argomenti</h5>';
    $output .= '<div class="tags-holder">';
    foreach( $terms_argomenti as $term_argomenti ) {
    $output .= '<a href="' . esc_url( get_term_link( $term_argomenti ) ) . '" class="tag-button filled-button" title="Vedi tutti i contenuti in '.$term_argomenti->name.'" aria-label="Vedi tutti i contenuti in '.$term_argomenti->name.'">'.$term_argomenti->name.'</a>';
    unset($term_activity);
    }
    $output .= '</div>';
    echo $output;
  }
}

function list_all_argomenti_pills() {
  $taxonomies = get_terms( array(
    'taxonomy' => 'argomenti_tax',
    'hide_empty' => true
  )
);
foreach( $taxonomies as $tax ) {
  $output .= '<a href="' . esc_url( get_term_link( $tax ) ) . '" class="tag-button filled-button" title="Vedi tutti i contenuti in '.$tax->name.'" aria-label="Vedi tutti i contenuti in '.$tax->name.'">'.$tax->name.'</a>';
}
echo $output;

}


function all_categories( $page_taxonomy_slug ) {
  $taxonomies = get_terms( array(
    'taxonomy' => $page_taxonomy_slug,
    'hide_empty' => false
  )
);

if ( !empty( $taxonomies ) ) :
  foreach( $taxonomies as $category ) {
    $output .= '<a href="' . esc_url( get_term_link( $category ) ) . '" class="arrow-button allupper">'.$category->name.'</a>';
  }
  echo $output;
endif;
}


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
  }

  $parent_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );

foreach ( $parent_terms as $pterm ) {
  $tax_icon = get_field('taxonomy_term_icon', $pterm->taxonomy . '_' . $pterm->term_id);
  $content_tax_list = '<h6 class="allupper">';
  $content_tax_list .= '<a href="' . get_term_link( $pterm ) . '" title="Archivio '.$pterm->name.'" aria-label="Archivio '.$pterm->name.'" class="'.$tax_icon.'">';
  $content_tax_list .= $pterm->name;
  $content_tax_list .= '</a>';
  $terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
  if ( !empty( $terms ) ) {
    $content_tax_list .= ' > ';
    $content_tax_list .= '<span class="child-cats">';
    foreach ( $terms as $term ) {
      $sub_tax_icon = get_field('taxonomy_term_icon', $term->taxonomy . '_' . $term->term_id);
      $content_tax_list .= '<a href="' . get_term_link( $term ) . '" title="Archivio '.$term->name.'" aria-label="Archivio '.$term->name.'" class="'.$sub_tax_icon.'">' . $term->name . '</a>';
    }
    $content_tax_list .=  '</span>';
  }
  $content_tax_list .=  '</h6>';
}
echo $content_tax_list;
}









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

  $icon_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'hide_empty' => false ) );
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

// paginazione in single CPT
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


function search_results_amministrazione_tax_listing() {
  $taxonomies = get_terms( array(
    'taxonomy' => 'amministrazione_tax',
    'hide_empty' => true
  )
);
$output = '<div>';
$output .= '<button id="page-search-cats-expander-amministrazione" class="page-search-cats-expander page-search-cats-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi filtri di ricerca in Amministrazione"><span class="icon-js left-arrow-tip"></span><span class="text-js">Amministrazione</span></button>';
$output .= '<ul id="page-search-cats-listing-amministrazione" class="page-search-cats-listing page-search-cats-listing-js">';
foreach( $taxonomies as $tax ) {
  $output .= '<li>';
  $output .= '<button id="button-check-cat-'.$tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$tax->name.'"><span class="icon-js"></span>'.$tax->name.'</button>';
  $output .= '<input type="checkbox" name="amministrazione_tax[]" value="'.$tax->term_id.'" id="hidden-input-set-'.$tax->term_id.'-js" class="hidden-input-set-js">';
  $output .= '</li>';
}
$output .= '</ul>';
$output .= '</div>';
echo $output;
}

function search_results_servizi_tax_listing() {
  $taxonomies = get_terms( array(
    'taxonomy' => 'servizi_tax',
    'hide_empty' => true
  )
);
$output = '<div>';
$output .= '<button id="page-search-cats-expander-servizi" class="page-search-cats-expander page-search-cats-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi filtri di ricerca in Servizi"><span class="icon-js left-arrow-tip"></span><span class="text-js">Servizi</span></button>';
$output .= '<ul id="page-search-cats-listing-servizi" class="page-search-cats-listing page-search-cats-listing-js">';
foreach( $taxonomies as $tax ) {
  $output .= '<li>';
  $output .= '<button id="button-check-cat-'.$tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$tax->name.'"><span class="icon-js"></span>'.$tax->name.'</button>';
  $output .= '<input type="checkbox" name="servizi_tax[]" value="'.$tax->term_id.'" id="hidden-input-set-'.$tax->term_id.'-js" class="hidden-input-set-js">';
  $output .= '</li>';
}
$output .= '</ul>';
$output .= '</div>';
echo $output;
}

function search_results_novita_tax_listing() {
  $taxonomies = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => true
  )
);
$output = '<div>';
$output .= '<button id="page-search-cats-expander-novita" class="page-search-cats-expander page-search-cats-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi filtri di ricerca in Novità"><span class="icon-js left-arrow-tip"></span><span class="text-js">Novità</span></button>';
$output .= '<ul id="page-search-cats-listing-novita" class="page-search-cats-listing page-search-cats-listing-js">';
foreach( $taxonomies as $tax ) {
  $output .= '<li>';
  $output .= '<button id="button-check-cat-'.$tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$tax->name.'"><span class="icon-js"></span>'.$tax->name.'</button>';
  $output .= '<input type="checkbox" name="category_tax[]" value="'.$tax->term_id.'" id="hidden-input-set-'.$tax->term_id.'-js" class="hidden-input-set-js">';
  $output .= '</li>';
}
$output .= '</ul>';
$output .= '</div>';
echo $output;
}

function search_results_documenti_tax_listing() {
  $taxonomies = get_terms( array(
    'taxonomy' => 'documenti_tax',
    'hide_empty' => true
  )
);
$output = '<div>';
$output .= '<button id="page-search-cats-expander-documenti" class="page-search-cats-expander page-search-cats-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi filtri di ricerca in Documenti e dati"><span class="icon-js left-arrow-tip"></span><span class="text-js">Documenti e dati</span></button>';
$output .= '<ul id="page-search-cats-listing-documenti" class="page-search-cats-listing page-search-cats-listing-js">';
foreach( $taxonomies as $tax ) {
  $output .= '<li>';
  $output .= '<button id="button-check-cat-'.$tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$tax->name.'"><span class="icon-js"></span>'.$tax->name.'</button>';
  $output .= '<input type="checkbox" name="documenti_tax[]" value="'.$tax->term_id.'" id="hidden-input-set-'.$tax->term_id.'-js" class="hidden-input-set-js">';
  $output .= '</li>';
}
$output .= '</ul>';
$output .= '</div>';
echo $output;
}

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
  $my_intro_menu_output .= '<button id="button-check-cat-'.$tax->term_id.'-js" class="button-check-cat-js button-appearance-normalizer button-typo-normalizer" aria-label="Filtra risultati per la categoria '.$tax->name.'"><span class="icon-js"></span>'.$tax->name.'</button>';
  $my_intro_menu_output .= '<input type="checkbox" name="argomenti_tax[]" value="'.$tax->term_id.'" id="hidden-input-set-'.$tax->term_id.'-js" class="hidden-input-set-js">';
  $my_intro_menu_output .= '</li>';
  }
  if ( $my_intro_menu_items > 5) {
    $my_intro_menu_output .= '</div>';
  }
  $my_intro_menu_output .= '</ul>';
  if ( $my_intro_menu_items > 5) {
    $my_intro_menu_output .= '<button id="page-search-cats-listing-argomenti-rest-js" class="page-opening-menu-expander page-opening-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Espandi/comprimi voci di menu"><span class="icon-js icon-expand"></span><span class="text-js">Espandi</span></button>';
  }



echo $my_intro_menu_output;


}

// genero un elenco di link che rimandano alla pagina di archivio della tassonomia
function call_all_cat_nome_tassonomia() {
  $terms_activity = get_the_terms( $post->ID , 'nome_tassonomia' );
  // Loop over each item since it's an array
  if ( $terms_activity != null ){
  foreach( $terms_activity as $term_activity ) {
  // Print the name method from $term which is an OBJECT
  $term_link = get_term_link( $term_activity );
  $activity_name = $term_activity->name;
  echo '<a href="' . $term_link . '">' . $activity_name . '</a>';
  unset($term_activity);
  } }
}

// la richiamo in pagina con "if (function_exists('call_all_cat_nome_tassonomia')) { call_all_cat_nome_tassonomia(); }
