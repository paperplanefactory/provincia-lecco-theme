<?php
/**
 *  Paperplane _blankTheme
 * Template Name: Home page
 */
get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<h1 class="screen-reader-text">Home page sito istituzionale della Provincia di Lecco</h1>
	<?php
	$gestione_notizia_evidenza = get_field( 'gestione_notizia_evidenza' );
	if ( $gestione_notizia_evidenza === 'evidenza-auto' ) {
		$args_notizia_evidenza = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
		);
		$my_notizia_evidenza = get_posts( $args_notizia_evidenza );
	} else {
		$my_notizia_evidenza = get_field( 'handpicked_notizia_evidenza' );

	}
	?>


	<?php if ( ! empty( $my_notizia_evidenza ) ) : ?>
		<?php
		foreach ( $my_notizia_evidenza as $post ) :
			setup_postdata( $post );
			$my_id = get_the_ID();
			?>

			<div class="wrapper">
				<div class="wrapper-padded">
					<div class="wrapper-padded-more">
						<div class="flex-hold flex-hold-2 margins-fit card intro-box">
							<article class="flex-hold-child text-box flex-hold verticalize">
								<div class="intro-news-padder">
									<div
										class="category-holder cat-fill-a preserve-text underlined-links-on-hover remove-underline-js">
										<?php content_tax(); ?>
									</div>
									<h2 class="element-hover txt-2">
										<?php the_title(); ?>
									</h2>
									<a href="<?php the_permalink(); ?>" class="card-link"><span
											class="screen-reader-text"><?php the_title(); ?></span></a>
									<?php if ( get_field( 'page_abstract' ) ) : ?>
										<p>
											<?php the_field( 'page_abstract' ); ?>
										</p>
									<?php endif; ?>
									<span class="arrow-button txt-4" aria-hidden="true">Leggi di più</span>
									<div class="tags-holder preserve-text underlined-links-on-hover remove-underline-js">
										<?php list_argomenti_pills(); ?>
									</div>
								</div>
							</article>
							<div class="flex-hold-child image-box full-image" aria-hidden="true">
								<div class="full-image">
									<?php
									$image_data = array(
										'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
										'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
										'size_fallback' => 'home_box'
									);
									$image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
										'retina' => 'home_box',
										'desktop' => 'home_box',
										'mobile' => 'home_box',
										'micro' => 'micro'
									);
									print_theme_image( $image_data, $image_sizes );
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;
		wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php
	$gestione_altre_notizie = get_field( 'gestione_altre_notizie' );
	if ( $gestione_altre_notizie === 'notizie-auto' ) {
		$args_altre_notizie = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'post__not_in' => array( $my_id ),
		);
		$my_altre_notizie = get_posts( $args_altre_notizie );
	} else {
		$my_altre_notizie = get_field( 'handpicked_notizie' );

	}
	?>

	<?php if ( ! empty( $my_altre_notizie ) ) : ?>
		<div class="wrapper bg-9">
			<span class="wrapper-step bg-12"></span>
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<ul class="flex-hold flex-hold-3 margins-wide grid-separator-1">
						<?php foreach ( $my_altre_notizie as $post ) :
							setup_postdata( $post ); ?>
							<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
						<?php endforeach;
						wp_reset_postdata(); ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>








	<?php
	global $today;
	$meta_query_bandi_attivi = array(
		array(
			'key' => 'scadenza_bando',
			'value' => $today,
			'compare' => '>'
		)
	);
	$args_scadenze = array(
		'post_type' => 'documenti_cpt',
		'posts_per_page' => 20,
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => 'scadenza_bando',
		'meta_query' => $meta_query_bandi_attivi,
	);
	$my_scadenze = get_posts( $args_scadenze );
	$slide_listing = 1;
	?>
	<?php if ( ! empty( $my_scadenze ) ) : ?>
		<div class="wrapper bg-9">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<h2>Le prossime scadenze</h2>
					<!-- cards-slideshow -->
					<div class="slide-four">
						<?php
						$card_source = 'slider';
						foreach ( $my_scadenze as $post ) :
							setup_postdata( $post ); ?>
							<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
							<?php
						endforeach;
						wp_reset_postdata();
						$card_source = 'list';
						?>
					</div>
					<!-- cards-slideshow -->
				</div>
			</div>
		</div>
	<?php endif; ?>












	<?php
	$argomenti_evidenza_immagine_apertura = get_field( 'argomenti_evidenza_immagine_apertura' );
	$argomenti_evidenza_immagine_apertura_URL = $argomenti_evidenza_immagine_apertura['sizes']['full_desk'];
	$argomenti_evidenza_contenuti = get_field( 'argomenti_evidenza_contenuti' );
	?>



	<div class="wrapper">
		<span class="wrapper-step-image">
			<span class="wrapper-step-image lazy with-bg-image"
				data-bg="<?php echo $argomenti_evidenza_immagine_apertura_URL; ?>">
			</span>
		</span>
		<div class="wrapper-padded">
			<div class="wrapper-padded-more">
				<div class="highlight-box">
					<h2 class="txt-12">Argomenti in evidenza</h2>
					<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
						<?php
						foreach ( $argomenti_evidenza_contenuti as $post ) :
							setup_postdata( $post );
							$argomento_title = get_the_title();
							$argomento_link = get_permalink();
							?>
							<!-- card singoli contenuti -->
							<li class="flex-hold-child card insite">
								<div class="card_inner regular-card">
									<?php //content_tax_maxi_icon(); ?>
									<div class="texts-holder compact">
										<h3 class="element-hover txt-2"><?php the_title(); ?></h3>
										<?php if ( get_field( 'page_abstract' ) ) : ?>
											<p>
												<?php the_field( 'page_abstract' ); ?>
											</p>
										<?php endif; ?>
									</div>
									<a href="<?php the_permalink(); ?>" class="card-link"><span
											class="screen-reader-text"><?php the_title(); ?></span></a>
									<div class="inner-news-listing">
										<?php
										$argomenti_tax = get_field( 'argomento_page_listing_term' );
										$args_list_argomento_content = array(
											'post_type' => array( 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt' ),
											'posts_per_page' => 3,
											//'order' => 'ASC',
											'tax_query' => array(
												array(
													'taxonomy' => 'argomenti_tax',
													'field' => 'term_id',
													'terms' => $argomenti_tax
												)
											),
										);
										$my_list_argomento_content = get_posts( $args_list_argomento_content );
										?>
										<ul class="underlined-links-on-hover remove-underline-js">
											<?php foreach ( $my_list_argomento_content as $post ) :
												setup_postdata( $post ); ?>
												<li>
													<a href="<?php the_permalink(); ?>">
														<?php content_tax_icon_no_link(); ?>
														<?php the_title(); ?>
													</a>
												</li>
											<?php endforeach;
											wp_reset_postdata(); ?>
										</ul>
									</div>
								</div>
								<div class="cta-holder" aria-hidden="true">
									<span class="arrow-button txt-4">Esplora argomento</span>
								</div>

							</li>
							<!-- card singoli contenuti -->
						<?php endforeach;
						wp_reset_postdata(); ?>
					</ul>
					<div class="aligncenter">
						<p class="as-h6 txt-1 allupper">Altri argomenti</p>
						<ul class="tags-holder">
							<?php list_all_argomenti_pills(); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>









	<?php
	$my_siti_tematici = get_field( 'siti_tematici' );
	if ( ! empty( $my_siti_tematici ) ) :
		?>
		<div class="wrapper">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more">
					<div class="thematic-box">
						<h2>Siti tematici</h2>
						<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
							<?php foreach ( $my_siti_tematici as $post ) :
								setup_postdata( $post ); ?>
								<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
							<?php endforeach;
							wp_reset_postdata(); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>








	<?php
	$box_ricerca_immagine_apertura = get_field( 'box_ricerca_immagine_apertura' );
	$box_ricerca_immagine_apertura_URL = $box_ricerca_immagine_apertura['sizes']['full_desk'];
	?>
	<div class="wrapper lazy with-bg-image" data-bg="<?php echo $box_ricerca_immagine_apertura_URL; ?>">
		<div class="search-banner">
			<div class="wrapper-padded">
				<div class="wrapper-padded-more-780">
					<h2 class="screen-reader-text">Cerca</h2>
					<form class="banner-form" action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>"
						autocomplete="off">
						<label for="search-kw-home-input">Digita una parola chiave per la ricerca:</label>
						<input id="search-kw-home-input" name="search-kw" type="text" placeholder="cerca" />
						<button class="button-appearance-normalizer" aria-label="Cerca"><span
								class="icon-search"></span></button>
					</form>
					<ul class="search-suggestion-area">
					</ul>
					<?php
					$args_pagine_visitate = array(
						'post_type' => 'page',
						'posts_per_page' => 10,
						'order' => 'DESC',
						'orderby' => 'meta_value_num',
						'meta_key' => 'post_views_count'
					);
					$my_pagine_visitate = get_posts( $args_pagine_visitate );
					if ( ! empty( $my_pagine_visitate ) ) :
						?>
						<div class="desktop-only">
							<h2 class="screen-reader-text">Suggerimenti di navigazione</h2>
							<ul class="tags-holder">
								<?php foreach ( $my_pagine_visitate as $post ) :
									setup_postdata( $post ); ?>
									<li>
										<a href="<?php the_permalink(); ?>"
											class="square-button green filled"><?php the_title(); ?></a>
									</li>
								<?php endforeach;
								wp_reset_postdata(); ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>