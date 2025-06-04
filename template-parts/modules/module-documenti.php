<!-- module-documenti -->
<section class="text-module">
	<div class="module-separator-flex">
		<div class="content-styled">
			<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
				<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>"
						class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h2>
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
						<div class="card_inner compact-card">
							<div class="texts-holder compact">
								<h2 class="h4-variant iconized element-hover txt-3">
									<span class="title-icon icon-attachement"></span>
									<?php the_sub_field( 'module_gestione_documenti_repeater_doc_title' ); ?>
								</h2>
								<a href="<?php echo $doc_link; ?>" class="card-link new-window" target="_blank"><span
										class="screen-reader-text">Scarica:
										<?php the_sub_field( 'module_gestione_documenti_repeater_doc_title' ); ?> (si apre in
										una nuova scheda)</span></a>
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