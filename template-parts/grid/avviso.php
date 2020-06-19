<!-- avviso iniziale -->
<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'column', true);
 ?>
<div id="avviso-visibility-js" class="wrapper bg-7 txt-12 avviso">
  <div class="wrapper-padded">
    <div class="wrapper-padded-more">
      <?php if ( get_post_thumbnail_id() ) : ?>
        <div class="flex-hold flex-hold-avviso">
          <div class="avviso-left">
            <div class="avviso-top-padder">
              <div class="padder">
                <h3 class="txt-12"><?php the_title(); ?></h3>
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
          <div class="avviso-right lazy" data-bg="<?php echo $thumb_url_desktop[0]; ?>">
            <div class="avviso-shadow"></div>
          </div>
        </div>
      <?php else : ?>
        <div class="avviso-padder">
          <h3 class="txt-12"><?php the_title(); ?></h3>
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

      <?php endif; ?>
      <button onclick="closeAvvisoMain(this)" class="chiudi-avviso avviso-local-storage-close-js button-appearance-normalizer" aria-label="Nascondi avviso per il resto della navigazione">
        <span class="icon-close"></span>
      </button>
    </div>
  </div>
</div>
