<div class="wrapper bg-1 txt-12">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <div class="wrapper-padded-more-924">
        <div class="single-content-opening-padder">
          <h2 class="txt-12"><?php the_title(); ?></h2>
          <?php if ( get_field( 'messaggio_avviso' ) ) : ?>
            <p class="paragraph-variant">
              <?php the_field( 'messaggio_avviso' ); ?>
            </p>
          <?php endif; ?>
          <?php
          if ( have_rows( 'avviso_gestione_cta_repeater' ) ) : ?>
          <div class="tags-holder">
            <?php while ( have_rows( 'avviso_gestione_cta_repeater' ) ) : the_row();
            $avviso_gestione_cta_repeater_destinazione = get_sub_field( 'avviso_gestione_cta_repeater_destinazione' );
            if ( $avviso_gestione_cta_repeater_destinazione === 'internal-content' ) {
              $avviso_gestione_cta_url = get_sub_field( 'avviso_gestione_cta_repeater_page' );
              $target = '_self';
            }
            elseif ( $avviso_gestione_cta_repeater_destinazione === 'internal-media' ) {
              $avviso_gestione_cta_url = get_sub_field( 'avviso_gestione_cta_repeater_file' );
              $target = '_blank';
            }
            elseif ( $avviso_gestione_cta_repeater_destinazione === 'external-content' ) {
              $avviso_gestione_cta_url = get_sub_field( 'avviso_gestione_cta_repeater_url' );
              $target = '_blank';
            }
            ?>
            <a href="<?php echo $avviso_gestione_cta_url; ?>" target="<?php echo $target; ?>" class="square-button green filled" title="<?php the_sub_field( 'avviso_gestione_cta_repeater_testo' ); ?>" aria-label="<?php the_sub_field( 'avviso_gestione_cta_repeater_testo' ); ?>"><?php the_sub_field( 'avviso_gestione_cta_repeater_testo' ); ?></a>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</div>
