<!-- module-text-card -->
<section class="card-module">
	<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
		<div class="content-styled">
			<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>"
					class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h2>
		</div>
	<?php else : ?>
		<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
	<?php endif; ?>
	<div class="module-separator">
		<div class="card insite">
			<div class="card_inner regular-card last-child-no-margin content-styled-card">
				<?php echo get_sub_field( 'module_card_text_content' ); ?>
			</div>
		</div>
	</div>
</section>
<!-- module-text-card -->