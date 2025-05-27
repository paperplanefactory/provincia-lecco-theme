<!-- module-map -->
<section class="map-module">
	<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
		<div class="content-styled">
			<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>"
					class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h2>
		</div>
	<?php else : ?>
		<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
	<?php endif; ?>
	<div class="video_frame">
		<?php echo get_sub_field( 'module_map_embed' ); ?>
	</div>
</section>
<!-- module-map -->