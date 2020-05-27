<?php
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ja_global_enqueues() {


	wp_enqueue_script(
		'jquery-auto-complete',
		'https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js',
		array( 'jquery' ),
		'1.0.7',
		true
	);

	wp_enqueue_script(
		'global',
		get_template_directory_uri() . '/assets/js/global.min.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);

	wp_localize_script(
		'global',
		'global',
		array(
			'ajax' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'ja_global_enqueues' );

/**
 * Live autocomplete search feature.
 *
 * @since 1.0.0
 */
function ja_ajax_search() {

	$results = new WP_Query( array(
		'post_type' => array( 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt' ),
		'post_status' => 'publish',
		'nopaging' => true,
		'posts_per_page' => 100,
		's' => stripslashes( $_POST['search'] ),
	) );

	$items = array();

	if ( !empty( $results->posts ) ) {
		foreach ( $results->posts as $result ) {
			$items[] = $result->post_title;
		}
	}
	wp_send_json_success( $items );
}
add_action( 'wp_ajax_search_site', 'ja_ajax_search' );
add_action( 'wp_ajax_nopriv_search_site', 'ja_ajax_search' );
