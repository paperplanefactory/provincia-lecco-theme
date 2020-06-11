<!-- module-scadenze -->
<section class="card-module">
  <div class="module-separator">
    <div class="content-styled">
      <?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
        <h4 class="lighter-h4"><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a><?php the_sub_field( 'module_index_title' ); ?></h4>
      <?php else : ?>
        <a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
      <?php endif; ?>
      <?php if ( get_sub_field( 'module_scadenze_intro' ) ) : ?>
        <?php the_sub_field( 'module_scadenze_intro' ); ?>
      <?php endif; ?>
    </div>
    <div class="scadenze-wrapper">
    <?php
    if ( have_rows( 'module_scadenze_repeater' ) ) : while ( have_rows( 'module_scadenze_repeater' ) ) : the_row();
    $module_scadenze_repeater_data = get_sub_field( 'module_scadenze_repeater_data' );
    $giorno = date_i18n( 'j',  strtotime( $module_scadenze_repeater_data ) );
    $mese = date_i18n( 'F',  strtotime( $module_scadenze_repeater_data ) );
    $anno = date_i18n( 'Y',  strtotime( $module_scadenze_repeater_data ) );
    ?>
    <!-- blocco data scadenza -->

      <div class="flex-hold flex-hold-scadenze">
        <div class="data">
          <h3><?php echo $giorno; ?></h3>
          <h5><?php echo $mese; ?><br /><?php echo $anno; ?></h5>
        </div>
        <div class="info flex-hold verticalize">
          <div class="padder paragraph-variant-holder">
            <?php if ( get_sub_field( 'module_scadenze_repeater_titolo' ) ) : ?>
              <h6 class="allupper txt-4"><?php the_sub_field( 'module_scadenze_repeater_titolo' ); ?></h6>
            <?php endif; ?>
            <?php if ( get_sub_field( 'module_scadenze_repeater_informazioni' ) ) : ?>
              <?php the_sub_field( 'module_scadenze_repeater_informazioni' ); ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- blocco data scadenza -->
    <?php endwhile; endif; ?>
    </div>
  </div>
</section>
<!-- module-scadenze -->
