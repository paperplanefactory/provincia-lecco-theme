<?php
// Paperplane _blankTheme - template per single amministrazione_cpt.
get_header();
// questa sarà una pagina template dalla quale:
// - se di primo livello vengono listate le sotto pagine (o singoli contenuti del CPT Amministrazione) in evidenza e a seguire tutte le sotto pagine
// - se è di secondo livello viene associata a una voce della tassonomia "Categorie amministrazione", vengono listati i singoli contenuti del CPT Amministrazione in evidenza e a seguire tutti i singoli contenuti del CPT Amministrazione con la voce di tassonomia "Categorie amministrazione" specificata
?>
<?php
while ( have_posts() ) : the_post();
$argomenti_in_evidenza = get_field( 'argomenti_in_evidenza' );
$argomento_page_listing_term = get_field( 'argomento_page_listing_term' );


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

?>
  <div class="wrapper">
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

              <form action="/action_page.php" class="search-form banner-form">
                <input type="text" name="search-kw" placeholder='Cerca in "<?php the_title(); ?>"' />
                <input type="hidden" name="s_cpt" value="<?php echo $cpt_query; ?>">
                <input type="hidden" name="s_tax_name" value="<?php echo $listing_page_taxonmy; ?>">
                <input type="hidden" name="s_tax_term_id" value="<?php echo $tax_query; ?>">
                <button class="button-appearance-normalizer" type="submit"><span class="icon-search"></span></button>
              </form>
            </div>
            <div class="page-opening-right">
              <div class="padder">
                <h5 class="allupper">Tutta l’amministrazione</h5>
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
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php
// contentui in evidenza se non c'è paginazione
if ( $argomenti_in_evidenza && !is_paged() ) :
  ?>
  <div class="wrapper bg-9">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more">
        <div class="listing-box">
          <h2>In evidenza</h2>
          <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
            <?php foreach( $argomenti_in_evidenza as $post ) : setup_postdata( $post ); ?>
              <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
            <?php endforeach; wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php
$args_all_amministrazione = array(
  'post_type' => 'amministrazione_cpt',
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_all_amministrazione = get_posts( $args_all_amministrazione );
$count_amministrazione = count($my_all_amministrazione);
$args_amminisrtazione = array(
  'post_type' => 'amministrazione_cpt',
  'posts_per_page' => 3,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_three_amministrazione = get_posts( $args_amminisrtazione );
if ( !empty ( $my_three_amministrazione ) ) :
 ?>
 <div class="wrapper">
   <div class="wrapper-padded">
     <div class="wrapper-padded-more">
       <div class="listing-box">
         <h2>Amministrazione</h2>
         <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
           <?php foreach ( $my_three_amministrazione as $post ) : setup_postdata ( $post ); ?>
             <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
           <?php endforeach; wp_reset_postdata(); ?>
         </div>
         <?php if ( $count_amministrazione > 3 ) : ?>
           <div class="aligncenter">
             <a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" class="square-button green filled" title="Archivio Amministrazione in <?php the_title(); ?>" aria-label="Archivio Amministrazione in <?php the_title(); ?>">Altro (<?php echo $count_novita; ?>)</a>
           </div>
         <?php endif; ?>
       </div>
     </div>
   </div>
 </div>
<?php endif; ?>

<?php
$args_all_servizi = array(
  'post_type' => 'servizi_cpt',
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_all_servizi = get_posts( $args_all_servizi );
$count_servizi = count($my_all_servizi);
$args_servizi = array(
  'post_type' => 'servizi_cpt',
  'posts_per_page' => 3,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_three_servizi = get_posts( $args_servizi );
if ( !empty ( $my_three_servizi ) ) :
 ?>
 <div class="wrapper">
   <div class="wrapper-padded">
     <div class="wrapper-padded-more">
       <div class="listing-box">
         <h2>Servizi</h2>
         <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
           <?php foreach ( $my_three_servizi as $post ) : setup_postdata ( $post ); ?>
             <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
           <?php endforeach; wp_reset_postdata(); ?>
         </div>
         <?php if ( $count_servizi > 3 ) : ?>
           <div class="aligncenter">
             <a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" class="square-button green filled" title="Archivio Servizi in <?php the_title(); ?>" aria-label="Archivio Servizi in <?php the_title(); ?>">Altro (<?php echo $count_novita; ?>)</a>
           </div>
         <?php endif; ?>
       </div>
     </div>
   </div>
 </div>
<?php endif; ?>


<?php
$args_all_novita = array(
  'post_type' => 'post',
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_all_novita = get_posts( $args_all_novita );
$count_novita = count($my_all_novita);
$args_novita = array(
  'post_type' => 'post',
  'posts_per_page' => 3,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_three_novita = get_posts( $args_novita );

if ( !empty ( $my_three_novita ) ) :
 ?>
 <div class="wrapper bg-9">
   <div class="wrapper-padded">
     <div class="wrapper-padded-more">
       <div class="listing-box">
         <h2>Novità</h2>
         <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
           <?php foreach ( $my_three_novita as $post ) : setup_postdata ( $post ); ?>
             <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
           <?php endforeach; wp_reset_postdata(); ?>
         </div>
         <?php if ( $count_novita > 3 ) : ?>
           <div class="aligncenter">
             <a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" class="square-button green filled" title="Archivio Novità in <?php the_title(); ?>" aria-label="Archivio Novità in <?php the_title(); ?>">Altro (<?php echo $count_novita; ?>)</a>
           </div>
         <?php endif; ?>
       </div>
     </div>
   </div>
 </div>
<?php endif; ?>


<?php
$args_all_documenti = array(
  'post_type' => 'documenti_cpt',
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_all_documenti = get_posts( $args_all_documenti );
$count_documenti = count($my_all_documenti);
$args_documenti = array(
  'post_type' => 'documenti_cpt',
  'posts_per_page' => 3,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_three_documenti = get_posts( $args_documenti );
if ( !empty ( $my_three_documenti ) ) :
 ?>
 <div class="wrapper">
   <div class="wrapper-padded">
     <div class="wrapper-padded-more">
       <div class="listing-box">
         <h2>Documenti e dati</h2>
         <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
           <?php foreach ( $my_three_documenti as $post ) : setup_postdata ( $post ); ?>
             <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
           <?php endforeach; wp_reset_postdata(); ?>
         </div>
         <?php if ( $count_documenti > 3 ) : ?>
           <div class="aligncenter">
             <a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" class="square-button green filled" title="Archivio Documenti e dati in <?php the_title(); ?>" aria-label="Archivio Documenti e dati in <?php the_title(); ?>">Altro (<?php echo $count_novita; ?>)</a>
           </div>
         <?php endif; ?>
       </div>
     </div>
   </div>
 </div>
<?php endif; ?>


<?php
$args_all_progetti = array(
  'post_type' => 'progetti_cpt',
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_all_progetti = get_posts( $args_all_progetti );
$count_progetti = count($my_all_progetti);
$args_progetti = array(
  'post_type' => 'progetti_cpt',
  'posts_per_page' => 3,
  'tax_query' => array(
    array(
      'taxonomy' => 'argomenti_tax',
      'field' => 'term_ID',
      'terms' => $argomento_page_listing_term
    )
  ),
);
$my_three_progetti = get_posts( $args_progetti );
if ( !empty ( $my_three_progetti ) ) :
 ?>
 <div class="wrapper">
   <div class="wrapper-padded">
     <div class="wrapper-padded-more">
       <div class="listing-box">
         <h2>Progetti</h2>
         <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
           <?php foreach ( $my_three_progetti as $post ) : setup_postdata ( $post ); ?>
             <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
           <?php endforeach; wp_reset_postdata(); ?>
         </div>
         <?php if ( $count_progetti > 3 ) : ?>
           <div class="aligncenter">
             <a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" class="square-button green filled" title="Archivio Progetti in <?php the_title(); ?>" aria-label="Archivio Progetti in <?php the_title(); ?>">Altro (<?php echo $count_novita; ?>)</a>
           </div>
         <?php endif; ?>
       </div>
     </div>
   </div>
 </div>
<?php endif; ?>




<?php get_footer(); ?>
