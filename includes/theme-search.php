<?php
/**
 * Funzioni helper da aggiungere al functions.php
 * per supportare il template di ricerca migliorato
 */

/**
 * Funzione per validare e sanitizzare i parametri di ricerca
 * 
 * @param array $params Array di parametri da validare
 * @return array Array sanitizzato
 */
function sanitize_search_filters( $params ) {
	$sanitized = [];

	foreach ( $params as $key => $value ) {
		switch ( $key ) {
			case 'search-kw':
				$sanitized[ $key ] = sanitize_text_field( $value );
				break;
			case 'results_order':
				$allowed_orders = [ 'date', 'title' ];
				$sanitized[ $key ] = in_array( $value, $allowed_orders ) ? $value : 'date';
				break;
			default:
				if ( is_array( $value ) ) {
					$sanitized[ $key ] = array_map( 'absint', $value );
				} else {
					$sanitized[ $key ] = absint( $value );
				}
				break;
		}
	}

	return $sanitized;
}

/**
 * Ottiene i termini di una tassonomia con caching
 * 
 * @param string $taxonomy Nome della tassonomia
 * @return array|WP_Error Array di termini o errore
 */
function get_cached_taxonomy_terms( $taxonomy ) {
	$cache_key = "taxonomy_terms_{$taxonomy}";
	$terms = wp_cache_get( $cache_key );

	if ( false === $terms ) {
		$terms = get_terms( [ 
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
			'hierarchical' => false
		] );

		if ( ! is_wp_error( $terms ) ) {
			wp_cache_set( $cache_key, $terms, '', HOUR_IN_SECONDS );
		}
	}

	return $terms;
}

/**
 * Costruisce URL per rimuovere filtri specifici
 * 
 * @param array $current_params Parametri attuali
 * @param string $filter_to_remove Filtro da rimuovere
 * @return string URL pulito
 */
function build_filter_removal_url( $current_params, $filter_to_remove = null ) {
	$base_url = get_field( 'archives_url_ricerca', 'any-lang' );

	if ( $filter_to_remove ) {
		unset( $current_params[ $filter_to_remove ] );
	} else {
		// Rimuovi tutti i filtri tranne search-kw
		$search_kw = isset( $current_params['search-kw'] ) ? $current_params['search-kw'] : '';
		$current_params = [ 'search-kw' => $search_kw ];
	}

	return add_query_arg( $current_params, $base_url );
}

/**
 * Classe SearchQueryBuilder per costruire query complesse
 */
class SearchQueryBuilder {

	private $post_types = [ 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt', 'amm_trasp_cpt' ];
	private $args = [];

	public function __construct() {
		$this->args = [ 
			'post_type' => $this->post_types,
			'posts_per_page' => 24,
			'paged' => get_query_var( 'paged' ),
			'orderby' => 'date',
			'order' => 'DESC'
		];
	}

	/**
	 * Imposta la keyword di ricerca
	 */
	public function search( $keyword ) {
		if ( ! empty( $keyword ) ) {
			$this->args['s'] = sanitize_text_field( $keyword );
		}
		return $this;
	}

	/**
	 * Imposta l'ordinamento
	 */
	public function order_by( $orderby, $order = 'DESC' ) {
		$allowed_orderby = [ 'date', 'title', 'relevance' ];
		$allowed_order = [ 'ASC', 'DESC' ];

		if ( in_array( $orderby, $allowed_orderby ) ) {
			$this->args['orderby'] = $orderby;
		}

		if ( in_array( $order, $allowed_order ) ) {
			$this->args['order'] = $order;
		}

		return $this;
	}

	/**
	 * Aggiunge filtri tassonomia
	 */
	public function add_taxonomy_filters( $taxonomies ) {
		if ( empty( $taxonomies ) ) {
			return $this;
		}

		$tax_query = [ 'relation' => 'OR' ];

		foreach ( $taxonomies as $taxonomy => $terms ) {
			if ( ! empty( $terms ) ) {
				$tax_query[] = [ 
					'taxonomy' => $taxonomy,
					'field' => 'term_id',
					'terms' => is_array( $terms ) ? $terms : [ $terms ]
				];
			}
		}

		if ( count( $tax_query ) > 1 ) {
			$this->args['tax_query'] = $tax_query;
		}

		return $this;
	}

	/**
	 * Imposta il numero di post per pagina
	 */
	public function posts_per_page( $count ) {
		$this->args['posts_per_page'] = absint( $count );
		return $this;
	}

	/**
	 * Esegue la query
	 */
	public function get_query() {
		return new WP_Query( $this->args );
	}

	/**
	 * Ottiene gli argomenti della query
	 */
	public function get_args() {
		return $this->args;
	}
}

/**
 * Factory per creare query di ricerca
 * 
 * @return SearchQueryBuilder
 */
function create_search_query() {
	return new SearchQueryBuilder();
}

/**
 * Ottiene statistiche di ricerca per debugging/analytics
 * 
 * @param WP_Query $query Query di ricerca
 * @return array Statistiche
 */
function get_search_stats( $query ) {
	return [ 
		'total_results' => $query->found_posts,
		'current_page' => max( 1, get_query_var( 'paged' ) ),
		'total_pages' => $query->max_num_pages,
		'posts_per_page' => $query->get( 'posts_per_page' ),
		'query_time' => timer_stop( 0, 3 ),
		'sql_query' => $query->request
	];
}