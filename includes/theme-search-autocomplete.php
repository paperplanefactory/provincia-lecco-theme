<?php
/**
 * Sistema di Ricerca AJAX con Suggerimenti - Versione Finale
 * Include "Vedi tutti i risultati" senza debug
 */

function get_ajax_suggestions() {
	// Validazione e sanitizzazione input
	if ( ! isset( $_REQUEST['searchkw'] ) ) {
		wp_die( 'Parametro mancante', 'Errore', array( 'response' => 400 ) );
	}

	// Verifica nonce per sicurezza
	if ( ! verify_search_nonce() ) {
		wp_die( 'Accesso non autorizzato', 'Errore', array( 'response' => 403 ) );
	}

	$searchkw = sanitize_text_field( $_REQUEST['searchkw'] );

	// Validazione lunghezza
	if ( empty( $searchkw ) || strlen( trim( $searchkw ) ) < 2 ) {
		wp_send_json_error( 'Query troppo breve' );
		return;
	}

	// Limite caratteri per sicurezza
	if ( strlen( $searchkw ) > 100 ) {
		wp_send_json_error( 'Query troppo lunga' );
		return;
	}

	$start_search = strlen( $searchkw );
	$transient_name = "transient_search_suggestion_" . md5( $searchkw );

	if ( $start_search > 2 ) {
		$suggestions_transient = get_transient( $transient_name );
		if ( ! empty( $suggestions_transient ) ) {
			echo $suggestions_transient;
		} else {
			// Parametri query ottimizzati
			$args_suggestions = array(
				'post_type' => array( 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt', 'amm_trasp_cpt' ),
				'posts_per_page' => 10,
				'order' => 'DESC',
				'orderby' => 'relevance',
				's' => $searchkw,
				'post_status' => 'publish',
				'no_found_rows' => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			);

			$my_suggestions = get_posts( $args_suggestions );
			$response = '';

			if ( ! empty( $my_suggestions ) ) {
				foreach ( $my_suggestions as $post ) :
					setup_postdata( $post );
					$response .= '<li class="search-suggestion underlined-links-on-hover">';
					$post_type = get_post_type( $post->ID );

					// Configurazione tipi di post
					$post_type_config = array(
						'amministrazione_cpt' => array( 'taxonomy' => 'amministrazione_tax', 'name' => 'amministrazione' ),
						'post' => array( 'taxonomy' => 'category', 'name' => 'novità' ),
						'servizi_cpt' => array( 'taxonomy' => 'servizi_tax', 'name' => 'servizi' ),
						'documenti_cpt' => array( 'taxonomy' => 'documenti_tax', 'name' => 'documenti e dati' ),
						'amm_trasp_cpt' => array( 'taxonomy' => '', 'name' => 'Amministrazione trasparente' ),
					);

					$config = isset( $post_type_config[ $post_type ] ) ? $post_type_config[ $post_type ] : array( 'taxonomy' => '', 'name' => 'contenuto' );
					$taxonomy = $config['taxonomy'];
					$cpt_name = $config['name'];

					$response .= '<div class="h4-variant light">';

					if ( ! empty( $taxonomy ) ) {
						$icon_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => 0, 'hide_empty' => false ) );
						if ( ! is_wp_error( $icon_terms ) ) {
							foreach ( $icon_terms as $pterm ) {
								$tax_icon = get_field( 'taxonomy_term_icon', $pterm->taxonomy . '_' . $pterm->term_id );
								if ( ! empty( $tax_icon ) ) {
									$response .= '<a href="' . esc_url( get_term_link( $pterm ) ) . '" class="green-link">';
									$response .= '<span class="mini-icon ' . esc_attr( $tax_icon ) . '">';
									$response .= '</span>';
									$response .= '<span class="screen-reader-text">Archivio ' . esc_html( $pterm->name ) . '</span>';
									$response .= '</a>';
								}
							}
						}
					}

					// HTML sicuro con escape
					$response .= '<span class="suggested-result txt-3"><a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . esc_html( get_the_title( $post->ID ) ) . '</a></span>';
					$response .= '<span class="my-cpt as-h5 allupper txt-10">' . esc_html( $cpt_name ) . '</span>';
					$response .= '</div>';
					$response .= '</li>';
				endforeach;
				wp_reset_postdata();

				// Aggiungi "Vedi tutti i risultati" sempre quando ci sono 10 risultati (possibili altri)
				if ( count( $my_suggestions ) == 10 ) {
					$response .= '<li class="search-suggestion search-view-all" onclick="submitSearchForm(\'' . esc_js( $searchkw ) . '\')" data-search-term="' . esc_attr( $searchkw ) . '">';
					$response .= '<div class="view-all-results">';
					$response .= '<span class="icon-search-plus" aria-hidden="true"></span>';
					$response .= '<span class="view-all-text">Vedi tutti i risultati</span>';
					$response .= '<span class="view-all-subtitle">Mostra risultati completi</span>';
					$response .= '</div>';
					$response .= '</li>';
				}
			} else {
				// Messaggio quando non ci sono risultati
				$response .= '<li class="search-no-results">';
				$response .= '<div class="no-results-content">';
				$response .= '<span class="icon-search-empty" aria-hidden="true"></span>';
				$response .= '<span class="no-results-text">Nessun risultato trovato per "<strong>' . esc_html( $searchkw ) . '</strong>"</span>';
				$response .= '<span class="no-results-subtitle">Prova con parole chiave diverse o più generali</span>';
				$response .= '</div>';
				$response .= '</li>';
			}

			// Cache per 6 ore
			if ( ! empty( $response ) ) {
				set_transient( $transient_name, $response, 6 * HOUR_IN_SECONDS );
			}

			echo $response;
		}
	}

	wp_die();
}

// Fire AJAX action for both logged in and non-logged in users
add_action( 'wp_ajax_get_ajax_suggestions', 'get_ajax_suggestions' );
add_action( 'wp_ajax_nopriv_get_ajax_suggestions', 'get_ajax_suggestions' );

// Funzione per verificare nonce
function verify_search_nonce() {
	if ( isset( $_REQUEST['nonce'] ) && wp_verify_nonce( $_REQUEST['nonce'], 'search_suggestions_nonce' ) ) {
		return true;
	}
	return false;
}

function ajax_suggestions() {
	?>
	<script>
		// Variabili globali
		let searchTimeout;
		let currentRequest;

		// Debouncing per ridurre richieste
		function debounce(func, wait) {
			return function executedFunction(...args) {
				const later = () => {
					clearTimeout(searchTimeout);
					func(...args);
				};
				clearTimeout(searchTimeout);
				searchTimeout = setTimeout(later, wait);
			};
		}

		// Funzione di ricerca
		function getResults(kwpar) {
			// Cancella richiesta precedente se in corso
			if (currentRequest && currentRequest.readyState !== 4) {
				currentRequest.abort();
			}

			// Validazione input
			if (!kwpar || kwpar.trim().length < 3) {
				$('.search-suggestion-area').removeClass('active').html('');
				$('#search-kw-header-input').attr('aria-expanded', 'false');
				return;
			}

			// Limite caratteri
			if (kwpar.length > 100) {
				$('.search-suggestion-area').removeClass('active').html('');
				return;
			}

			// Loading state
			$('.search-suggestion-area').html('<li class="search-loading">Caricamento...</li>').addClass('active');
			$('#search-kw-header-input').attr('aria-expanded', 'true');

			currentRequest = $.ajax({
				type: 'POST',
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				dataType: "html",
				timeout: 8000,
				data: {
					action: 'get_ajax_suggestions',
					searchkw: kwpar.trim(),
					nonce: '<?php echo wp_create_nonce( "search_suggestions_nonce" ); ?>'
				},
				success: function (response) {
					if (!response || response.trim() === '') {
						$('.search-suggestion-area').removeClass('active').html('');
						$('#search-kw-header-input').attr('aria-expanded', 'false');
					} else {
						$('.search-suggestion-area').addClass('active').html(response);
						$('#search-kw-header-input').attr('aria-expanded', 'true');
					}
				},
				error: function (xhr, status, error) {
					$('.search-suggestion-area').removeClass('active').html('');
					$('#search-kw-header-input').attr('aria-expanded', 'false');

					if (status !== 'abort') {
						$('.search-suggestion-area').html('<li class="search-error">Errore nel caricamento dei suggerimenti</li>').addClass('active');
					}
				}
			});
		}

		// Funzione globale per submit form
		window.submitSearchForm = function (searchTerm) {
			// Prova con jQuery
			let $form = $('.suggested-results-form-js');
			let $input = $('.search-input-kw-js');

			// Fallback selettori
			if ($form.length === 0) $form = $('form[role="search"]');
			if ($input.length === 0) $input = $('input[name="search-kw"]');
			if ($input.length === 0) $input = $('#search-kw-header-input');

			if ($form.length > 0 && $input.length > 0) {
				// Nascondi suggerimenti
				$('.search-suggestion-area').removeClass('active').html('');
				$input.attr('aria-expanded', 'false');

				// Popola e sottometti
				$input.val(searchTerm);

				try {
					$form[0].submit();
					return;
				} catch (e) {
					// Continua con fallback
				}
			}

			// Fallback vanilla JS
			const form = document.querySelector('.suggested-results-form-js') ||
				document.querySelector('form[role="search"]') ||
				document.querySelector('form');

			const input = document.querySelector('.search-input-kw-js') ||
				document.querySelector('input[name="search-kw"]') ||
				document.querySelector('#search-kw-header-input');

			if (form && input) {
				// Nascondi suggerimenti
				const suggestions = document.querySelector('.search-suggestion-area');
				if (suggestions) {
					suggestions.classList.remove('active');
					suggestions.innerHTML = '';
				}

				input.value = searchTerm;
				input.setAttribute('aria-expanded', 'false');

				try {
					form.submit();
					return;
				} catch (e) {
					// Continua con ultimo fallback
				}
			}

			// Ultimo tentativo: redirect manuale
			const action = (form && form.getAttribute('action')) || '/';
			const url = action + (action.includes('?') ? '&' : '?') + 'search-kw=' + encodeURIComponent(searchTerm);
			window.location.href = url;
		};

		// Debounced search
		const debouncedSearch = debounce(getResults, 300);

		$('.search-input-kw-js').on('input paste', function () {
			const kwpar = $(this).val();
			debouncedSearch(kwpar);
		});

		$('.search-input-kw-js').on('focus', function () {
			const kwpar = $(this).val();
			if (kwpar && kwpar.trim().length > 2) {
				debouncedSearch(kwpar);
			}
		});

		$(document).ready(function () {
			// Gestione tasti di navigazione
			$('.search-input-kw-js').on('keydown', function (e) {
				const $suggestions = $('.search-suggestion-area li:not(.search-loading):not(.search-error)');
				const $current = $suggestions.filter('.highlighted');

				switch (e.key) {
					case 'Escape':
						$('.search-suggestion-area').removeClass('active');
						$(this).attr('aria-expanded', 'false');
						break;
					case 'ArrowDown':
						e.preventDefault();
						if ($current.length === 0) {
							$suggestions.first().addClass('highlighted');
						} else {
							const $next = $current.removeClass('highlighted').next();
							if ($next.length > 0) {
								$next.addClass('highlighted');
							} else {
								$suggestions.first().addClass('highlighted');
							}
						}
						break;
					case 'ArrowUp':
						e.preventDefault();
						if ($current.length === 0) {
							$suggestions.last().addClass('highlighted');
						} else {
							const $prev = $current.removeClass('highlighted').prev();
							if ($prev.length > 0) {
								$prev.addClass('highlighted');
							} else {
								$suggestions.last().addClass('highlighted');
							}
						}
						break;
					case 'Enter':
						if ($current.length > 0) {
							e.preventDefault();
							if ($current.hasClass('search-view-all')) {
								$current.click();
							} else {
								const link = $current.find('a').first()[0];
								if (link) link.click();
							}
						}
						break;
				}
			});

			// Gestione click fuori dall'area
			$(document).on('click', function (event) {
				const $target = $(event.target);
				const isOnExcludedElements =
					$target.hasClass('search-input-kw-js') ||
					$target.closest('.search-input-kw-js').length ||
					$target.hasClass('search-submit-js') ||
					$target.closest('.search-submit-js').length ||
					$target.hasClass('search-suggestion-area') ||
					$target.closest('.search-suggestion-area').length;

				if (!isOnExcludedElements) {
					$('.search-suggestion-area').removeClass('active');
					$('.search-input-kw-js').attr('aria-expanded', 'false');
				}
			});

			$(document).on('focusin', function (event) {
				const $target = $(event.target);
				const isOnExcludedElements =
					$target.hasClass('search-input-kw-js') ||
					$target.hasClass('search-submit-js') ||
					$target.closest('.search-suggestion-area').length;

				if (!isOnExcludedElements) {
					$('.search-suggestion-area').removeClass('active');
					$('.search-input-kw-js').attr('aria-expanded', 'false');
				}
			});

			// Previene la rimozione quando si clicca all'interno
			$('.search-input-kw-js, .search-submit-js, .search-suggestion-area').on('click', function (event) {
				event.stopPropagation();
			});

			// Hover su suggerimenti
			$(document).on('mouseenter', '.search-suggestion:not(.search-loading):not(.search-error)', function () {
				$('.search-suggestion').removeClass('highlighted');
				$(this).addClass('highlighted');
			});

			// Gestione click jQuery su "Vedi tutti i risultati"
			$(document).on('click', '.search-view-all', function (e) {
				e.preventDefault();
				e.stopPropagation();

				const searchTerm = $(this).data('search-term');

				if (window.submitSearchForm) {
					window.submitSearchForm(searchTerm);
				}
			});
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'ajax_suggestions' );