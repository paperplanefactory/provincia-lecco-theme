<!-- module-text -->
<section class="text-module">
	<div class="module-separator">
		<div class="content-styled last-child-no-margin">
			<?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
				<h4 class="rebold"><a name="indice-<?php echo $module_count; ?>"
						class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h4>
			<?php else : ?>
				<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
			<?php endif; ?>
			<?php echo get_sub_field( 'module_text_content' ); ?>
		</div>
	</div>
</section>
<!-- module-text -->