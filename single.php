<?php
// Paperplane _blankTheme - template per single amministrazione_cpt.
get_header();
?>

<?php
while ( have_posts() ) : the_post();
$display_h3 = 2;
//current_page_from_single_cpt();
$my_id = get_the_ID();
$post_type = get_post_type();
// verifico scadenze bando
if ( get_field( 'scadenza_bando' ) ) {
  $scadenza_bando = get_field( 'scadenza_bando' );
  global $today;
  if ( $scadenza_bando < $today ) {
    $scadenza_check = 'scaduto';
  }
  else {
    $scadenza_check = 'non_scaduto';
  }
}
 ?>
  <main class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-intro">
        <div class="single-content-opening-padder">
          <div class="breadcrumbs-holder grey-links undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php bcn_display(); ?>
          </div>

          <div class="flex-hold flex-hold-page-opening">
            <div class="page-opening-left printable">
              <h1><?php the_title(); ?></h1>
              <?php if( ( has_term( 'politici', 'amministrazione_tax' ) || has_term( 'personale-amministrativo', 'amministrazione_tax' ) ) && get_field( 'ruolo_politico' ) ) : ?>
                <h2 class="txt-4"><?php the_field( 'ruolo_politico' ); ?></h2>
              <?php endif; ?>
              <?php if ( get_field( 'page_abstract' ) ) : ?>
                <p class="paragraph-variant">
                  <?php the_field( 'page_abstract' ); ?>
                </p>
              <?php endif; ?>
              <?php if ( get_field( 'data_di_termine_mandato_politico' ) ) : ?>
                <p class="paragraph-variant">
                  Termine mandato: <?php the_field( 'data_di_termine_mandato_politico' ); ?>
                </p>
              <?php endif; ?>
              <?php if( has_term( 'bandi', 'documenti_tax' ) && get_field( 'bando_mostrare_le_date_in_front_end' ) == 1 ) : ?>
                <?php
                $pubblicazione_bando = get_field( 'pubblicazione_bando' );
                $giorno_pubblicazione = date_i18n( 'j',  strtotime( $pubblicazione_bando ) );
                $mese_pubblicazione = date_i18n( 'F',  strtotime( $pubblicazione_bando ) );
                $anno_pubblicazione = date_i18n( 'Y',  strtotime( $pubblicazione_bando ) );

                $scadenza_bando = get_field( 'scadenza_bando' );
                $giorno_scadenza = date_i18n( 'j',  strtotime( $scadenza_bando ) );
                $mese_scadenza = date_i18n( 'F',  strtotime( $scadenza_bando ) );
                $anno_scadenza = date_i18n( 'Y',  strtotime( $scadenza_bando ) );
                ?>
                <div class="more-info">
                  <p class="paragraph-variant">
                    <strong>Data pubblicazione:</strong> <?php echo $giorno_pubblicazione; ?> <?php echo $mese_pubblicazione; ?> <?php echo $anno_pubblicazione; ?><br />
                    <strong>Data scadenza:</strong> <?php echo $giorno_scadenza; ?> <?php echo $mese_scadenza; ?> <?php echo $anno_scadenza; ?>
                  </p>
                </div>
              <?php endif; ?>
              <?php include( locate_template( 'template-parts/grid/intro-avvisi-warnings.php' ) ); ?>
              <?php if ( $post_type === 'post' ) : ?>
                <div class="data-holder paragraph-variant-holder">
                  <p>
                    Data: <?php echo get_the_date( 'j F Y' ); ?>
                  </p>
                </div>
              <?php endif; ?>
              <?php
              $image_data = array(
                  'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
                  'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
                  'size_fallback' => 'full_desk'
              );
              $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
                  'retina' => 'full_desk_retina',
                  'desktop' => 'full_desk',
                  'mobile' => 'content_picture',
                  'micro' => 'micro'
              );
              print_theme_image( $image_data, $image_sizes );
              ?>
            </div>
            <div class="page-opening-right no-print">
              <div class="padder">
                <?php include( locate_template( 'template-parts/grid/intro-actions.php' ) ); ?>
                <?php list_argomenti_pills(); ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>



  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more">
        <?php if ( get_field( 'content_index' ) == 1 ) : ?>
          <div class="flex-hold flex-hold-page-index">
            <div class="page-index-left no-print">
              <div class="sticky-element sticky-columns-js">
                <button onclick="pageIndexMenuControls(this)" class="index-menu-expander index-menu-expander-js button-appearance-normalizer button-typo-normalizer" aria-expanded="true" aria-label="Apri l'indice dei contenuti" data-collapsed="Apri l'indice dei contenuti" data-expanded="Chiudi l'indice dei contenuti">
                  Indice della pagina<span class="icon-collapse-1"></span>
                </button>
                <div class="index-menu-js">
                  <ul class="index-listing">
                    <?php include( locate_template( 'template-parts/modules/modules-index-handler.php' ) ); ?>
                  </ul>
                </div>
              </div>

            </div>
            <div class="page-index-right">
              <div class="padder">
                <?php if ( !empty( get_the_content() ) ) : ?>
                  <!-- module-old-site-text -->
                  <section class="text-module">
                    <div class="module-separator">
                      <div class="content-styled last-child-no-margin">
                        <?php the_content(); ?>
                      </div>
                    </div>
                  </section>
                  <!-- module-old-site-text -->
                <?php endif; ?>
                <?php include( locate_template( 'template-parts/modules/modules-handler.php' ) ); ?>
                <div class="module-separator">
                  <p class="paragraph-variant"><strong>
                    Ultimo aggiornamento<br />
                    <?php the_modified_time('d/m/Y, H:i'); ?>
                  </strong></p>
                </div>
              </div>
            </div>
          </div>
        <?php else : ?>
          <div class="wrapper-padded-more-780 modules-wrapper no-index">
            <div class="padder">
              <?php if ( !empty( get_the_content() ) ) : ?>
                <!-- module-old-site-text -->
                <div class="text-module">
                  <div class="module-separator">
                    <div class="content-styled last-child-no-margin">
                      <?php the_content(); ?>
                    </div>
                  </div>
                </div>
                <!-- module-old-site-text -->
              <?php endif; ?>
              <?php include( locate_template( 'template-parts/modules/modules-handler.php' ) ); ?>
              <div class="module-separator">
                <p class="paragraph-variant"><strong>
                  Ultimo aggiornamento<br />
                  <?php the_modified_time('d/m/Y, H:i'); ?>
                </strong></p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>


<?php if ( $post_type === 'progetti_cpt' ) : ?>
  <?php
  $module_auto_listing_appearence = '';
  $count_related = 0;
  $terms_argomenti = get_the_terms( $post->ID , 'argomenti_tax' );
  $content_argomenti = array();
  $content_argomenti_link = array();
  $aromenti_counter = 0;
  foreach( $terms_argomenti as $term_argomenti ) {
    $aromenti_counter++;
    $content_argomenti[] = $term_argomenti->term_id;
    if ( $aromenti_counter == 1 ) {
      $content_argomenti_link[] = '?argomenti_tax[]='.$term_argomenti->term_id.'';
    }
    else {
      $content_argomenti_link[] = '&argomenti_tax[]='.$term_argomenti->term_id.'';
    }
  }
  $content_argomenti = implode(', ', $content_argomenti);
  $content_argomenti_link = implode('', $content_argomenti_link);
  $args_related_content_progetto = array(
    //'post_type' => array('post', 'progetti_cpt'),
    'posts_per_page' => 3,
    'post__not_in' => array($my_id),
    'tax_query' => array(
      array(
        'taxonomy' => 'argomenti_tax',
        'field' => 'term_ID',
        'terms' => array($content_argomenti)
      )
    ),
  );
  $my_related_content_progetto = get_posts( $args_related_content_progetto );
   ?>
   <?php if ( !empty ( $my_related_content_progetto ) ) : ?>
    <div class="wrapper bg-9 no-print">
      <div class="wrapper-padded">
        <div class="wrapper-padded-more">
          <div class="listing-box">
            <h2 class="aligncenter aligncenter-notmobile">Contenuti Correlati</h2>
            <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
              <?php foreach ( $my_related_content_progetto as $post ) : setup_postdata ( $post ); $count_related++; ?>
                 <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
               <?php endforeach; wp_reset_postdata(); ?>
            </div>
            <?php if ( $count_related >= 3 ) : ?>
              <div class="aligncenter">
                <a href="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?><?php echo $content_argomenti_link; ?>&results_order=title" class="square-button green filled allupper">Altri contenuti correlati</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

<?php else : ?>
  <?php if ( get_field( 'related_content_method' ) != 'no-related' ) : ?>
    <?php
    if ( get_field( 'related_content_method' ) === 'manually-related' ) :
      $module_auto_listing_appearence = '';
      $related_content_handpicked = get_field('related_content_handpicked');
      ?>
      <div class="wrapper bg-9 no-print">
        <div class="wrapper-padded">
          <div class="wrapper-padded-more">
            <div class="listing-box">
              <h2 class="aligncenter">Contenuti Correlati</h2>
              <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
                <?php foreach( $related_content_handpicked as $post ) : setup_postdata( $post ); ?>
                  <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
                <?php endforeach; wp_reset_postdata(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php elseif ( get_field( 'related_content_method' ) === 'organizzazione-related' ) : ?>
      <?php
      $module_auto_listing_appearence = '';
      $terms_argomenti = get_the_terms( $post->ID , 'aree_amministrative_tax' );
      $content_argomenti = array();
      foreach( $terms_argomenti as $term_argomenti ) {
        $content_argomenti[] = $term_argomenti->term_id;
      }
      $content_argomenti = implode(', ', $content_argomenti);
      $args_related_content = array(
        'post_type' => array( 'post', 'progetti_cpt', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt' ),
        'posts_per_page' => 3,
        'post__not_in' => array($my_id),
        'tax_query' => array(
          array(
            'taxonomy' => 'aree_amministrative_tax',
            'field' => 'term_ID',
            'terms' => array($content_argomenti)
          )
        ),
      );
      $my_related_content = get_posts( $args_related_content );
      ?>
    <?php else : ?>
      <?php
      $module_auto_listing_appearence = '';
      $terms_argomenti = get_the_terms( $post->ID , 'argomenti_tax' );
      $content_argomenti = array();
      if ( $terms_argomenti != '' ) {
        foreach( $terms_argomenti as $term_argomenti ) {
          $content_argomenti[] = $term_argomenti->term_id;
        }
        $content_argomenti = implode(', ', $content_argomenti);
        $args_related_content = array(
          'post_type' => array('post', 'progetti_cpt'),
          'posts_per_page' => 3,
          'post__not_in' => array($my_id),
          'tax_query' => array(
            array(
              'taxonomy' => 'argomenti_tax',
              'field' => 'term_ID',
              'terms' => array($content_argomenti)
            )
          ),
        );
        $my_related_content = get_posts( $args_related_content );

      }

      ?>
      <?php endif; ?>
      <?php if ( !empty ( $my_related_content ) ) : ?>
      <div class="wrapper bg-9 no-print">
        <div class="wrapper-padded">
          <div class="wrapper-padded-more">
            <div class="listing-box">
              <h2 class="aligncenter aligncenter-notmobile">Contenuti Correlati</h2>
              <div class="flex-hold flex-hold-3 margins-wide grid-separator-2">
                <?php foreach ( $my_related_content as $post ) : setup_postdata ( $post ); ?>
                   <?php include( locate_template( 'template-parts/grid/listing-card.php' ) ); ?>
                 <?php endforeach; wp_reset_postdata(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

  <?php endif; ?>
<?php endif; ?>


<?php endwhile; ?>
<?php get_footer(); ?>
