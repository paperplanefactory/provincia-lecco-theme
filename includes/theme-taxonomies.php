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
    $output = '<div class="tags-holder">';
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
  }
  $terms = wp_get_post_terms( $post->ID, $taxonomy );
  foreach ( $terms as $term ) {
    // this gets the parent of the current post taxonomy
    if ( $term->parent == 0 ) {
      $myparent = $term;
    }
  }
  //echo ''.$myparent->name.'';
  // Right, the parent is set, now let's get the children
  foreach ( $terms as $term ) {
    // this ignores the parent of the current post taxonomy
    if ( $term->parent != 0 ) {
      $child_term = $term; // this gets the children of the current post taxonomy
      $term_link = get_term_link( $child_term );
      $tax_icon = get_field('taxonomy_term_icon', $child_term->taxonomy . '_' . $child_term->term_id);
      //echo ''.$child_term->name.'';
      //echo $tax_icon;
      echo '<h6 class="allupper"><a href="'.$term_link.'" title="Archivio '.$child_term->name.'" aria-label="Archivio '.$child_term->name.'" class="'.$tax_icon.'">'.$child_term->name.'</a></h6>';
    }
    else {
      $child_term = $term; // this gets the children of the current post taxonomy
      $term_link = get_term_link( $child_term );
      $tax_icon = get_field('taxonomy_term_icon', $child_term->taxonomy . '_' . $child_term->term_id);
      //echo ''.$child_term->name.'';
      //echo $tax_icon;
      echo '<h6 class="allupper"><a href="'.$term_link.'" title="Archivio '.$child_term->name.'" aria-label="Archivio '.$child_term->name.'" class="'.$tax_icon.'">'.$child_term->name.'</a></h6>';
    }
  }
}







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
