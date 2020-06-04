<?php
// avvisi specifici per contenuto
if ( get_field('intro_avviso_attivo') == 1 && get_field('intro_avviso_messaggio') ) :
  ?>
  <div class="card warning">
    <div class="card_inner warning-card">
      <span class="icon icon-warning"></span>
      <h5 class="allupper"><?php the_field( 'intro_avviso_titolo' ); ?></h5>
      <?php the_field( 'intro_avviso_messaggio' ); ?>
    </div>
  </div>
<?php endif; ?>
<?php if ( get_field('intro_warning_attivo') == 1 && get_field('intro_warning_messaggio') ) : ?>
  <div class="card restricted">
    <div class="card_inner warning-card">
      <span class="icon icon-reserved"></span>
      <h5 class="allupper"><?php the_field( 'intro_warning_titolo' ); ?></h5>
      <?php the_field( 'intro_warning_messaggio' ); ?>
    </div>
  </div>
<?php endif; ?>
<?php if ( $scadenza_check === 'scaduto' ) : ?>
  <div class="card warning">
    <div class="card_inner warning-card">
      <span class="icon icon-warning"></span>
      <h5 class="allupper"><?php the_field( 'titolo_messaggio_generico_bando_scaduto', 'any-lang' ); ?></h5>
      <?php the_field( 'testo_messaggio_generico_bando_scaduto', 'any-lang' ); ?>
    </div>
  </div>
<?php endif; ?>

<?php
//avvisi generici per area
$post_type = get_post_type();
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
  $content_tax_list = $pterm->term_id;
  $terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
  if ( !empty( $terms ) ) {
    foreach ( $terms as $term ) {
      $content_tax_list = $term->term_id;
    }
  }
}

 ?>

<?php
$meta_query_avvisi_sitewide = array(
  array(
    'key' => 'scadenza_avviso_specific_content',
    'value' => $today,
    'compare' => '>=',
  ),
);
$args_sitewide_messsages = array(
  'post_type' => 'avviso_content_cpt',
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => $taxonomy,
      'field' => 'term_ID',
      'terms' => $content_tax_list
    )
  ),
  'meta_query' => $meta_query_avvisi_sitewide,
);
$my_sitewide_messsages = get_posts( $args_sitewide_messsages );
if ( !empty ( $my_sitewide_messsages ) ) :
 ?>
 <?php
 foreach ( $my_sitewide_messsages as $post ) : setup_postdata ( $post );
 $message_type = get_field( 'message_type' );
 if ( $message_type === 'warning' ) {
   $card_class = 'warning';
   $icon_class = 'icon-warning';
 }
 else {
   $card_class = 'restricted';
   $icon_class = 'icon-reserved';
 }
 ?>
 <div class="card <?php echo $card_class; ?>">
   <div class="card_inner warning-card">
     <span class="icon <?php echo $icon_class; ?>"></span>
     <h5 class="allupper"><?php the_title(); ?></h5>
     <?php the_content(); ?>
   </div>
 </div>
 <?php endforeach; wp_reset_postdata(); ?>
 <?php endif; ?>
