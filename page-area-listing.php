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
if ( $listing_page_taxonmy === 'argomenti' ) {
  // contenuti da elencare in evidenza
  $listing_page_highlight_contents = get_field('listing_page_highlight_argomenti');
  //$cpt_query = 'documenti_cpt';
  // termine di tassonomia per listing
  //$tax_query = get_field('listing_page_highlight_argomenti');
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
                <input type="text" name="search-kw" placeholder='Cerca in "<?php the_title(); ?>"'  aria-label="Digita una parola chiave per la ricerca" />
                <input type="hidden" name="s_cpt" value="<?php echo $cpt_query; ?>">
                <input type="hidden" name="s_tax_name" value="<?php echo $listing_page_taxonmy; ?>">
                <input type="hidden" name="s_tax_term_id" value="<?php echo $tax_query; ?>">
                <button class="button-appearance-normalizer" type="submit" aria-label="Cerca"><span class="icon-search"></span></button>
              </form>
            </div>
            <div class="page-opening-right">
              <div class="padder">
                <?php if ( $listing_page_taxonmy === 'argomenti' ) : ?>
                  <h5 class="allupper">Tutti gli argomenti</h5>
                  <?php intro_menu_list_argomenti(); ?>
                <?php else : ?>
                  <h5 class="allupper">Aree in <?php the_title(); ?></h5>
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
  </div>
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
if ( $listing_page_level === 'secondo-livello' || $listing_page_level === 'terzo-livello' ) :
  ?>
  <?php
  $page = get_query_var('paged');
  $args_all_cpts = array(
    'post_type' => $cpt_query,
    'posts_per_page' => 15,
    'paged' => $page,
    'orderby'    => 'menu_order',
    //'sort_order' => 'asc',
    'tax_query' => array(
      array(
        'taxonomy' => $listing_page_taxonmy,
        'field' => 'term_ID',
        'terms' => $tax_query
      )
    ),
  );
  query_posts( $args_all_cpts );
  if ( have_posts() ) :
   ?>
   <div class="wrapper">
     <div class="wrapper-padded">
       <div class="wrapper-padded-more">
         <div class="listing-box">
           <h2>Tutto su <?php the_title(); ?></h2>
           <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
             <?php while ( have_posts() ) : the_post(); ?>
               <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
             <?php endwhile; wp_reset_postdata(); ?>
           </div>
           <?php wp_pagenavi(); ?>
         </div>
       </div>
     </div>
   </div>
  <?php endif; ?>
<?php endif; ?>




<?php
// listing di secondo e terzo livello
if ( $listing_page_taxonmy === 'argomenti' ) :
  ?>
  <?php
  $compact_argomenti = 1;
  $args_all_subpages = array(
    'post_type' => 'argomento_cpt',
    'posts_per_page' => -1,
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
           <h2>Tutti gli argomenti</h2>
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
<?php endif; ?>




<?php
// listing di secondo e terzo livello
if ( $listing_page_taxonmy != 'argomenti' ) :
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
