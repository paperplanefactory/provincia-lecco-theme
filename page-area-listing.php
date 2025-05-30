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
while ( have_posts() ) :
	the_post();
	// aggiorno le visualizzazioni
	provincia_lecco_set_post_view();
	// verifico il tipo di contenuto da elencare
	$listing_page_cpt_listed = get_field( 'listing_page_cpt_listed' );
	// verifico se è una pagina di primo o di secondo livello
	$listing_page_level = get_field( 'listing_page_level' );
	// verifico di quale area fa parte
	$listing_page_taxonmy = get_field( 'listing_page_taxonmy' );
	if ( $listing_page_taxonmy === 'amministrazione_tax' ) {
		// contenuti da elencare in evidenza
		$listing_page_highlight_contents = get_field( 'listing_page_highlight_contents_amministrazione' );
		// custom post type per listing
		$cpt_query = 'amministrazione_cpt';
		// termine di tassonomia per listing
		$tax_query = get_field( 'listing_page_level_second_taxonmy_amministrazione' );
	}
	if ( $listing_page_taxonmy === 'servizi_tax' ) {
		// contenuti da elencare in evidenza
		$listing_page_highlight_contents = get_field( 'listing_page_highlight_contents_servizi' );
		// custom post type per listing
		$cpt_query = 'servizi_cpt';
		// termine di tassonomia per listing
		$tax_query = get_field( 'listing_page_level_second_taxonmy_servizi' );
	}
	if ( $listing_page_taxonmy === 'documenti_tax' ) {
		// contenuti da elencare in evidenza
		$listing_page_highlight_contents = get_field( 'listing_page_highlight_contents_documenti' );
		$cpt_query = 'documenti_cpt';
		// termine di tassonomia per listing
		$tax_query = get_field( 'listing_page_level_second_taxonmy_documenti' );
	}
	if ( $listing_page_taxonmy === 'category' ) {
		// contenuti da elencare in evidenza
		$listing_page_highlight_contents = get_field( 'listing_page_highlight_contents_novita' );
		// progetti da elencare in evidenza
		$listing_page_highlight_progetti = get_field( 'listing_page_highlight_progetti' );
		// custom post type per listing
		$cpt_query = 'post';
		// termine di tassonomia per listing
		$tax_query = get_field( 'listing_page_level_second_taxonmy_novita' );
	}
	if ( $listing_page_taxonmy === 'argomenti_tax' ) {
		// contenuti da elencare in evidenza
		$listing_page_highlight_contents = get_field( 'listing_page_highlight_argomenti' );
		// custom post type per listing
		$cpt_query = 'argomento_cpt';
	}
	if ( $listing_page_taxonmy === 'progetti_cpt' ) {
		// contenuti da elencare in evidenza
		$listing_page_highlight_contents = get_field( 'listing_page_highlight_progetti' );
		// custom post type per listing
		$cpt_query = 'progetti_cpt';
	}

	// verifico se è impostato un filtro sui bandi
	$listing_bandi = get_field( 'listing_bandi' );
	if ( $listing_bandi == 1 ) {
		$archivio_bandi_scaduti = get_field( 'archivio_bandi_scaduti' );
		$link_bandi_scaduti = get_field( 'link_bandi_scaduti' );
	} else {
		$listing_bandi = 0;
		$archivio_bandi_scaduti = 0;
	}

	// verifico se è una pagina di primo livello
	if ( $listing_page_level === 'primo-livello' ) {
		$tax_query_multiple = get_terms( array(
			'taxonomy' => $listing_page_taxonmy,
			'hide_empty' => true,
			//'parent' => 0
		)
		);
		$tax_terms = '';
		foreach ( $tax_query_multiple as $tax ) {
			//$tax_query_longlist .= '<input type="hidden" name="' . $listing_page_taxonmy . '[]" value="' . $tax->term_id . '">';
			$tax_terms .= $tax->term_id . ',';
			//$tax_query_longlist .= $tax->term_id;
		}
	}

	//imposto il colore di sfondo per il primo blocco di card che viene poi annullato se ci sono contenuti in evidenza
	$color_block = 'bg-9';
	$listing_page = 1;
	?>

	<section class="wrapper">
		<section class="wrapper-padded">
			<div class="wrapper-padded-intro">
				<div class="page-opening-padder">
					<nav class="breadcrumbs-holder grey-links undelinked-links" aria-label="Percorso"
						typeof="BreadcrumbList" vocab="http://schema.org/">
						<?php bcn_display(); ?>
					</nav>
					<div class="flex-hold flex-hold-page-opening">
						<div class="page-opening-left">
							<h1>
								<?php the_title(); ?>
							</h1>
							<?php if ( get_field( 'page_abstract' ) ) : ?>
								<p class="paragraph-variant">
									<?php the_field( 'page_abstract' ); ?>
								</p>
							<?php endif; ?>
							<?php if ( $listing_page_taxonmy != 'progetti_cpt' ) : ?>
								<form action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>"
									class="search-form banner-form">
									<label for="keyword">Parola chiave</label>
									<input type="text" name="search-kw" id="keyword"
										placeholder='Cerca in "<?php the_title(); ?>"' />
									<?php if ( $listing_page_level === 'primo-livello' ) : ?>
										<input type="hidden" name="<?php echo $listing_page_taxonmy; ?>[]"
											value="<?php echo $tax_terms; ?>">
									<?php else : ?>
										<input type="hidden" name="<?php echo $listing_page_taxonmy; ?>[]"
											value="<?php echo $tax_query; ?>">
									<?php endif; ?>
									<button class="button-appearance-normalizer" type="submit" aria-label="Cerca"><span
											class="icon-search"></span></button>
								</form>
							<?php endif; ?>

						</div>
						<div class="page-opening-right">
							<div class="padder">
								<?php if ( $listing_page_taxonmy === 'argomenti' ) : ?>
									<h2 class="as-h6 txt-1 allupper">Tutti gli argomenti</h2>
									<?php intro_menu_list_argomenti(); ?>
								<?php else : ?>
									<?php if ( $listing_page_level === 'primo-livello' ) {
										intro_menu_list_subpage_items();
									} elseif ( $listing_page_level === 'secondo-livello' ) {
										intro_menu_list_parent_subpage_items();
									} elseif ( $listing_page_level === 'terzo-livello' ) {
										intro_menu_list_parent_parent_subpage_items();
									}
									?>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
	</section>
<?php endwhile; ?>


<?php
// contentui in evidenza se non c'è paginazione
if ( $listing_page_highlight_contents && ! is_paged() ) :
	$color_block = '';
	?>
	<section class="wrapper bg-9">
		<div class="wrapper-padded">
			<div class="wrapper-padded-more">
				<div class="listing-box">
					<h2>In evidenza</h2>
					<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
						<?php foreach ( $listing_page_highlight_contents as $post ) :
							setup_postdata( $post ); ?>
							<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
						<?php endforeach;
						wp_reset_postdata(); ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
// listing progetti
if ( $listing_page_taxonmy === 'progetti_cpt' ) :
	$listing_page_level_progetti_listing_order = get_field( 'listing_page_level_progetti_listing_order' );
	$display_h3 = 1;
	?>
	<?php
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	if ( $listing_page_level_progetti_listing_order === 'alpha-order' ) {
		$args_all_progetti = array(
			'post_type' => 'progetti_cpt',
			'posts_per_page' => 15,
			'orderby' => 'title',
			'order' => 'ASC',
			'paged' => $paged,
		);
	} else {
		$args_all_progetti = array(
			'post_type' => 'progetti_cpt',
			'posts_per_page' => 15,
			'orderby' => 'menu_order',
			'sort_order' => 'ASC',
			'paged' => $paged,
		);
	}
	$all_progetti = new WP_Query( $args_all_progetti );
	if ( $all_progetti->have_posts() ) :
		?>
		<section class="wrapper <?php echo $color_block; ?>">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<div class="listing-box">
						<?php if ( get_field( 'custom_listing_title' ) ) : ?>
							<h2>
								<?php the_field( 'custom_listing_title' ); ?>
							</h2>
						<?php else : ?>
							<h2>Tutti i
								<?php the_title(); ?>
							</h2>
						<?php endif; ?>
						<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
							<?php while ( $all_progetti->have_posts() ) :
								$all_progetti->the_post(); ?>
								<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
							<?php endwhile;
							wp_reset_postdata(); ?>
						</ul>
						<?php wp_pagenavi( array( 'query' => $all_progetti ) ); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
<?php
		// listing di primo livello tranne news
	elseif ( $listing_page_level === 'primo-livello' && $listing_page_taxonmy != 'category' ) :
		$listing_page_level_first_listing_order = get_field( 'listing_page_level_first_listing_order' );
		$display_h3 = 1;
		?>
	<?php
	if ( $listing_page_level_first_listing_order === 'alpha-order' ) {
		$args_all_subpages = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'post_parent' => $post->ID,
			'orderby' => 'title',
			'order' => 'ASC'
		);
	} else {
		$args_all_subpages = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'post_parent' => $post->ID,
			'orderby' => 'menu_order',
			'sort_order' => 'ASC'
		);
	}

	$my_all_subpages = get_posts( $args_all_subpages );
	if ( ! empty( $my_all_subpages ) ) :
		?>
		<section class="wrapper <?php echo $color_block; ?>">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<div class="listing-box">
						<?php if ( get_field( 'custom_listing_title' ) ) : ?>
							<h2>
								<?php the_field( 'custom_listing_title' ); ?>
							</h2>
						<?php else : ?>
							<h2>Tutto su
								<?php the_title(); ?>
							</h2>
						<?php endif; ?>
						<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
							<?php foreach ( $my_all_subpages as $post ) :
								setup_postdata( $post ); ?>
								<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
							<?php endforeach;
							wp_reset_postdata(); ?>
						</ul>
					</div>
				</div>
			</div>
		</section>
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
	foreach ( $categories as $category ) : ?>
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
		if ( ! empty( $my_all_top_posts ) ) :
			?>
			<section class="wrapper <?php echo $color_block; ?>">
				<div class="wrapper-padded">
					<div class="wrapper-padded-more">
						<div class="listing-box">
							<h2>
								<?php echo $category->name; ?>
							</h2>
							<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
								<?php foreach ( $my_all_top_posts as $post ) :
									setup_postdata( $post ); ?>
									<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
								<?php endforeach;
								wp_reset_postdata(); ?>
							</ul>
							<div class="aligncenter">
								<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="square-button green filled">
									Vedi tutti <span class="screen-reader-text">i contenuti in
										<?php echo $category->name; ?></span>
								</a>
							</div>
						</div>

					</div>
				</div>
			</section>
		<?php endif; ?>
	<?php endforeach; ?>



	<?php
	// progetti
	$args_all_top_posts = array(
		'post_type' => 'progetti_cpt',
		'posts_per_page' => 3,
	);
	$my_all_top_posts = get_posts( $args_all_top_posts );
	if ( ! empty( $my_all_top_posts ) ) :
		?>
		<section class="wrapper <?php echo $color_block; ?>">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<div class="listing-box">
						<h2>Progetti</h2>
						<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
							<?php foreach ( $my_all_top_posts as $post ) :
								setup_postdata( $post ); ?>
								<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
							<?php endforeach;
							wp_reset_postdata(); ?>
						</ul>
						<div class="aligncenter">
							<a href="<?php the_field( 'archives_url_progetti', 'any-lang' ); ?>"
								class="square-button green filled">
								Vedi tutti <span class="screen-reader-text">i progetti</span>
							</a>
						</div>
					</div>

				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	// contentui in evidenza se non c'è paginazione
	if ( $listing_page_highlight_progetti && ! is_paged() ) :
		$color_block = '';
		?>
		<section class="wrapper">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<div class="listing-box">
						<h2>Progetti</h2>
						<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
							<?php foreach ( $listing_page_highlight_progetti as $post ) :
								setup_postdata( $post ); ?>
								<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
							<?php endforeach;
							wp_reset_postdata(); ?>
						</ul>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>



<?php endif; ?>

<?php
// listing di secondo e terzo livello
if ( $listing_page_level === 'secondo-livello' || $listing_page_level === 'terzo-livello' || $listing_page_taxonmy === 'argomenti_tax' ) :
	?>
	<?php
	// verifico se è impostata come pagina per elencare i bandi
	if ( $listing_bandi == 1 ) {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		global $today;
		// verifico se è impostata come pagina per elencare i bandi in scadenza
		if ( ! $archivio_bandi_scaduti ) {
			$meta_query_bandi = array(
				array(
					'key' => 'scadenza_bando',
					'value' => $today,
					'compare' => '>=',
				),
			);
			$ordering = 'ASC';
		} else {
			// verifico se è impostata come pagina per elencare i bandi scaduti
			$meta_query_bandi = array(
				array(
					'key' => 'scadenza_bando',
					'value' => $today,
					'compare' => '<',
				),
			);
			$ordering = 'DESC';
		}
		// compongo la query per i bandi
		$args_all_cpts = array(
			'post_type' => $cpt_query,
			'posts_per_page' => 15,
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => $listing_page_taxonmy,
					'field' => 'term_ID',
					'terms' => $tax_query
				)
			),
			'order' => $ordering,
			'orderby' => 'meta_value',
			'meta_key' => 'scadenza_bando',
			'meta_query' => $meta_query_bandi,
		);
		$listing_paged = new WP_Query( $args_all_cpts );
	} else {
		// se non è impostata come pagina per elencare i bandi compongo la query per argomenti_cpt
		if ( $listing_page_taxonmy === 'argomenti_tax' ) {
			$compact_argomenti = 1;
			$args_all_cpts = array(
				'post_type' => $cpt_query,
				'posts_per_page' => 15,
				'paged' => $paged,
				'orderby' => 'title',
				'order' => 'ASC'
			);
			$listing_paged = new WP_Query( $args_all_cpts );
		}

		// se non è impostata come pagina per elencare i bandi compongo la query predefinita
		else {
			$listing_page_level_second_listing_order = get_field( 'listing_page_level_second_listing_order' );
			if ( $listing_page_level_second_listing_order === 'alpha-order' ) {
				$args_all_cpts = array(
					'post_type' => $cpt_query,
					'posts_per_page' => 15,
					'paged' => $paged,
					'tax_query' => array(
						array(
							'taxonomy' => $listing_page_taxonmy,
							'field' => 'term_ID',
							'terms' => $tax_query
						)
					),
					'orderby' => 'title',
					'order' => 'ASC',
				);
			} elseif ( $listing_page_level_second_listing_order === 'publication-date' ) {
				$args_all_cpts = array(
					'post_type' => $cpt_query,
					'posts_per_page' => 15,
					'paged' => $paged,
					'tax_query' => array(
						array(
							'taxonomy' => $listing_page_taxonmy,
							'field' => 'term_ID',
							'terms' => $tax_query
						)
					),
				);
			} elseif ( $listing_page_level_second_listing_order === 'last-name' ) {
				$args_all_cpts = array(
					'post_type' => $cpt_query,
					'posts_per_page' => 15,
					'paged' => $paged,
					'tax_query' => array(
						array(
							'taxonomy' => $listing_page_taxonmy,
							'field' => 'term_ID',
							'terms' => $tax_query
						)
					),
					'meta_key' => 'cognome_order',
					'orderby' => 'meta_value',
					'order' => 'ASC',
				);
			} else {
				$args_all_cpts = array(
					'post_type' => $cpt_query,
					'posts_per_page' => 15,
					'paged' => $paged,
					'tax_query' => array(
						array(
							'taxonomy' => $listing_page_taxonmy,
							'field' => 'term_ID',
							'terms' => $tax_query
						)
					),
					'orderby' => 'menu_order',
					'order' => 'ASC',
				);
			}

			$listing_paged = new WP_Query( $args_all_cpts );
		}
	}
	if ( $listing_paged->have_posts() ) :
		?>
		<section class="wrapper <?php echo $color_block; ?>">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<div class="listing-box">
						<div class="flex-hold flex-hold-2 margins-fit verticalize opening-child-right">
							<div class="flex-hold-child">
								<?php if ( $listing_bandi == 1 && $archivio_bandi_scaduti == 0 ) : ?>
									<h2>
										<?php the_title(); ?> in scadenza
									</h2>
								<?php else : ?>
									<h2>
										<?php the_title(); ?>
									</h2>
								<?php endif; ?>
							</div>
							<?php if ( $listing_bandi == 1 && $archivio_bandi_scaduti == 0 ) : ?>
								<div class="flex-hold-child">
									<a href="<?php echo $link_bandi_scaduti; ?>" class="square-button green filled">
										<?php the_title(); ?> scaduti
									</a>
								</div>
							<?php endif; ?>
						</div>
						<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
							<?php while ( $listing_paged->have_posts() ) :
								$listing_paged->the_post(); ?>
								<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
							<?php endwhile;
							wp_reset_postdata(); ?>
						</ul>
						<?php wp_pagenavi( array( 'query' => $listing_paged ) ); ?>
					</div>
				</div>
			</div>
		</section>
	<?php else : ?>
		<section class="wrapper">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<div class="listing-box">
						<div class="flex-hold flex-hold-2 margins-fit verticalize opening-child-right">
							<div class="flex-hold-child">
								<?php if ( $listing_bandi == 1 && $archivio_bandi_scaduti == 0 ) : ?>
									<h2>
										<?php the_title(); ?> in scadenza
									</h2>
								<?php else : ?>
									<h2>
										<?php the_title(); ?>
									</h2>
								<?php endif; ?>
							</div>
							<?php if ( $listing_bandi == 1 && $archivio_bandi_scaduti == 0 ) : ?>
								<div class="flex-hold-child">
									<a href="<?php echo $link_bandi_scaduti; ?>" class="square-button green filled">
										<?php the_title(); ?> scaduti
									</a>
								</div>
							<?php endif; ?>
						</div>
						<h2>Non sono disponibili contenuti in questa area</h2>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>


<?php
if ( $listing_page_taxonmy != 'argomenti_tax' ) :
	?>
	<section class="wrapper">
		<div class="wrapper-padded">
			<div class="wrapper-padded-more">
				<div class="tag-box">
					<div class="aligncenter">
						<p class="as-h6 txt-1 allupper">Altri argomenti</p>
						<ul class="tags-holder">
							<?php list_all_argomenti_pills(); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php get_footer(); ?>