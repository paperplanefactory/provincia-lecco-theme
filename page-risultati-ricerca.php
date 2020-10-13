<?php
/**
*  Paperplane _blankTheme
 * Template Name: Pagina risultati ricerca
*/
get_header();
// imposto la visualizzazione compatta delle card rislutati
$search_result_card = 1;
// recupero la parola chiave di ricerca
$search_kw = $_GET["search-kw"];
// recupero l'ordinamento
if ( !isset( $_GET["results_order"] ) ) {
  $results_order = 'title';
}
else {
  $results_order = $_GET["results_order"];
}
// verifico se ci sono filtri attivi
if ( isset( $_GET["amministrazione_tax"] ) || isset( $_GET["servizi_tax"] ) || isset( $_GET["category_tax"] ) || isset( $_GET["documenti_tax"] ) || isset( $_GET["argomenti_tax"] ) ) {
  $remove_filters = 1;
}
else {
  $remove_filters = 0;
}
// imposto la tax_query
$tax_query = array(
  'relation' => 'OR',
);
// verifico se è impostata solo la ricerca solo per argomento
if ( !isset( $_GET["amministrazione_tax"] ) && !isset( $_GET["servizi_tax"] ) && !isset( $_GET["category_tax"] ) && !isset( $_GET["documenti_tax"] ) ) {
  if ( !empty( $_GET["argomenti_tax"] ) ) {
    $argomenti_tax = $_GET["argomenti_tax"];
    $tax_query[] =  array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_id',
      'terms' => $argomenti_tax,
    );
  }
}
// altrimenti recupero le altre tassonomie
else {
  // recupero amministrazione_tax
  if ( !empty( $_GET["amministrazione_tax"] ) ) {
    // se è incrociata con un argomento
    if ( !empty( $_GET["argomenti_tax"] ) ) {
      $tax_query[] =  array(
        array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'amministrazione_tax',
            'field' => 'term_id',
            'terms' => $_GET["amministrazione_tax"],
          ),
          array(
            'taxonomy' => 'argomenti_tax',
            'field'    => 'term_id',
            'terms'    => $_GET["argomenti_tax"],
          ),
        ),
      );
    }
    else {
      // se non è incrociata con un argomento
      $tax_query[] =  array(
        'taxonomy' => 'amministrazione_tax',
        'field' => 'term_id',
        'terms' => $_GET["amministrazione_tax"],
      );
    }
  }
  // recupero servizi_tax
  if ( !empty( $_GET["servizi_tax"] ) ) {
    // se è incrociata con un argomento
    if ( !empty( $_GET["argomenti_tax"] ) ) {
      $tax_query[] =  array(
        array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'servizi_tax',
            'field' => 'term_id',
            'terms' => $_GET["servizi_tax"],
          ),
          array(
            'taxonomy' => 'argomenti_tax',
            'field'    => 'term_id',
            'terms'    => $_GET["argomenti_tax"],
          ),
        ),
      );
    }
    else {
      // se non è incrociata con un argomento
      $tax_query[] =  array(
        'taxonomy' => 'servizi_tax',
        'field' => 'term_id',
        'terms' => $_GET["servizi_tax"],
      );
    }
  }
  // recupero documenti_tax
  if ( !empty( $_GET["documenti_tax"] ) ) {
    if ( !empty( $_GET["argomenti_tax"] ) ) {
      // se è incrociata con un argomento
      $tax_query[] =  array(
        array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'documenti_tax',
            'field' => 'term_id',
            'terms' => $_GET["documenti_tax"],
          ),
          array(
            'taxonomy' => 'argomenti_tax',
            'field'    => 'term_id',
            'terms'    => $_GET["argomenti_tax"],
          ),
        ),
      );
    }
    else {
      // se non è incrociata con un argomento
      $tax_query[] =  array(
        'taxonomy' => 'documenti_tax',
        'field' => 'term_id',
        'terms' => $_GET["documenti_tax"],
      );
    }
  }
  // recupero category_tax (category)
  if ( !empty( $_GET["category_tax"] ) ) {
    // se è incrociata con un argomento
    if ( !empty( $_GET["argomenti_tax"] ) ) {
      $tax_query[] =  array(
        array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $_GET["category_tax"],
          ),
          array(
            'taxonomy' => 'argomenti_tax',
            'field'    => 'term_id',
            'terms'    => $_GET["argomenti_tax"],
          ),
        ),
      );
    }
    else {
      // se non è incrociata con un argomento
      $tax_query[] =  array(
        'taxonomy' => 'category',
        'field' => 'term_id',
        'terms' => $_GET["category_tax"],
      );
    }
  }
}
// imposto la paginazione
$page = get_query_var('paged');
// stabilisto ordinamento risultati
if ( !empty( $_GET["results_order"] ) ) {
  if ( $_GET["results_order"] == 'title' ) {
    $orderby = 'title';
    $order = 'ASC';
  }
}
else {
  $orderby = 'date';
  $order = 'DESC';
}
// combino i parametri per la query
$search_query_parameters = array(
  'post_type' => array( 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt', 'amm_trasp_cpt' ),
  's' => $search_kw,
  'tax_query' => $tax_query_good,
  'paged' => $page,
  'orderby' => $orderby,
  'order' => $order,
  'posts_per_page' => 24,
  'tax_query' => $tax_query
);
// genero la query
$search_query = new WP_Query( $search_query_parameters );
?>


<form method="get" action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>/" id="search-filters" autocomplete="off">
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-intro">
      <div class="single-content-opening-padder">
        <div class="breadcrumbs-holder grey-links undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
          <?php bcn_display(); ?>
        </div>
        <div class="inpage-searchform">
          <?php if ( $search_kw != '' ) : ?>
            <h4 class="txt-1">Hai cercato:</h4>
          <?php endif; ?>
          <div class="search-form overlay-form">
            <label for="search-kw-inpage-search-input">Digita una parola chiave per la ricerca:</label>
            <input id="search-kw-inpage-search-input" type="text" name="search-kw" class="form-control search-autocomplete search-input-kw-js" value="<?php echo $search_kw; ?>" placeholder="Cerca informazioni, persone, servizi" aria-label="Digita una parola chiave per la ricerca" />
            <button type="submit" class="search-submit search-submit-js" aria-label="Cerca nel sito"><span class="icon-search"></span></button>
            <button onclick="searchErase()" class="search-erase search-erase-js" aria-label="Cancella il contenuto della casella di testo">x</button>
            <div class="search-suggestion-area">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <div class="flex-hold flex-hold-search-page bordered top">
        <div class="search-page-left">
          <div class="sticky-element sticky-columns-js">
            <div class="padder">
                <div class="sticky-element sticky-columns-js">
                  <button onclick="event.preventDefault(); pageIndexMenuControlsMobile(this)" class="mobile-only index-menu-expander index-menu-expander-only-mobile-js button-appearance-normalizer button-typo-normalizer" aria-expanded="false" aria-label="Apri il pannello dei filtri di ricerca" data-collapsed="Apri il pannello dei filtri di ricerca" data-expanded="Chiudi il pannello dei filtri di ricerca">
                    Filtri di ricerca<span class="icon-expand"></span>
                  </button>
                  <div class="index-menu-only-mobile-js">
                    <h5 class="allupper txt-4">Categorie</h5>
                    <?php
                    // funzione che richiama i filtri di ricerca

                    $tax_name = 'Amministrazione';
                    $tax_slug = 'amministrazione_tax';
                    $tax_search_parameter = 'amministrazione_tax[]';
                    $js_name = 'amministrazione';
                    search_results_tax_listing( $tax_name, $tax_slug, $tax_search_parameter, $js_name );

                    $tax_name = 'Servizi';
                    $tax_slug = 'servizi_tax';
                    $tax_search_parameter = 'servizi_tax[]';
                    $js_name = 'servizi';
                    search_results_tax_listing( $tax_name, $tax_slug, $tax_search_parameter, $js_name );

                    $tax_name = 'Novità';
                    $tax_slug = 'category';
                    $tax_search_parameter = 'category_tax[]';
                    $js_name = 'novita';
                    search_results_tax_listing( $tax_name, $tax_slug, $tax_search_parameter, $js_name );

                    $tax_name = 'Documenti e dati';
                    $tax_slug = 'documenti_tax';
                    $tax_search_parameter = 'documenti_tax[]';
                    $js_name = 'documenti';
                    search_results_tax_listing( $tax_name, $tax_slug, $tax_search_parameter, $js_name );
                     ?>
                    <?php
                     ?>
                    <h5 class="allupper txt-4">Argomenti</h5>
                    <?php search_results_argomenti_tax_listing(); ?>
                  </div>


                </div>

            </div>

          </div>

        </div>
        <div class="search-page-right">
          <div class="padder">
            <div class="flex-hold flex-hold-2 margins-thin bordered bottom intro-search-results-padder verticalize">
              <div class="flex-hold-child">
                <?php
                // conto i risultati
                 $count = $search_query->found_posts;
                 echo $count;
                 if ( $count == 1 ) {
                   echo ' risultato';
                 }
                 else {
                   echo ' risultati';
                 }
                 ?>
                 <?php if ( $remove_filters == 1 ) : ?>
                   <h5 class="allupper eraser-btn"><a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>?search-kw=<?php echo $search_kw ; ?>" class="green-link">Elimina filtri</a></h5>
                 <?php endif; ?>
              </div>
              <div class="flex-hold-child">
                Ordina per
                <?php if ( $results_order === 'title' ) : ?>
                  <label for="order-results">Riordina i risultati della ricerca:</label>
                  <select id="order-results" name="results_order" class="order-results order-results-js">
                    <option value="title">Titolo</option>
                    <option value="date">Data</option>
                  </select>
                <?php else : ?>
                  <label for="order-results">Riordina i risultati della ricerca:</label>
                  <select id="order-results" name="results_order" class="order-results order-results-js">
                    <option value="date">Data</option>
                    <option value="title">Titolo</option>
                  </select>
                <?php endif; ?>

              </div>
            </div>
            <?php if ( $search_query->have_posts() ) : ?>
              <div class="flex-hold flex-hold-3 margins-thin search-results">
                <?php while ( $search_query->have_posts() ) : $search_query->the_post(); ?>
                  <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
                <?php endwhile; ?>
              </div>
            <?php endif; wp_reset_postdata(); ?>
            <?php wp_pagenavi( array( 'query' => $search_query ) ); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<?php get_footer(); ?>
