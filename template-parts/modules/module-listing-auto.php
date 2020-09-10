<!-- module-listing-auto -->
<?php
$module_auto_listing_appearence = get_sub_field( 'module_auto_listing_appearence' );
$module_auto_listing_abstract = get_sub_field( 'module_auto_listing_abstract' );
$module_auto_listing_contatti = get_sub_field( 'module_auto_listing_contatti' );
if ( get_sub_field( 'module_auto_listing_mode' ) === 'manual' ) {
  $my_autolisting = get_sub_field( 'module_auto_listing_manual' );
}
else {
  $module_auto_listing_cpt = get_sub_field( 'module_auto_listing_cpt' );
  $module_auto_listing_area_amministrativa_taxterm = get_sub_field( 'module_auto_listing_area_amministrativa_taxterm' );

  if ( $module_auto_listing_cpt === 'amministrazione_cpt' ) {
    $module_auto_listing_amministrazione_taxterm = get_sub_field( 'module_auto_listing_amministrazione_taxterm' );
    $args_autolisting = array(
      'post_type' => $module_auto_listing_cpt,
      'posts_per_page' => -1,
      'post__not_in' => array($my_id),
      'relation'		=> 'AND',
    	'tax_query'		=> array(
    		array(
    			'taxonomy'	=> 'amministrazione_tax',
    			'field'		=> 'term_id',
    			'terms'		=> $module_auto_listing_amministrazione_taxterm
    		),
    		array(
    			'taxonomy'	=> 'aree_amministrative_tax',
    			'field'		=> 'term_id',
    			'terms'		=> $module_auto_listing_area_amministrativa_taxterm
    		)
    	),
      'orderby'    => 'menu_order',
      //'sort_order' => 'asc'
    );
  }

  elseif ( $module_auto_listing_cpt === 'servizi_cpt' || $module_auto_listing_cpt === 'documenti_cpt' ) {
    $module_auto_listing_amministrazione_taxterm = get_sub_field( 'module_auto_listing_amministrazione_taxterm' );
    $args_autolisting = array(
      'post_type' => $module_auto_listing_cpt,
      'posts_per_page' => -1,
      'post__not_in' => array($my_id),
      'tax_query' => array(
        array(
          'taxonomy' => 'aree_amministrative_tax',
          'field' => 'term_id',
          'terms' => $module_auto_listing_area_amministrativa_taxterm
        )
      ),
      'orderby'    => 'title',
      'sort_order' => 'asc'
    );
  }

  $my_autolisting = get_posts( $args_autolisting );
}
$count_for_grid = count($my_autolisting);

if ( $count_for_grid == 1 && get_post_type() == 'progetti_cpt' ) {
  $grid_classes = 'flex-hold flex-hold-2 margins-wide';
}
elseif ( $count_for_grid == 1 ) {
  $grid_classes = 'flex-hold-single';
}
else {
  $grid_classes = 'flex-hold flex-hold-2 margins-wide';
}

if ( !empty ( $my_autolisting ) ) :
 ?>
 <section class="text-module listing-module">
   <div class="module-separator-flex">
     <div class="content-styled">
       <?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
           <h4 class="rebold"><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a><?php the_sub_field( 'module_index_title' ); ?></h4>
       <?php else : ?>
         <a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
       <?php endif; ?>
       <?php if ( get_sub_field( 'module_auto_listing_intro' ) ) : ?>
         <?php the_sub_field( 'module_auto_listing_intro' ); ?>
       <?php endif; ?>
     </div>
     <?php if ( $module_auto_listing_appearence === 'module-listing-default-card' ) : ?>
       <div class="<?php echo $grid_classes; ?>">
         <?php foreach ( $my_autolisting as $post ) : setup_postdata ( $post ); ?>
           <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
         <?php endforeach; wp_reset_postdata(); ?>
       </div>
     <?php else : ?>
       <div class="tags-holder">
         <?php foreach ( $my_autolisting as $post ) : setup_postdata ( $post ); ?>
           <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
         <?php endforeach; wp_reset_postdata(); ?>
       </div>
     <?php endif; ?>

   </div>
 </section>
<?php endif; ?>

<!-- module-listing-auto -->
