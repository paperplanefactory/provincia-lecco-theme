<!-- map-module-plugin -->
<section class="map-module-plugin">
	<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
		<div class="content-styled">
			<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
				<?php the_sub_field( 'module_index_title' ); ?>
			</h2>
		</div>
	<?php else : ?>
		<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
	<?php endif; ?>
	<div class="video_frame">
		<?php
		$shortcode_mappa = get_sub_field( 'shortcode_mappa' );
		echo do_shortcode( '' . $shortcode_mappa . '' ); ?>
	</div>
</section>
<!-- map-module-plugin -->