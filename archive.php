<?php
$redirect_term = get_queried_object();
$redirect_url = get_field( 'term_archive_page', $redirect_term );
if ( $redirect_url != '' ) :
	wp_redirect( $redirect_url, 301 );

else :
	//$home_url = get_home_url();
	//wp_redirect( $home_url, 307 );
	?>

	<?php
	// Paperplane _blankTheme - template per archive
	get_header();
	?>
	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="wrapper-padded-intro">
				<div class="page-opening-padder">
					<nav class="breadcrumbs-holder grey-links undelinked-links" aria-label="Percorso"
						typeof="BreadcrumbList" vocab="http://schema.org/">
						<?php bcn_display(); ?>
					</nav>

					<div class="flex-hold flex-hold-page-opening">
						<div class="page-opening-left">
							<h1><?php echo single_term_title(); ?></h1>
							<?php echo term_description(); ?>


						</div>
						<div class="page-opening-right">
							<div class="padder">

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
				<div class="listing-box">
					<h2>Tutto su <?php echo single_term_title(); ?></h2>
					<ul class="flex-hold flex-hold-3 margins-wide grid-separator-2">
						<?php while ( have_posts() ) :
							the_post(); ?>
							<?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</ul>
					<?php wp_pagenavi(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
<?php endif; ?>