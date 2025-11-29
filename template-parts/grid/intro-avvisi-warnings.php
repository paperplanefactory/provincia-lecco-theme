<?php
/**
 * Template per visualizzare avvisi e warnings
 * Gestisce: bandi scaduti, avvisi per area tassonomica, avvisi specifici
 */

if ( ! isset( $scadenza_check ) ) {
	$scadenza_check = '';
}

// ===== SEZIONE 1: Avviso per bandi scaduti =====
if ( $scadenza_check === 'scaduto' ) :
	?>
	<aside class="card warning">
		<div class="card_inner warning-card">
			<span class="icon icon-warning"></span>
			<h5 class="allupper">
				<?php the_field( 'titolo_messaggio_generico_bando_scaduto', 'any-lang' ); ?>
			</h5>
			<?php the_field( 'testo_messaggio_generico_bando_scaduto', 'any-lang' ); ?>
		</div>
	</aside>
<?php endif; ?>

<?php
// ===== SEZIONE 2: Determinazione tassonomia in base al post type =====

// Inizializza variabili di default
$taxonomy = '';
$content_tax_list = 0;
$exclude_ids = [];

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
	case 'progetti_cpt':
	default:
		$taxonomy = '';
		break;
}

// Se la tassonomia è vuota, salta i controlli tassonomici
if ( ! empty( $taxonomy ) ) {
	// ===== SEZIONE 3: Recupera i termini parent e child =====
	$parent_terms = wp_get_post_terms(
		$post->ID,
		$taxonomy,
		[
			'parent' => 0,
			'orderby' => 'slug',
			'hide_empty' => false
		]
	);

	if ( ! empty( $parent_terms ) && ! is_wp_error( $parent_terms ) ) {
		foreach ( $parent_terms as $pterm ) {
			$content_tax_list = $pterm->term_id;
			$child_terms = wp_get_post_terms(
				$post->ID,
				$taxonomy,
				[
					'parent' => $pterm->term_id,
					'orderby' => 'slug',
					'hide_empty' => false
				]
			);

			if ( ! empty( $child_terms ) && ! is_wp_error( $child_terms ) ) {
				foreach ( $child_terms as $term ) {
					$content_tax_list = $term->term_id;
				}
			}
		}
	}

	// ===== SEZIONE 4: Avvisi specifici per area tassonomica =====
	$meta_query_avvisi_sitewide = [
		'key' => 'scadenza_avviso_specific_content',
		'value' => $today,
		'compare' => '>='
	];

	$args_sitewide_messages = [
		'post_type' => 'avviso_content_cpt',
		'posts_per_page' => 10,
		'tax_query' => [
			[
				'taxonomy' => $taxonomy,
				'field' => 'term_id',
				'terms' => $content_tax_list
			]
		],
		'meta_query' => [ $meta_query_avvisi_sitewide ],
	];

	$my_sitewide_messages = get_posts( $args_sitewide_messages );

	if ( ! empty( $my_sitewide_messages ) ) {
		foreach ( $my_sitewide_messages as $post ) {
			setup_postdata( $post );
			$exclude_ids[] = $post->ID;
			$message_type = get_field( 'message_type' );
			render_warning_card( $message_type );
		}
		wp_reset_postdata();
	}
}
?>

<?php
// ===== SEZIONE 5: Avvisi specifici per singolo contenuto =====
$meta_query_avvisi_singlecontent = [
	[
		'key' => 'scadenza_avviso_specific_content',
		'value' => $today,
		'compare' => '>='
	]
];

$args_singlecontent_messages = [
	'post_type' => 'avviso_content_cpt',
	'posts_per_page' => 10,
	'meta_query' => $meta_query_avvisi_singlecontent,
	'post__not_in' => $exclude_ids
];

$my_singlecontent_messages = get_posts( $args_singlecontent_messages );

if ( ! empty( $my_singlecontent_messages ) ) {
	foreach ( $my_singlecontent_messages as $post ) {
		setup_postdata( $post );
		$message_type = get_field( 'message_type' );
		render_warning_card( $message_type );
	}
	wp_reset_postdata();
}
?>

<?php
/**
 * Funzione helper per renderizzare le card di warning/restricted
 *
 * @param string $message_type Tipo di messaggio: 'warning' o 'restricted'
 */
function render_warning_card( $message_type = 'warning' ) {
	$card_class = $message_type === 'warning' ? 'warning' : 'restricted';
	$icon_class = $message_type === 'warning' ? 'icon-warning' : 'icon-reserved';
	?>
	<aside class="card <?php echo esc_attr( $card_class ); ?>">
		<div class="card_inner warning-card">
			<span class="icon <?php echo esc_attr( $icon_class ); ?>"></span>
			<h2 class="as-h5 allupper">
				<?php the_title(); ?>
			</h2>
			<?php the_content(); ?>
		</div>
	</aside>
	<?php
}
?>