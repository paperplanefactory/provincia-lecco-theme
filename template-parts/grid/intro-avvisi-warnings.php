<?php if ( get_field('intro_avviso_attivo') == 1 && get_field('intro_avviso_messaggio') ) : ?>
  <div class="card warning">
    <div class="card_inner warning-card">
      <span class="icon icon-warning"></span>
      <h5 class="allupper"><?php the_field( 'intro_avviso_titolo' ); ?></h5>
      <?php the_field( 'intro_avviso_messaggio' ); ?>
    </div>
  </div>
<?php endif; ?>
<?php if ( get_field('intro_warning_attivo') == 1 && get_field('intro_warning_messaggio') ) : ?>
  <div class="card restricted">
    <div class="card_inner warning-card">
      <span class="icon icon-reserved"></span>
      <h5 class="allupper"><?php the_field( 'intro_warning_titolo' ); ?></h5>
      <?php the_field( 'intro_warning_messaggio' ); ?>
    </div>
  </div>
<?php endif; ?>
