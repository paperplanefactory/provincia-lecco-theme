<?php
/**
 * Paperplane _blankTheme
 * Template Name: Pagina risultati ricerca
 */

// Costanti
define( 'SEARCH_POSTS_PER_PAGE', 24 );
define( 'DEFAULT_ORDER_BY', 'date' );
define( 'DEFAULT_ORDER', 'DESC' );

get_header();

// Classe per gestire la logica di ricerca
class SearchResultsHandler {

	private $search_params;
	private $tax_query;

	public function __construct() {
		$this->search_params = $this->sanitize_search_parameters();
		$this->tax_query = $this->build_taxonomy_query();
	}

	/**
	 * Sanitizza tutti i parametri di ricerca
	 */
	private function sanitize_search_parameters() {
		return [
			'search_kw' => isset( $_GET['search-kw'] ) ? sanitize_text_field( $_GET['search-kw'] ) : '',
			'results_order' => isset( $_GET['results_order'] ) ? sanitize_key( $_GET['results_order'] ) : DEFAULT_ORDER_BY,
			'amministrazione_tax' => isset( $_GET['amministrazione_tax'] ) ? array_map( 'absint', (array) $_GET['amministrazione_tax'] ) : [],
			'servizi_tax' => isset( $_GET['servizi_tax'] ) ? array_map( 'absint', (array) $_GET['servizi_tax'] ) : [],
			'category' => isset( $_GET['category'] ) ? array_map( 'absint', (array) $_GET['category'] ) : [],
			'documenti_tax' => isset( $_GET['documenti_tax'] ) ? array_map( 'absint', (array) $_GET['documenti_tax'] ) : [],
			'argomenti_tax' => isset( $_GET['argomenti_tax'] ) ? array_map( 'absint', (array) $_GET['argomenti_tax'] ) : []
		];
	}

	/**
	 * Verifica se ci sono filtri attivi
	 */
	public function has_active_filters() {
		$filter_params = [ 'amministrazione_tax', 'servizi_tax', 'category', 'documenti_tax', 'argomenti_tax' ];
		foreach ( $filter_params as $param ) {
			if ( ! empty( $this->search_params[ $param ] ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Costruisce la tax_query in base ai parametri
	 */
	private function build_taxonomy_query() {
		$tax_query = [ 'relation' => 'OR' ];

		// Se solo argomenti_tax è impostato
		if ( $this->is_only_topics_filter() ) {
			return $this->build_simple_taxonomy_query( 'argomenti_tax' );
		}

		// Altrimenti processa tutte le tassonomie
		$taxonomies = [
			'amministrazione_tax' => 'amministrazione_tax',
			'servizi_tax' => 'servizi_tax',
			'documenti_tax' => 'documenti_tax',
			'category' => 'category'
		];

		foreach ( $taxonomies as $param => $taxonomy ) {
			if ( ! empty( $this->search_params[ $param ] ) ) {
				$tax_query[] = $this->process_taxonomy_terms( $taxonomy, $this->search_params[ $param ] );
			}
		}

		return $tax_query;
	}

	/**
	 * Verifica se è attivo solo il filtro per argomenti
	 */
	private function is_only_topics_filter() {
		$other_filters = [ 'amministrazione_tax', 'servizi_tax', 'category', 'documenti_tax' ];
		foreach ( $other_filters as $filter ) {
			if ( ! empty( $this->search_params[ $filter ] ) ) {
				return false;
			}
		}
		return ! empty( $this->search_params['argomenti_tax'] );
	}

	/**
	 * Costruisce una query semplice per una singola tassonomia
	 */
	private function build_simple_taxonomy_query( $taxonomy ) {
		return [
			[
				'taxonomy' => $taxonomy,
				'field' => 'term_id',
				'terms' => $this->search_params[ $taxonomy ]
			]
		];
	}

	/**
	 * Processa i termini di una tassonomia
	 */
	private function process_taxonomy_terms( $taxonomy, $terms ) {
		// Se è combinata con argomenti
		if ( ! empty( $this->search_params['argomenti_tax'] ) ) {
			return [
				'relation' => 'AND',
				[
					'taxonomy' => $taxonomy,
					'field' => 'term_id',
					'terms' => $this->parse_terms_array( $terms )
				],
				[
					'taxonomy' => 'argomenti_tax',
					'field' => 'term_id',
					'terms' => $this->search_params['argomenti_tax']
				]
			];
		}

		return [
			'taxonomy' => $taxonomy,
			'field' => 'term_id',
			'terms' => $this->parse_terms_array( $terms )
		];
	}

	/**
	 * Parsa e pulisce l'array dei termini
	 */
	private function parse_terms_array( $terms ) {
		if ( is_array( $terms ) && isset( $terms[0] ) && is_string( $terms[0] ) ) {
			$terms_string = rtrim( $terms[0], ',' );
			$terms_array = explode( ',', $terms_string );
			return array_filter( array_map( 'intval', $terms_array ) );
		}
		return is_array( $terms ) ? $terms : [ $terms ];
	}

	/**
	 * Ottiene i parametri di ordinamento
	 */
	private function get_order_parameters() {
		switch ( $this->search_params['results_order'] ) {
			case 'title':
				return [ 'orderby' => 'title', 'order' => 'ASC' ];
			case 'date':
			default:
				return [ 'orderby' => DEFAULT_ORDER_BY, 'order' => DEFAULT_ORDER ];
		}
	}

	/**
	 * Esegue la query di ricerca
	 */
	public function execute_search() {
		$order_params = $this->get_order_parameters();

		$query_args = array_merge( [
			'post_type' => [ 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt', 'amm_trasp_cpt' ],
			's' => $this->search_params['search_kw'],
			'paged' => get_query_var( 'paged' ),
			'posts_per_page' => SEARCH_POSTS_PER_PAGE,
			'tax_query' => $this->tax_query
		], $order_params );

		return new WP_Query( $query_args );
	}

	/**
	 * Getter per i parametri
	 */
	public function get_search_keyword() {
		return $this->search_params['search_kw'];
	}

	public function get_results_order() {
		return $this->search_params['results_order'];
	}
}

// Inizializza il gestore della ricerca
$search_handler = new SearchResultsHandler();
$search_query = $search_handler->execute_search();

// Variabili per il template
$search_kw = $search_handler->get_search_keyword();
$results_order = $search_handler->get_results_order();
$remove_filters = $search_handler->has_active_filters() ? 1 : 0;
$search_result_card = 1; // per visualizzazione compatta
?>

<div class="wrapper">
	<div class="wrapper-padded">
		<div class="wrapper-padded-intro">
			<div class="single-content-opening-padder">
				<nav class="breadcrumbs-holder grey-links undelinked-links" aria-label="Percorso"
					typeof="BreadcrumbList" vocab="http://schema.org/">
					<?php bcn_display(); ?>
				</nav>
				<div class="inpage-searchform">

					<h1 class="as-h4 txt-1">
						<?php if ( $search_kw != '' ) : ?>
							Hai cercato: <?php echo esc_attr( $search_kw ); ?>
						<?php else : ?>
							Effettua una ricerca
						<?php endif; ?>
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<form method="get" action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" id="search-filters"
	autocomplete="off" class="suggested-results-form-js search-form">
	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="wrapper-padded-intro">
				<div class="search-form overlay-form">
					<label for="search-kw-inpage-search-input">Digita una parola chiave per la ricerca:</label>
					<input id="search-kw-inpage-search-input" type="text" name="search-kw" class=""
						placeholder="Cerca informazioni, persone, servizi" role="combobox" maxlength="100"
						autocomplete="off" spellcheck="true" value="<?php echo esc_attr( $search_kw ); ?>" />

					<button type="submit" class="search-submit search-submit-js" aria-label="Cerca">
						<span class="icon-search"></span>
					</button>

				</div>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="wrapper-padded-more">
				<div class="flex-hold flex-hold-search-page ">
					<div class="search-page-left">
						<div class="sticky-element sticky-columns-js">
							<div class="padder">
								<div class="sticky-element sticky-columns-js">
									<div class="search-column">
										<button onclick="event.preventDefault(); pageIndexMenuControlsMobile(this)"
											class="mobile-only index-menu-expander index-menu-expander-only-mobile-js button-appearance-normalizer button-typo-normalizer"
											aria-expanded="false" aria-label="Apri il pannello dei filtri di ricerca"
											data-collapsed="Apri il pannello dei filtri di ricerca"
											data-expanded="Chiudi il pannello dei filtri di ricerca">
											Filtri di ricerca<span class="icon-expand"></span>
										</button>
										<div class="index-menu-only-mobile-js">
											<div class="order-filter">
												<h2 class="as-h5 allupper txt-4">Ordina per</h2>
												<label for="order-results">Riordina i risultati della ricerca:</label>
												<select id="order-results" name="results_order"
													class="order-results order-results-js">
													<option value="date" <?php selected( $results_order, 'date' ); ?>>
														Data
													</option>
													<option value="title" <?php selected( $results_order, 'title' ); ?>>
														Titolo</option>
												</select>
											</div>
											<h2 class="as-h5 allupper txt-4">Categorie</h2>
											<?php
											// Configurazione tassonomie
											$taxonomies_config = [
												[ 'name' => 'Amministrazione', 'slug' => 'amministrazione_tax', 'js_name' => 'amministrazione' ],
												[ 'name' => 'Servizi', 'slug' => 'servizi_tax', 'js_name' => 'servizi' ],
												[ 'name' => 'Novità', 'slug' => 'category', 'js_name' => 'novita' ],
												[ 'name' => 'Documenti e dati', 'slug' => 'documenti_tax', 'js_name' => 'documenti' ]
											];

											foreach ( $taxonomies_config as $tax ) {
												$tax_search_parameter = $tax['slug'] . '[]';
												search_results_tax_listing( $tax['name'], $tax['slug'], $tax_search_parameter, $tax['js_name'] );
											}
											?>
											<h2 class="as-h5 allupper txt-4">Argomenti</h2>
											<?php search_results_argomenti_tax_listing(); ?>

											<div class="filters-submit-hold">
												<button type="submit" class="search-def-submit">Applica filtri</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
</form>
<div class="search-page-right">
	<div class="padder">
		<div class="flex-hold flex-hold-2 margins-thin bordered bottom intro-search-results-padder verticalize">
			<div class="flex-hold-child">
				<?php
				$count = $search_query->found_posts;
				echo absint( $count );
				echo ( $count == 1 ) ? ' risultato' : ' risultati';
				?>
				<?php if ( $remove_filters ) : ?>
					<h2 class="as-h5 allupper eraser-btn">
						<a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>?search-kw=<?php echo urlencode( $search_kw ); ?>"
							class="green-link">Elimina filtri</a>
					</h2>
				<?php endif; ?>
			</div>
			<div class="flex-hold-child"></div>
		</div>

		<?php if ( $search_query->have_posts() ) : ?>
			<ul class="flex-hold flex-hold-3 margins-thin search-results">
				<?php while ( $search_query->have_posts() ) :
					$search_query->the_post(); ?>
					<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>

		<?php
		wp_reset_postdata();
		wp_pagenavi( [ 'query' => $search_query ] );
		?>
	</div>
</div>
</div>
</div>
</div>
</div>


<?php get_footer(); ?>