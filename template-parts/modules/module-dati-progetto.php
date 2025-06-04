<!-- module-dati-progetto -->
<section class="module-dati-progetto">
	<div class="module-separator">
		<div class="content-styled last-child-no-margin">
			<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
				<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
					<?php echo get_sub_field( 'module_index_title' ); ?>
				</h2>
			<?php else : ?>
				<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
			<?php endif; ?>
			<?php if ( get_sub_field( 'titolo_progetto' ) ) : ?>
			<?php endif; ?>
			<dl>
				<div class="module-dati-progetto-string">
					<dt class="label">Titolo progetto</dt>
					<dd class="data">
						<?php the_sub_field( 'titolo_progetto' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Tipologia opera pubblica</dt>
					<dd class="data">
						<?php the_sub_field( 'tipologia_opera_pubblica' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Tipologia infrastruttura</dt>
					<dd class="data">
						<?php the_sub_field( 'tipologia_infrastruttura' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Nome infrastruttura</dt>
					<dd class="data">
						<?php the_sub_field( 'nome_infrastruttura' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Lineare o puntuale</dt>
					<dd class="data">
						<?php the_sub_field( 'tipo_di_intervento' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Coordinate geografiche</dt>
					<dd class="data">
						<?php the_sub_field( 'coordinate_geografiche' ); ?>
					</dd>
				</div>
				<?php if ( get_sub_field( 'tipo_di_intervento' ) === 'Lineare' ) : ?>
					<div class="module-dati-progetto-string">
						<dt class="label">Punto di inizio e fine (km)</dt>
						<dd class="data">
							<?php the_sub_field( 'punto_di_inizio_e_fine_km' ); ?>
						</dd>
					</div>
				<?php endif; ?>
				<div class="module-dati-progetto-string">
					<dt class="label">Provincia</dt>
					<dd class="data">
						<?php the_sub_field( 'provincia' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Comune/i</dt>
					<dd class="data">
						<?php the_sub_field( 'comunei' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Località</dt>
					<dd class="data">
						<?php the_sub_field( 'localita' ); ?>
					</dd>
				</div>
				<?php if ( get_sub_field( 'inizio_lavori' ) ) : ?>
					<div class="module-dati-progetto-string">
						<dt class="label">Inizio lavori</dt>
						<dd class="data">
							<?php the_sub_field( 'inizio_lavori' ); ?>
						</dd>
					</div>
				<?php endif; ?>
				<?php if ( get_sub_field( 'fine_lavori_presunto' ) ) : ?>
					<div class="module-dati-progetto-string">
						<dt class="label">Fine lavori (presunto)</dt>
						<dd class="data">
							<?php the_sub_field( 'fine_lavori_presunto' ); ?>
						</dd>
					</div>
				<?php endif; ?>
				<?php if ( get_sub_field( 'entrata_in_esercizio' ) ) : ?>
					<div class="module-dati-progetto-string">
						<dt class="label">Entrata in esercizio</dt>
						<dd class="data">
							<?php the_sub_field( 'entrata_in_esercizio' ); ?>
						</dd>
					</div>
				<?php endif; ?>
				<div class="module-dati-progetto-string">
					<dt class="label">Proprietario</dt>
					<dd class="data">
						<?php the_sub_field( 'proprietario' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Responsabile progettazione</dt>
					<dd class="data">
						<?php the_sub_field( 'responsabile_progettazione' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Tipologia intervento</dt>
					<dd class="data">
						<?php the_sub_field( 'tipologia_intervento' ); ?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Importo finanziamento</dt>
					<dd class="data">
						€
						<?php
						$importo_del_contratto = get_sub_field( 'importo_del_contratto' );
						echo number_format( $importo_del_contratto, 2, ',', '.' );
						?>
					</dd>
				</div>
				<div class="module-dati-progetto-string">
					<dt class="label">Finanziata da</dt>
					<dd class="data">
						<?php the_sub_field( 'finanziata_da' ); ?>
					</dd>
				</div>
			</dl>
		</div>
	</div>
</section>
<!-- module-dati-progetto -->