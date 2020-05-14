<!-- card singoli contenuti -->
<?php
// tipologia di card
if ( ( (get_post_type() == 'progetti_cpt') ) || ( (get_post_type() == 'argomento_cpt') ) ) :
  if ( $compact_argomenti != 1 ) : ?>
  <?php
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'pro_size_card', true);
  ?>
  <div class="flex-hold-child card autonomous-height insite lazy with-bg-image" data-bg="<?php echo $thumb_url_desktop[0]; ?>">
    <div class="card_inner image-card-big">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>" class="absl"></a>
      <div class="image-card-content">
          <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
      </div>

    </div>
  </div>
<?php else : ?>
  <div class="flex-hold-child card insite">
    <div class="card_inner cap-card">
      <div class="last-child-no-margin">
        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php else : ?>
  <?php
  // card politico
  if( has_term( 'politici', 'amministrazione_tax' ) && get_post_thumbnail_id() ) :
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'pro_size_card', true);
    ?>
    <div class="flex-hold-child card insite autonomous-height">
      <div class="image-card-image-side lazy with-bg-image-side" data-bg="<?php echo $thumb_url_desktop[0]; ?>">
        <a class="absl" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"></a>
      </div>
      <div class="card_inner image-card">
        <div class="title-block">
          <h2 class="h2-variant"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <?php if ( get_field( 'page_abstract' ) ) : ?>
            <p>
              <?php the_field( 'page_abstract' ); ?>
            </p>
          <?php endif; ?>
        </div>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>" class="arrow-button">Leggi di più</a>
      </div>
    </div>
  <?php
  else :
    ?>
    <div class="flex-hold-child card insite">
      <div class="card_inner regular-card">
        <?php if ( get_post_thumbnail_id() ) : ?>
          <div class="cover-image">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>">
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
            </a>
          </div>
        <?php endif; ?>
        <div class="category-holder cat-fill-a">
          <?php content_tax(); ?>
        </div>
        <div class="texts-holder">
          <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
          <?php if ( get_field( 'page_abstract' ) ) : ?>
            <p>
              <?php the_field( 'page_abstract' ); ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      <div class="cta-holder">
        <a href="<?php the_permalink(); ?>" class="arrow-button" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>">Leggi di più</a>
      </div>
    </div>
  <?php
  // tipologia di card
  // fine
  endif;
  ?>
<?php endif; ?>


<!-- card singoli contenuti -->
