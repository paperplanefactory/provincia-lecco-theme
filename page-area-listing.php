<?php
/**
*  Paperplane _blankTheme
 * Template Name: Pagina area listing
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
                  <h5 class="allupper">Tutti gli argomenti</h5>
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
// contentui in evidenza se non c'è paginazione
if ( $listing_page_highlight_contents && !is_paged() ) :
  ?>
  <div class="wrapper bg-9">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more">
        <div class="listing-box">
          <h2>In evidenza</h2>
          <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
            <?php foreach( $listing_page_highlight_contents as $post ) : setup_postdata( $post ); ?>
              <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php
// listing di primo livello tranne news
if ( $listing_page_level === 'primo-livello' && $listing_page_taxonmy != 'category' ) :
  $display_h3 = 1;
  ?>
  <?php
  $args_all_subpages = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'orderby'    => 'menu_order',
    //'sort_order' => 'asc'
  );
  $my_all_subpages = get_posts( $args_all_subpages );
  if ( !empty ( $my_all_subpages ) ) :
   ?>
   <div class="wrapper">
     <div class="wrapper-padded">
       <div class="wrapper-padded-more">
         <div class="listing-box">
           <h2>Tutto su <?php the_title(); ?></h2>
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

  <?php
  // listing di primo livello news
  elseif ( $listing_page_level === 'primo-livello' && $listing_page_taxonmy === 'category' ) :
    ?>
    <?php
    $categories = get_terms( array(
      'taxonomy' => 'category',
      'hide_empty' => false
    )
  );
  foreach( $categories as $category ) : ?>
  <?php
  $args_all_top_posts = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field' => 'term_ID',
        'terms' => $category->term_id
      )
    ),
  );
  $my_all_top_posts = get_posts( $args_all_top_posts );
  if ( !empty ( $my_all_top_posts ) ) :
   ?>
   <div class="wrapper">
     <div class="wrapper-padded">
       <div class="wrapper-padded-more">
         <div class="listing-box">
           <h2><?php echo $category->name; ?></h2>
           <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
             <?php foreach ( $my_all_top_posts as $post ) : setup_postdata ( $post ); ?>
               <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
             <?php endforeach; wp_reset_postdata(); ?>
           </div>
           <div class="aligncenter">
             <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="square-button green filled" title="Archivio <?php echo $category->name; ?>" aria-label="Archivio <?php echo $category->name; ?>">Vedi tutte</a>
           </div>
         </div>

       </div>
     </div>
   </div>
  <?php endif; ?>
  <?php endforeach; ?>

  <?php
  // contentui in evidenza se non c'è paginazione
  if ( $listing_page_highlight_progetti && !is_paged() ) :
    ?>
    <div class="wrapper">
      <div class="wrapper-padded">
        <div class="wrapper-padded-more">
          <div class="listing-box">
            <h2>Progetti</h2>
            <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
              <?php foreach( $listing_page_highlight_progetti as $post ) : setup_postdata( $post ); ?>
                <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
              <?php endforeach; wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>



<?php endif; ?>

<?php
// listing di secondo e terzo livello
if ( $listing_page_level === 'secondo-livello' || $listing_page_level === 'terzo-livello' || $listing_page_taxonmy === 'argomenti_tax' ) :
  ?>
  <?php
  // verifico se è impostata come pagina per elencare i bandi
  if ( $listing_bandi == 1 ) {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    global $today;
    // verifico se è impostata come pagina per elencare i bandi in scadenza
    if ( !$archivio_bandi_scaduti ) {
      $meta_query_bandi = array(
        array(
          'key' => 'scadenza_bando',
          'value' => $today,
          'compare' => '>=',
        ),
      );
      $ordering = 'ASC';
    }
    else {
      // verifico se è impostata come pagina per elencare i bandi scaduti
      $meta_query_bandi = array(
        array(
          'key' => 'scadenza_bando',
          'value' => $today,
          'compare' => '<',
        ),
      );
      $ordering = 'DESC';
    }
    // compongo la query per i bandi
    $args_all_cpts = array(
      'post_type' => $cpt_query,
      'posts_per_page' => 15,
      'paged' => $paged,
      'tax_query' => array(
        array(
          'taxonomy' => $listing_page_taxonmy,
          'field' => 'term_ID',
          'terms' => $tax_query
        )
      ),
      'order' => $ordering,
      'orderby' => 'meta_value',
      'meta_key' => 'scadenza_bando',
      'meta_query' => $meta_query_bandi,
    );
    $listing_paged = new WP_Query( $args_all_cpts );
  }
  else {
    // se non è impostata come pagina per elencare i bandi compongo la query per argomenti_cpt
    if ( $listing_page_taxonmy === 'argomenti_tax' ) {
      $compact_argomenti = 1;
      $args_all_cpts = array(
        'post_type' => $cpt_query,
        'posts_per_page' => 15,
        'paged' => $paged,
      );
      $listing_paged = new WP_Query( $args_all_cpts );
    }
    // se non è impostata come pagina per elencare i bandi compongo la query predefinita
    else {
      $args_all_cpts = array(
        'post_type' => $cpt_query,
        'posts_per_page' => 15,
        'paged' => $paged,
        'tax_query' => array(
          array(
            'taxonomy' => $listing_page_taxonmy,
            'field' => 'term_ID',
            'terms' => $tax_query
          )
        ),
      );
      $listing_paged = new WP_Query( $args_all_cpts );
    }
  }
  if ( $listing_paged->have_posts() ) :
   ?>
   <div class="wrapper">
     <div class="wrapper-padded">
       <div class="wrapper-padded-more">
         <div class="listing-box">
           <div class="flex-hold flex-hold-2 margins-fit verticalize opening-child-right">
             <div class="flex-hold-child">
               <?php if ( $listing_bandi == 1 && $archivio_bandi_scaduti == 0 ) : ?>
                 <h2><?php the_title(); ?> in scadenza</h2>
               <?php else : ?>
                 <h2><?php the_title(); ?></h2>
               <?php endif; ?>
             </div>
             <div class="flex-hold-child">
               <?php if ( $listing_bandi == 1 && $archivio_bandi_scaduti == 0 ) : ?>
                 <a href="<?php echo $link_bandi_scaduti; ?>" class="square-button green filled"><?php the_title(); ?> scaduti</a>
                <?php endif; ?>
             </div>
           </div>
           <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
             <?php while ( $listing_paged->have_posts() ) : $listing_paged->the_post(); ?>
               <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
             <?php endwhile; wp_reset_postdata(); ?>
           </div>
           <?php wp_pagenavi(  array( 'query' => $listing_paged )  ); ?>
         </div>
       </div>
     </div>
   </div>
 <?php else : ?>
   <div class="wrapper">
     <div class="wrapper-padded">
       <div class="wrapper-padded-more">
         <div class="listing-box">
           <h2>Non sono disponibili contenuti in questa area</h2>
         </div>
       </div>
     </div>
   </div>
 <?php endif; ?>
<?php endif; ?>


<?php
if ( $listing_page_taxonmy != 'argomenti_tax' ) :
 ?>
 <div class="wrapper">
   <div class="wrapper-padded">
     <div class="wrapper-padded-more">
       <div class="tag-box">
         <div class="aligncenter">
           <h6 class="txt-1 allupper">Altri argomenti</h6>
           <div class="tags-holder">
             <?php list_all_argomenti_pills(); ?>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
<?php endif; ?>










<?php get_footer(); ?>
