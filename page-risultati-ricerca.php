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
// verifico se è impostata la ricerca solo per argomento
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
  if ( !empty( $_GET["amministrazione_tax"] ) ) {
    $amministrazione_tax = $_GET["amministrazione_tax"];
    $tax_query[] =  array(
      'taxonomy' => 'amministrazione_tax',
      'field' => 'term_id',
      'terms' => $amministrazione_tax,
      array(
        'taxonomy' => 'argomenti_tax',
        'field'    => 'term_id',
        'terms'    => $argomenti_tax,
      ),
    );
  }

  if ( !empty( $_GET["servizi_tax"] ) ) {
    $servizi_tax = $_GET["servizi_tax"];
    $tax_query[] =  array(
      'taxonomy' => 'servizi_tax',
      'field' => 'term_id',
      'terms' => $servizi_tax,
      array(
        'taxonomy' => 'argomenti_tax',
        'field'    => 'term_id',
        'terms'    => $argomenti_tax,
      ),
    );
  }

  if ( !empty( $_GET["category_tax"] ) ) {
    $category_tax = $_GET["category_tax"];
    $tax_query[] =  array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'category',
        'field' => 'term_id',
        'terms' => $category_tax,
      ),
      array(
        'taxonomy' => 'argomenti_tax',
        'field'    => 'term_id',
        'terms'    => $argomenti_tax,
      ),
    );
  }

  if ( !empty( $_GET["documenti_tax"] ) ) {
    $documenti_tax = $_GET["documenti_tax"];
    $tax_query[] =  array(
      'taxonomy' => 'documenti_tax',
      'field' => 'term_id',
      'terms' => $documenti_tax,
      array(
        'taxonomy' => 'argomenti_tax',
        'field'    => 'term_id',
        'terms'    => $argomenti_tax,
      ),
    );
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

$search_query_parameters = array(
  'post_type' => array( 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt' ),
  's' => $search_kw,
  'tax_query' => $tax_query,
  'paged' => $page,
  'orderby' => $orderby,
  'order' => $order
);
$search_query = new WP_Query( $search_query_parameters );
?>
<form method="get" action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>/" id="search-filters">
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-intro">
      <div class="single-content-opening-padder">
        <div class="breadcrumbs-holder grey-links undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
          <?php bcn_display(); ?>
        </div>
        <div class="inpage-searchform">
          <h4 class="txt-1">Hai cercato:</h4>
          <div class="search-form overlay-form">
              <input type="text" name="search-kw" class="search-input-kw-js" value="<?php echo $search_kw; ?>" placeholder="Cerca informazioni, persone, servizi" aria-label="Digita una parola chiave per la ricerca" />
              <button type="submit" class="search-submit search-submit-js"><span class="icon-search" aria-label="Cerca nel sito"></span></button>
            <button class="search-erase search-erase-js">x</button>
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
                  <h5 class="allupper txt-4">Categorie</h5>
                  <?php search_results_amministrazione_tax_listing(); ?>
                  <?php search_results_servizi_tax_listing(); ?>
                  <?php search_results_novita_tax_listing(); ?>
                  <?php search_results_documenti_tax_listing(); ?>
                  <h5 class="allupper txt-4">Argomenti</h5>
                  <?php search_results_argomenti_tax_listing(); ?>
                </div>

            </div>

          </div>

        </div>
        <div class="search-page-right">
          <div class="padder">
            <div class="flex-hold flex-hold-2 margins-thin bordered bottom intro-search-results-padder verticalize">
              <div class="flex-hold-child">
                <?php
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
                   <h5 class="allupper"><a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>?search-kw=<?php echo $search_kw ; ?>" class="green-link">Elimina filtri</a></h5>
                 <?php endif; ?>
              </div>
              <div class="flex-hold-child">
                Ordina per <select id="cars" name="results_order" class="order-results-js">
                  <option value="title">Titolo</option>
                  <option value="date">Data</option>
                </select>
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
<?php
if ( $_GET['amministrazione_tax'] ) {
  ?>
  <script type="text/javascript">
  $('#page-search-cats-expander-amministrazione').attr('aria-expanded', true);
  $('#page-search-cats-expander-amministrazione').find('.icon-js').addClass('icon-expand').removeClass('left-arrow-tip');
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
  $('#page-search-cats-expander-servizi').find('.icon-js').addClass('icon-expand').removeClass('left-arrow-tip');
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
  $('#page-search-cats-expander-novita').find('.icon-js').addClass('icon-expand').removeClass('left-arrow-tip');
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
  $('#page-search-cats-expander-documenti').find('.icon-js').addClass('icon-expand').removeClass('left-arrow-tip');
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

?>


<?php get_footer(); ?>
