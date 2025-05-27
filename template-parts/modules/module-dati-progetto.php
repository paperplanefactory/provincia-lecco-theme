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
			<div class="module-dati-progetto-string">
				<div class="label">Titolo progetto</div>
				<div class="data">
					<?php the_sub_field( 'titolo_progetto' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Tipologia opera pubblica</div>
				<div class="data">
					<?php the_sub_field( 'tipologia_opera_pubblica' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Tipologia infrastruttura</div>
				<div class="data">
					<?php the_sub_field( 'tipologia_infrastruttura' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Nome infrastruttura</div>
				<div class="data">
					<?php the_sub_field( 'nome_infrastruttura' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Lineare o puntuale</div>
				<div class="data">
					<?php the_sub_field( 'tipo_di_intervento' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Coordinate geografiche</div>
				<div class="data">
					<?php the_sub_field( 'coordinate_geografiche' ); ?>
				</div>
			</div>
			<?php if ( get_sub_field( 'tipo_di_intervento' ) === 'Lineare' ) : ?>
				<div class="module-dati-progetto-string">
					<div class="label">Punto di inizio e fine (km)</div>
					<div class="data">
						<?php the_sub_field( 'punto_di_inizio_e_fine_km' ); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="module-dati-progetto-string">
				<div class="label">Provincia</div>
				<div class="data">
					<?php the_sub_field( 'provincia' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Comune/i</div>
				<div class="data">
					<?php the_sub_field( 'comunei' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Località</div>
				<div class="data">
					<?php the_sub_field( 'localita' ); ?>
				</div>
			</div>
			<?php if ( get_sub_field( 'inizio_lavori' ) ) : ?>
				<div class="module-dati-progetto-string">
					<div class="label">Inizio lavori</div>
					<div class="data">
						<?php the_sub_field( 'inizio_lavori' ); ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( get_sub_field( 'fine_lavori_presunto' ) ) : ?>
				<div class="module-dati-progetto-string">
					<div class="label">Fine lavori (presunto)</div>
					<div class="data">
						<?php the_sub_field( 'fine_lavori_presunto' ); ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( get_sub_field( 'entrata_in_esercizio' ) ) : ?>
				<div class="module-dati-progetto-string">
					<div class="label">Entrata in esercizio</div>
					<div class="data">
						<?php the_sub_field( 'entrata_in_esercizio' ); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="module-dati-progetto-string">
				<div class="label">Proprietario</div>
				<div class="data">
					<?php the_sub_field( 'proprietario' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Responsabile progettazione</div>
				<div class="data">
					<?php the_sub_field( 'responsabile_progettazione' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Tipologia intervento</div>
				<div class="data">
					<?php the_sub_field( 'tipologia_intervento' ); ?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Importo finanziamento</div>
				<div class="data">
					€
					<?php
					$importo_del_contratto = get_sub_field( 'importo_del_contratto' );
					echo number_format( $importo_del_contratto, 2, ',', '.' );
					?>
				</div>
			</div>
			<div class="module-dati-progetto-string">
				<div class="label">Finanziata da</div>
				<div class="data">
					<?php the_sub_field( 'finanziata_da' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- module-dati-progetto -->