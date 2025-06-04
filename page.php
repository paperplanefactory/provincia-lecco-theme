<?php
/**
 *  Paperplane _blankTheme - template predefinito per pagine.
 */
get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	//current_page_from_single_cpt();
	$my_id = get_the_ID();
	$post_type = get_post_type();
	// verifico scadenze bando
	if ( get_field( 'scadenza_bando' ) ) {
		$scadenza_bando = get_field( 'scadenza_bando' );
		global $today;
		if ( $scadenza_bando < $today ) {
			$scadenza_check = 'scaduto';
		} else {
			$scadenza_check = 'non_scaduto';
		}
	}

	?>
	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="wrapper-padded-intro">
				<div class="single-content-opening-padder">
					<nav class="breadcrumbs-holder grey-links undelinked-links" aria-label="Percorso"
						typeof="BreadcrumbList" vocab="http://schema.org/">
						<?php bcn_display(); ?>
					</nav>

					<div class="flex-hold flex-hold-page-opening">
						<div class="page-opening-left printable">
							<h1><?php the_title(); ?></h1>
							<?php if ( get_field( 'page_abstract' ) ) : ?>
								<p class="paragraph-variant">
									<?php the_field( 'page_abstract' ); ?>
								</p>
							<?php endif; ?>
							<?php if ( has_term( 'bandi', 'documenti_tax' ) ) : ?>
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
									<p class="paragraph-variant">
										<b>Data pubblicazione:</b> <?php echo $giorno_pubblicazione; ?>
										<?php echo $mese_pubblicazione; ?>
										<?php echo $anno_pubblicazione; ?><br />
										<b>Data scadenza:</b> <?php echo $giorno_scadenza; ?> 		<?php echo $mese_scadenza; ?>
										<?php echo $anno_scadenza; ?>
									</p>
								</div>
							<?php endif; ?>
							<?php if ( $post_type === 'post' ) : ?>
								<div class="data-holder paragraph-variant-holder">
									<p>
										Data: <?php echo get_the_date( 'j F Y' ); ?>
									</p>
								</div>
								<?php
								$image_data = array(
									'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
									'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
									'size_fallback' => 'full_desk'
								);
								$image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
									'retina' => 'full_desk_retina',
									'desktop' => 'full_desk',
									'mobile' => 'content_picture',
									'micro' => 'micro'
								);
								print_theme_image( $image_data, $image_sizes );
								?>
							<?php else : ?>
								<?php include( locate_template( 'template-parts/grid/intro-avvisi-warnings.php' ) ); ?>
							<?php endif; ?>
						</div>
						<div class="page-opening-right no-print">
							<div class="padder">
								<?php include( locate_template( 'template-parts/grid/intro-actions.php' ) ); ?>
								<?php list_argomenti_pills(); ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>



	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="wrapper-padded-more">
				<?php if ( get_field( 'content_index' ) == 1 ) : ?>
					<div class="flex-hold flex-hold-page-index">
						<div class="page-index-left no-print">
							<nav class="sticky-element sticky-columns-js" aria-label="Indice della pagina">
								<button onclick="pageIndexMenuControls(this)" aria-controls="index-menu"
									class="index-menu-expander index-menu-expander-js button-appearance-normalizer button-typo-normalizer">
									Indice della pagina<span class="icon-collapse-1"></span>
								</button>
								<div class="index-menu-js" id="index-menu">
									<ul class="index-listing underlined-links-on-hover">
										<?php include( locate_template( 'template-parts/modules/modules-index-handler.php' ) ); ?>
									</ul>
								</div>
							</nav>

						</div>
						<div class="page-index-right">
							<div class="padder">
								<?php include( locate_template( 'template-parts/modules/modules-handler.php' ) ); ?>
								<div class="module-separator">
									<p class="paragraph-variant"><b>
											Ultimo aggiornamento<br />
											<?php the_modified_time( 'd/m/Y, H:i' ); ?>
										</b></p>
								</div>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="wrapper-padded-more-780 modules-wrapper">
						<div class="padder">
							<?php include( locate_template( 'template-parts/modules/modules-handler.php' ) ); ?>
							<div class="module-separator">
								<p class="paragraph-variant"><b>
										Ultimo aggiornamento<br />
										<?php the_modified_time( 'd/m/Y, H:i' ); ?>
									</b></p>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php endwhile; ?>
<?php get_footer(); ?>