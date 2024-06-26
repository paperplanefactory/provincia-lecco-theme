<!-- card singoli contenuti -->
<?php
if ( ! isset( $display_h3 ) ) {
	$display_h3 = '';
}
if ( ! isset( $compact_card ) ) {
	$compact_card = '';
}
if ( ! isset( $slide_listing ) ) {
	$slide_listing = '';
}
if ( ! isset( $module_auto_listing_abstract ) ) {
	$module_auto_listing_abstract = '';
}
if ( ! isset( $listing_page ) ) {
	$listing_page = '';
}
// visualizzo sotto forma di CTA se impostato nel modulo di listing dei conteuti
if ( isset( $module_auto_listing_appearence ) && $module_auto_listing_appearence === 'module-listing-cta' ) : ?>
	<?php if ( get_post_type() === 'siti_tematici_cpt' ) : ?>
		<a href="<?php echo get_field( 'sito_tematico_url' ); ?>" class="tag-button filled-button" rel="noopener"
			title="Visita il sito <?php the_title(); ?>" aria-label="Visita il sito <?php the_title(); ?>"
			target="_blank"><?php the_title(); ?></a>
	<?php else : ?>
		<a href="<?php the_permalink(); ?>" class="tag-button filled-button" title="<?php the_title(); ?>"
			aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
	<?php endif; ?>
<?php
		// altrimenti visualizzo la card classica
	else :
		?>
	<?php
	// tipologia di card – risultato di ricerca
	if ( isset( $search_result_card ) && $search_result_card == 1 ) : ?>
		<article class="flex-hold-child card insite">
			<div class="card_inner regular-card">
				<div class="category-holder cat-fill-a grey-green-links">
					<?php content_tax(); ?>
				</div>
				<div class="texts-holder compact">
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
							aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
					<?php if ( get_field( 'page_abstract' ) ) : ?>
						<p>
							<?php
							$page_abstract = get_field( 'page_abstract' );
							shorten_abstract( $page_abstract, 150 );
							?>
						</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="cta-holder">
				<a href="<?php the_permalink(); ?>" class="arrow-button" title="Leggi di più su <?php the_title(); ?>"
					aria-label="Leggi di più su <?php the_title(); ?>">Leggi di più</a>
			</div>
		</article>
		<?php
		// tipologia di card – progetti o argomenti
	elseif ( $display_h3 != 2 && ( ( get_post_type() == 'progetti_cpt' ) ) || ( ( get_post_type() == 'argomento_cpt' ) ) ) :
		// tipologia di card – progetti o argomenti compatti
		if ( $compact_argomenti != 1 ) :
			?>
			<?php
			$thumb_id = get_post_thumbnail_id();
			if ( $thumb_id != '' ) {
				$thumb_url_desktop = wp_get_attachment_image_src( $thumb_id, 'column', true );
				$card_bg_image = $thumb_url_desktop[0];
			} else {
				$card_bg_image = get_bloginfo( 'template_directory' ) . '/assets/images/static-images/card-bg-preset.jpg';
			}

			?>
			<article class="flex-hold-child card autonomous-height insite lazy with-bg-image"
				data-bg="<?php echo $card_bg_image; ?>">
				<div class="card_inner image-card-big">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"
						class="absl"></a>
					<div class="image-card-content">
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
								aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					</div>

				</div>
			</article>
			<?php
			// tipologia di card – progetti o argomenti estesi
		else :
			?>
			<div class="flex-hold-child card insite">
				<div class="card_inner cap-card">
					<div class="last-child-no-margin">
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
								aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					</div>
				</div>
			</div>
		<?php endif; ?>

	<?php else : ?>
		<?php
		// tipologia di card – politico
		if ( has_term( 'politici', 'amministrazione_tax' ) && get_post_thumbnail_id() ) :
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_desktop = wp_get_attachment_image_src( $thumb_id, 'column', true );
			?>
			<article class="flex-hold-child card insite people-card">
				<div class="image-card-image-side lazy with-bg-image-side" data-bg="<?php echo $thumb_url_desktop[0]; ?>">
					<a class="absl" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
						aria-label="<?php the_title(); ?>"></a>
				</div>
				<div class="card_inner image-card">
					<div class="title-block">
						<h2 class="h4-variant"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
								aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<?php if ( get_field( 'ruolo_politico' ) ) : ?>
							<p>
								<?php the_field( 'ruolo_politico' ); ?>
							</p>
						<?php endif; ?>
					</div>
					<a href="<?php the_permalink(); ?>" title="Leggi di più su <?php the_title(); ?>"
						aria-label="Leggi di più su <?php the_title(); ?>" class="arrow-button">Leggi di più</a>
				</div>
			</article>
			<?php
			// card compatta per listing area in pagina argomento
		elseif ( $compact_card == 1 ) :
			?>
			<article class="flex-hold-child card insite">
				<div class="card_inner regular-card">
					<div class="category-holder cat-fill-a grey-green-links">
						<?php content_tax(); ?>
					</div>
					<div class="texts-holder-no-cta">
						<div class="last-child-no-margin">
							<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
									aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
							<?php if ( get_field( 'page_abstract' ) ) : ?>
								<p>
									<?php
									$page_abstract = get_field( 'page_abstract' );
									shorten_abstract( $page_abstract, 150 );
									?>
								</p>

							<?php endif; ?>
						</div>

					</div>
				</div>
			</article>
			<?php
			// tipologia di card – sito tematico
		elseif ( get_post_type() == 'siti_tematici_cpt' ) :
			//$site_color = get_field( 'sito_tematico_color' );
			?>
			<article class="flex-hold-child card offsite autonomous-height sito-tematico-colors">
				<a href="<?php echo get_field( 'sito_tematico_url' ); ?>" rel="noopener" title="Visita il sito <?php the_title(); ?>"
					aria-label="Visita il sito <?php the_title(); ?>" class="absl" target="_blank"></a>
				<div class="card_inner cap-card">
					<?php if ( get_post_thumbnail_id() ) : ?>
						<div class="flex-hold sito-tematico-grid">
							<div class="flex-hold-child-sito-tematico">
								<div class="sito-tematico-image">
									<?php
									$image_data = array(
										'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
										'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
										'size_fallback' => 'site_preview'
									);
									$image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
										'retina' => 'site_preview',
										'desktop' => 'site_preview',
										'mobile' => 'site_preview',
										'micro' => 'micro'
									);
									print_theme_image( $image_data, $image_sizes );
									?>
								</div>
							</div>
							<div class="flex-hold-child-sito-tematico">
								<h5><?php the_title(); ?></h5>
								<?php if ( get_field( 'page_abstract' ) ) : ?>
									<p>
										<?php
										$page_abstract = get_field( 'page_abstract' );
										shorten_abstract( $page_abstract, 150 );
										?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					<?php else : ?>
						<h5><?php the_title(); ?></h5>
						<?php if ( get_field( 'page_abstract' ) ) : ?>
							<p>
								<?php
								$page_abstract = get_field( 'page_abstract' );
								shorten_abstract( $page_abstract, 150 );
								?>
							</p>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</article>
			<?php
			// tipologia di card – tutte le altre card
		else :
			?>
			<article class="flex-hold-child card insite">
				<?php if ( $display_h3 == 2 ) : ?>
					<div class="card_inner compact-card">
					<?php else : ?>
						<div class="card_inner regular-card">
						<?php endif; ?>

						<?php if ( get_post_thumbnail_id() ) : ?>
							<div class="cover-image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>">
									<?php
									$image_data = array(
										'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
										'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
										'size_fallback' => 'card_listing'
									);
									$image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
										'retina' => 'card_listing',
										'desktop' => 'card_listing',
										'mobile' => 'card_listing_mobile',
										'micro' => 'micro'
									);
									print_theme_image( $image_data, $image_sizes );
									?>
								</a>
							</div>
						<?php endif; ?>
						<?php
						// stampo il bollo con la data per le card scadenze nello slideshow in homepage
						if ( $slide_listing == 1 ) :
							$scadenza_bando = get_field( 'scadenza_bando' );
							$giorno = date_i18n( 'j', strtotime( $scadenza_bando ) );
							$mese = date_i18n( 'F', strtotime( $scadenza_bando ) );
							$anno = date_i18n( 'Y', strtotime( $scadenza_bando ) );
							?>
							<div class="card-date-holder">
								<div class="data">
									<h3><?php echo $giorno; ?></h3>
									<h5><?php echo $mese; ?><br /><?php echo $anno; ?></h5>
								</div>
							</div>
						<?php endif; ?>
						<?php
						// stampo le categorie tranne che per le card scadenze nello slideshow in homepage
						if ( $slide_listing != 1 ) : ?>
							<?php if ( $module_auto_listing_abstract != 'card-title' ) : ?>
								<div class="category-holder cat-fill-a grey-green-links">
									<?php content_tax(); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<?php if ( $display_h3 == 2 ) : ?>
							<div class="texts-holder compact">
							<?php else : ?>
								<div class="texts-holder">
								<?php endif; ?>
								<?php if ( $display_h3 == 1 ) : ?>
									<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
											aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<?php elseif ( $display_h3 == 2 ) : ?>
									<h4 class="h4-variant"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
											aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
								<?php else : ?>
									<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
											aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
								<?php endif; ?>
								<?php if ( $module_auto_listing_abstract === 'card-complete' || $listing_page == 1 ) : ?>
									<?php if ( get_field( 'page_abstract' ) ) : ?>
										<p>
											<?php
											$page_abstract = get_field( 'page_abstract' );
											shorten_abstract( $page_abstract, 150 );
											?>
										</p>
									<?php endif; ?>
								<?php elseif ( $module_auto_listing_abstract === 'card-contacts' && get_field( 'ufficio_contatti' ) ) : ?>
									<?php the_field( 'ufficio_contatti' ); ?>
								<?php elseif ( has_term( 'politici', 'amministrazione_tax' ) || has_term( 'personale-amministrativo', 'amministrazione_tax' ) ) : ?>
									<?php if ( get_field( 'ruolo_politico' ) ) : ?>
										<p>
											<?php the_field( 'ruolo_politico' ); ?>
										</p>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<?php
							// stampo le scadenze tranne che per le card scadenze nello slideshow in homepage
							if ( $slide_listing != 1 ) : ?>
								<?php if ( has_term( 'bandi', 'documenti_tax' ) && get_field( 'bando_mostrare_le_date_in_front_end' ) == 1 ) : ?>
									<?php
									$pubblicazione_bando = get_field( 'pubblicazione_bando' );
									$giorno_pubblicazione = date_i18n( 'j', strtotime( $pubblicazione_bando ) );
									$mese_pubblicazione = date_i18n( 'F', strtotime( $pubblicazione_bando ) );
									$anno_pubblicazione = date_i18n( 'Y', strtotime( $pubblicazione_bando ) );

									$scadenza_bando = get_field( 'scadenza_bando' );
									$giorno_scadenza = date_i18n( 'j', strtotime( $scadenza_bando ) );
									$mese_scadenza = date_i18n( 'F', strtotime( $scadenza_bando ) );
									$anno_scadenza = date_i18n( 'Y', strtotime( $scadenza_bando ) );
									?>
									<div class="more-info">
										<p>
											<strong>Data pubblicazione:</strong> <?php echo $giorno_pubblicazione; ?> 					<?php echo $mese_pubblicazione; ?>
											<?php echo $anno_pubblicazione; ?><br />
											<strong>Data scadenza:</strong> <?php echo $giorno_scadenza; ?> 					<?php echo $mese_scadenza; ?>
											<?php echo $anno_scadenza; ?>
										</p>
									</div>
								<?php endif; ?>
							<?php endif; ?>

						</div>
						<?php if ( $display_h3 != 2 ) : ?>
							<div class="cta-holder">
								<a href="<?php the_permalink(); ?>" class="arrow-button" title="Leggi di più su <?php the_title(); ?>"
									aria-label="Leggi di più su <?php the_title(); ?>">Leggi di più</a>
							</div>
						<?php endif; ?>
			</article>
			<?php
			// tipologia di card
			// fine
		endif;
	?>
	<?php endif; ?>
<?php
endif;
?>
<!-- card singoli contenuti -->