<!-- module-map -->
<section class="map-module">
	<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
		<section class="content-styled">
			<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>"
					class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h2>
		</section>
	<?php else : ?>
		<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
	<?php endif; ?>
	<div class="video_frame">
		<?php
		// get iframe HTML
		$iframe = get_sub_field( 'module_video_embed' );
		// use preg_match to find iframe src
		preg_match( '/src="(.+?)"/', $iframe, $matches );
		$src = $matches[1];

		// add extra params to iframe src
		$params = array(
			'controls' => 0,
			'hd' => 1,
			'autohide' => 1
		);

		$new_src = add_query_arg( $params, $src );

		$iframe = str_replace( $src, $new_src, $iframe );

		// add extra attributes to iframe html
		$attributes = 'frameborder="0" class="lazy"';
		// use preg_replace to change iframe src to data-src
		$iframe = preg_replace( '~<iframe[^>]*\K(?=src)~i', 'data-', $iframe );
		$iframe = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $iframe );

		// echo $iframe
		echo $iframe;
		?>
	</div>
</section>
<!-- module-map -->