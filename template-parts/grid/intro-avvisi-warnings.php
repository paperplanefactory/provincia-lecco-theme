<?php
if ( ! isset( $scadenza_check ) ) {
	$scadenza_check = '';
}
// avvisi specifici per bandi scaduti
if ( $scadenza_check === 'scaduto' ) :
	?>
	<div class="card warning">
		<div class="card_inner warning-card">
			<span class="icon icon-warning"></span>
			<h5 class="allupper">
				<?php the_field( 'titolo_messaggio_generico_bando_scaduto', 'any-lang' ); ?>
			</h5>
			<?php the_field( 'testo_messaggio_generico_bando_scaduto', 'any-lang' ); ?>
		</div>
	</div>
<?php endif; ?>

<?php
//avvisi generici per area
$post_type = get_post_type();
switch ( $post_type ) {
	case 'amministrazione_cpt':
		$taxonomy = 'amministrazione_tax';
		break;
	case 'post':
		$taxonomy = 'category';
		break;
	case 'servizi_cpt':
		$taxonomy = 'servizi_tax';
		break;
	case 'documenti_cpt':
		$taxonomy = 'documenti_tax';
		break;
	case 'page':
		$taxonomy = '';
		break;
	case 'progetti_cpt':
		$taxonomy = '';
		break;
}


$parent_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );

if ( $parent_terms ) {
	foreach ( $parent_terms as $pterm ) {
		$content_tax_list = $pterm->term_id;
		$terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$content_tax_list = $term->term_id;
			}
		}
	}
}
?>

<?php
if ( $taxonomy != '' ) :
	$exclude_ids = array();
	$meta_query_avvisi_sitewide = array(
		'key' => 'scadenza_avviso_specific_content',
		'value' => $today,
		'compare' => '>='
	);
	$args_sitewide_messsages = array(
		'post_type' => 'avviso_content_cpt',
		'posts_per_page' => 10,
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

	if ( ! empty( $my_sitewide_messsages ) ) :
		?>
		<?php
		foreach ( $my_sitewide_messsages as $post ) :
			setup_postdata( $post );
			$exclude_ids[] = $post->ID;
			$message_type = get_field( 'message_type' );
			if ( $message_type === 'warning' ) {
				$card_class = 'warning';
				$icon_class = 'icon-warning';
			} else {
				$card_class = 'restricted';
				$icon_class = 'icon-reserved';
			}
			?>
			<div class="card <?php echo $card_class; ?>">
				<div class="card_inner warning-card">
					<span class="icon <?php echo $icon_class; ?>"></span>
					<h2 class="as-h5 allupper">
						<?php the_title(); ?>
					</h2>
					<?php the_content(); ?>
				</div>
			</div>
		<?php endforeach;
		wp_reset_postdata(); ?>
	<?php endif; ?>
<?php endif; ?>




















<?php
$meta_query_avvisi_singlecontent = array(
	array(
		'key' => 'scadenza_avviso_specific_content',
		'value' => $today,
		'compare' => '>='
	)
);

$args_singlecontent_messsages = array(
	'post_type' => 'avviso_content_cpt',
	'posts_per_page' => 10,
	'meta_query' => $meta_query_avvisi_singlecontent,
	'post__not_in' => $exclude_ids
);
$my_singlecontent_messsage = get_posts( $args_singlecontent_messsages );
if ( ! empty( $my_singlecontent_messsage ) ) :
	?>
	<?php
	foreach ( $my_singlecontent_messsage as $post ) :
		setup_postdata( $post );
		$message_type = get_field( 'message_type' );
		if ( $message_type === 'warning' ) {
			$card_class = 'warning';
			$icon_class = 'icon-warning';
		} else {
			$card_class = 'restricted';
			$icon_class = 'icon-reserved';
		}
		?>
		<div class="card <?php echo $card_class; ?>">
			<div class="card_inner warning-card">
				<span class="icon <?php echo $icon_class; ?>"></span>
				<h2 class="as-h5 allupper">
					<?php the_title(); ?>
				</h2>
				<?php the_content(); ?>
				<?php echo $today;
				the_field( 'scadenza_avviso_specific_content' ); ?>
			</div>
		</div>
	<?php endforeach;
	wp_reset_postdata(); ?>
<?php endif; ?>