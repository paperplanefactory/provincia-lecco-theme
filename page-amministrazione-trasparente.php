<?php
/**
*  Paperplane _blankTheme
 * Template Name: Pagina amministrazione trasparente
*/
get_header();
// questa sarà una pagina template dalla quale:
// - se di primo livello vengono listate le sotto pagine (o singoli contenuti del CPT Amministrazione) in evidenza e a seguire tutte le sotto pagine
// - se è di secondo livello viene associata a una voce della tassonomia "Categorie amministrazione", vengono listati i singoli contenuti del CPT Amministrazione in evidenza e a seguire tutti i singoli contenuti del CPT Amministrazione con la voce di tassonomia "Categorie amministrazione" specificata
?>
<?php
while ( have_posts() ) : the_post();
// aggiorno le visualizzazioni
provincia_lecco_set_post_view();
$listing_page_cpt_listed = get_field('listing_page_cpt_listed');
// verifico se è una pagina di primo o di secondo livello
$listing_page_level = get_field('listing_page_level');
// verifico di quale area fa parte
$listing_page_taxonmy = get_field('listing_page_taxonmy');
if ( $listing_page_taxonmy === 'amministrazione_tax' ) {
  // contenuti da elencare in evidenza
  $listing_page_highlight_contents = get_field('listing_page_highlight_contents_amministrazione');
  // custom post type per listing
  $cpt_query = 'amministrazione_cpt';
  // termine di tassonomia per listing
  $tax_query = get_field('listing_page_level_second_taxonmy_amministrazione');
}
if ( $listing_page_taxonmy === 'servizi_tax' ) {
  // contenuti da elencare in evidenza
  $listing_page_highlight_contents = get_field('listing_page_highlight_contents_servizi');
  // custom post type per listing
  $cpt_query = 'servizi_cpt';
  // termine di tassonomia per listing
  $tax_query = get_field('listing_page_level_second_taxonmy_servizi');
}
if ( $listing_page_taxonmy === 'documenti_tax' ) {
  // contenuti da elencare in evidenza
  $listing_page_highlight_contents = get_field('listing_page_highlight_contents_documenti');
  $cpt_query = 'documenti_cpt';
  // termine di tassonomia per listing
  $tax_query = get_field('listing_page_level_second_taxonmy_documenti');
}
if ( $listing_page_taxonmy === 'category' ) {
  // contenuti da elencare in evidenza
  $listing_page_highlight_contents = get_field('listing_page_highlight_contents_novita');
  // progetti da elencare in evidenza
  $listing_page_highlight_progetti = get_field('listing_page_highlight_progetti');
  // custom post type per listing
  $cpt_query = 'post';
  // termine di tassonomia per listing
  $tax_query = get_field('listing_page_level_second_taxonmy_novita');
}
if ( $listing_page_taxonmy === 'argomenti_tax' ) {
  // contenuti da elencare in evidenza
  $listing_page_highlight_contents = get_field('listing_page_highlight_argomenti');
  // custom post type per listing
  $cpt_query = 'argomento_cpt';
}

// verifico se è impostato un filtro sui bandi
$listing_bandi = get_field( 'listing_bandi' );
if ( $listing_bandi  == 1 ) {
  $archivio_bandi_scaduti = get_field( 'archivio_bandi_scaduti' );
  $link_bandi_scaduti = get_field( 'link_bandi_scaduti' );
}
else {
  $listing_bandi = 0;
  $archivio_bandi_scaduti = 0;
}

// verifico se è una pagina di primo livello
if ( $listing_page_level === 'primo-livello' ) {
  $tax_query_multiple = get_terms( array(
    'taxonomy' => $listing_page_taxonmy,
    'hide_empty' => false,
    //'parent' => 0
  )
);

foreach( $tax_query_multiple as $tax ) {
  $tax_query_longlist .= '<input type="hidden" name="'.$listing_page_taxonmy.'[]" value="'.$tax->term_id.'">';
}
}

//imposto il colore di sfondo per il primo blocco di card che viene poi annullato se ci sono contenuti in evidenza
$color_block = 'bg-9';
$listing_page = 1;
?>
  <main class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-intro">
        <div class="page-opening-padder">
          <div class="breadcrumbs-holder grey-links undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php bcn_display(); ?>
          </div>

          <div class="flex-hold flex-hold-page-opening">
            <div class="page-opening-left">
              <h1><?php the_title(); ?></h1>
              <?php if ( get_field( 'page_abstract' ) ) : ?>
                <p class="paragraph-variant">
                  <?php the_field( 'page_abstract' ); ?>
                </p>
              <?php endif; ?>

              <form action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" class="search-form banner-form">
                <input type="text" name="search-kw" placeholder='Cerca in "<?php the_title(); ?>"'  aria-label="Digita una parola chiave per la ricerca" />
                <input type="hidden" name="<?php echo $listing_page_taxonmy; ?>[]" value="<?php echo $tax_query; ?>">
                <?php
                if ( $listing_page_level === 'primo-livello' ) {
                  echo $tax_query_longlist;
                }
                 ?>
                <button class="button-appearance-normalizer" type="submit" aria-label="Cerca"><span class="icon-search"></span></button>
              </form>
            </div>
            <div class="page-opening-right">
              <div class="padder">
                <?php if ( $listing_page_taxonmy === 'argomenti' ) : ?>
                  <h6 class="allupper">Tutti gli argomenti</h6>
                  <?php intro_menu_list_argomenti(); ?>
                <?php else : ?>
                  <?php if ( $listing_page_level === 'primo-livello' ) {
                    intro_menu_list_subpage_items();
                  }
                  elseif ( $listing_page_level === 'secondo-livello' ) {
                    intro_menu_list_parent_subpage_items();
                  }
                  elseif ( $listing_page_level === 'terzo-livello' ) {
                    intro_menu_list_parent_parent_subpage_items();
                  }
                  ?>
                <?php endif; ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
<?php endwhile; ?>



<?php

  $display_h3 = 1;
  ?>
  <?php
  $args_all_subpages = array(
    'post_type' => 'amm_trasp_cpt',
    'posts_per_page' => -1,
    'post_parent' => 0,
    'orderby' => 'title',
    'order' => 'ASC'
  );

  $my_all_subpages = get_posts( $args_all_subpages );
  if ( !empty ( $my_all_subpages ) ) :
   ?>
   <div class="wrapper <?php echo $color_block; ?>">
     <div class="wrapper-padded">
       <div class="wrapper-padded-more">
         <div class="listing-box">
           <?php if ( get_field( 'custom_listing_title' ) ) : ?>
             <h2><?php the_field( 'custom_listing_title' ); ?></h2>
           <?php else : ?>
             <h2>Tutto su <?php the_title(); ?></h2>
           <?php endif; ?>
           <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
             <?php foreach ( $my_all_subpages as $post ) : setup_postdata ( $post ); ?>
               <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
             <?php endforeach; wp_reset_postdata(); ?>
           </div>
         </div>
       </div>
     </div>
   </div>
  <?php endif; ?>




<?php get_footer(); ?>
