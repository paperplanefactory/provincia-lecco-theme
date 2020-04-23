<div class="flex-hold flex-hold-block flex-hold-block-listed grid-item-infinite" data-aos="fade-up">
  <div class="flex-hold-child-image">
    <a href="<?php the_permalink(); ?>">
      <?php
      $image_data = array(
          'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
          'image_value' => 'immagine_acf', // se utilizzi un custom field indica qui il nome del campo
          'size_fallback' => 'full_desk'
      );
      $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
          'retina' => 'content_picture_cropped',
          'desktop' => 'content_picture_cropped',
          'mobile' => 'content_picture_cropped',
          'micro' => 'micro'
      );
      print_theme_image( $image_data, $image_sizes );
      ?>
    </a>
  </div>
  <div class="flex-hold-child-texts">
    <div class="last-child-no-margin">
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </div>
  </div>
</div>
