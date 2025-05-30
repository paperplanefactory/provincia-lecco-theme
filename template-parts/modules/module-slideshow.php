<!-- module-slideshow -->
<section class="slide-module">
	<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
		<div class="content-styled">
			<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>"
					class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h2>
		</div>
	<?php else : ?>
		<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
	<?php endif; ?>
	<div class="slide-one">
		<?php
		if ( have_rows( 'module_slideshow_repeater' ) ) :
			while ( have_rows( 'module_slideshow_repeater' ) ) :
				the_row();
				?>
				<!-- singola immagine -->
				<div class="single-slide">
					<div class="image-holder">
						<?php
						$image_data = array(
							'image_type' => 'acf_sub_field', // options: post_thumbnail, acf_field, acf_sub_field
							'image_value' => 'module_slideshow_repeater_image', // se utilizzi un custom field indica qui il nome del campo
							'size_fallback' => 'slide'
						);
						$image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
							'retina' => 'slide',
							'desktop' => 'slide',
							'mobile' => 'slide_mobile',
							'micro' => 'micro'
						);
						print_theme_image_lazyslick( $image_data, $image_sizes );
						?>
					</div>
					<?php if ( get_sub_field( 'module_slideshow_repeater_caption' ) ) : ?>
						<div class="wp-caption-text">
							<?php the_sub_field( 'module_slideshow_repeater_caption' ); ?>
						</div>
					<?php else : ?>
						<div class="wp-caption-text-fake">
						</div>
					<?php endif; ?>
				</div>
				<!-- singola immagine -->
			<?php endwhile; endif; ?>
	</div>
</section>
<!-- module-slideshow -->