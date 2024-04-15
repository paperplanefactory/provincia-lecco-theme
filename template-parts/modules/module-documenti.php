<!-- module-documenti -->
<section class="text-module">
	<div class="module-separator-flex">
		<div class="content-styled">
			<?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
				<h4 class="rebold"><a name="indice-<?php echo $module_count; ?>"
						class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h4>
			<?php else : ?>
				<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
			<?php endif; ?>
			<?php if ( get_sub_field( 'module_gestione_documenti_intro' ) ) : ?>
				<?php echo get_sub_field( 'module_gestione_documenti_intro' ); ?>
			<?php endif; ?>
		</div>
		<div class="flex-hold flex-hold-2 margins-wide">
			<?php
			if ( have_rows( 'module_gestione_documenti_repeater' ) ) :
				while ( have_rows( 'module_gestione_documenti_repeater' ) ) :
					the_row();
					$module_gestione_documenti_repeater_doc_location = get_sub_field( 'module_gestione_documenti_repeater_doc_location' );
					if ( $module_gestione_documenti_repeater_doc_location === 'doc-internal' ) {
						$doc_link = get_sub_field( 'module_gestione_documenti_repeater_doc_file' );
					} else {
						$doc_link = get_sub_field( 'module_gestione_documenti_repeater_doc_url' );
					}
					?>
					<div class="flex-hold-child card insite">
						<a href="<?php echo $doc_link; ?>" class="absl" target="_blank"
							title="Leggi il documento <?php the_sub_field( 'module_gestione_documenti_repeater_doc_title' ); ?>"
							aria-label="Leggi il documento <?php the_sub_field( 'module_gestione_documenti_repeater_doc_title' ); ?>"></a>
						<div class="card_inner compact-card">
							<div class="texts-holder compact">
								<h4 class="h4-variant iconized"><span
										class="title-icon icon-attachement"></span><?php the_sub_field( 'module_gestione_documenti_repeater_doc_title' ); ?>
								</h4>
								<?php if ( get_sub_field( 'module_gestione_documenti_repeater_doc_description' ) ) : ?>
									<p>
										<?php the_sub_field( 'module_gestione_documenti_repeater_doc_description' ); ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; endif; ?>
		</div>
	</div>
</section>
<!-- module-documenti -->