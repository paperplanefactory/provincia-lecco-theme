<?php if ( is_archive() ) : ?>
  <div class="wrapper page-opening">
      <div class="page-opening-fullscreen-less fullscreen-cta fullscreen-cta-center combo-1">
        <div class="fullscreen-cta-aligner">
          <div class="wrapper">
            <div class="wrapper-padded">
              <div class="wrapper-padded-more">
                <div class="fullscreen-cta-safe-padding aligncenter" data-aos="fade-right">
                  <div class="last-child-no-margin">
                    <h1><?php single_term_title(); ?></h1>
                    <?php if ( term_description() ) : ?>
                      <p><?php echo term_description(); ?></p>
                    <?php endif; ?>
                  </div>
                  <div class="categories-holder">
                    <?php
                    $queried_object = get_queried_object();
                    $page_taxonomy_slug = false;
                    if($queried_object instanceof \WP_Term){
                      $page_taxonomy_slug = $queried_object->taxonomy;
                    }
                    all_categories( $page_taxonomy_slug );
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
<?php else : ?>
  <?php
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_desktop = wp_get_attachment_image_src($thumb_id, 'pro_size_card', true);
  $page_opening_video = get_field( 'page_opening_video' );
  $page_breadcrumbs = get_field( 'page_breadcrumbs' );
  $page_scroll_button = get_field( 'page_scroll_button' );
  $page_opening_layout = get_field( 'page_opening_layout' );
  switch ( $page_opening_layout ) {
    case 'opening-fullscreen' :
    $page_opening_layout_size = 'page-opening-fullscreen';
    break;
    case 'opening-almost-fullscreen' :
    $page_opening_layout_size = 'page-opening-fullscreen-less';
    break;
    case 'opening-text-image' :
    break;
  }
  $page_opening_cta_target = get_field( 'page_opening_cta_target' );
  switch ( $page_opening_cta_target ) {
    case 'cta-target-internal' :
    $page_opening_cta_url = get_field( 'module_additional_elements_cta_target_internal' );
    $page_opening_cta_url_target = '_self';
    break;
    case 'cta-target-external' :
    $page_opening_cta_url = get_field( 'module_additional_elements_cta_target_external' );
    $page_opening_cta_url_target = '_blank';
    break;
    case 'cta-target-file' :
    $page_opening_cta_url = get_field( 'module_additional_elements_cta_target_file' );
    $page_opening_cta_url_target = '_blank';
    break;
  }
  $page_opening_image_shape = get_field( 'page_opening_image_shape' );
  $page_taxonomy_show = get_field( 'page_taxonomy_show' );
   ?>
   <?php if ( $page_opening_layout === 'opening-fullscreen' || $page_opening_layout === 'opening-almost-fullscreen' ) : ?>
     <div class="wrapper page-opening">
       <?php if ( $thumb_id != '' ) : ?>
         <div class="<?php echo $page_opening_layout_size; ?> fullscreen-cta <?php the_field( 'page_opening_text_align' ); ?> lazy coverize blended <?php the_field( 'page_opening_color_scheme' ); ?>" data-bg="url('<?php echo $thumb_url_desktop[0]; ?>')" data-aos="fade">
       <?php else : ?>
         <div class="<?php echo $page_opening_layout_size; ?> fullscreen-cta <?php the_field( 'page_opening_text_align' ); ?> <?php the_field( 'page_opening_color_scheme' ); ?>">
       <?php endif; ?>

         <?php if ( $page_opening_video === 'si' ) : ?>
           <div class="fullscreen-video">
            <video class="lazy"  autoplay muted loop>
              <source type="video/mp4" data-src="<?php the_field( 'page_opening_video_mp4' ); ?>">
              <source type="video/ogg" data-src="<?php the_field( 'page_opening_video_ogg' ); ?>">
              <source type="video/webm" data-src="<?php the_field( 'page_opening_video_avi' ); ?>">
            </video>
          </div>
          <?php endif; ?>
           <div class="fullscreen-cta-aligner">
             <div class="wrapper">
               <div class="wrapper-padded">
                 <div class="wrapper-padded-more">
                   <div class="fullscreen-cta-safe-padding <?php the_field( 'page_opening_text_align_horizontal' ); ?>" data-aos="fade-right">
                     <div class="last-child-no-margin">
                       <?php if ( $page_breadcrumbs === 'yes' && function_exists( 'bcn_display' ) ) : ?>
                         <div class="breadcrumbs-holder undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
                           <?php bcn_display(); ?>
                         </div>
                       <?php endif; ?>
                       <?php if ( get_field( 'page_opening_title' ) ) : ?>
                         <h1><?php the_field( 'page_opening_title' ); ?></h1>
                       <?php else : ?>
                         <h1><?php the_title(); ?></h1>
                       <?php endif; ?>
                       <?php if ( get_field( 'page_opening_subtitle' ) ) : ?>
                         <p><?php the_field( 'page_opening_subtitle' ); ?></p>
                       <?php endif; ?>
                     </div>
                     <?php if ( $page_taxonomy_show === 'yes' ) : ?>
                       <div class="categories-holder">
                         <?php
                         $page_taxonomy_slug = get_field( 'page_taxonomy_slug' );
                         all_categories( $page_taxonomy_slug );
                          ?>
                       </div>
                     <?php endif; ?>

                     <div class="clearer"></div>
                     <?php if ( get_field( 'page_opening_cta_text' ) ) : ?>
                       <div class="cta-holder">
                         <a href="<?php echo $page_opening_cta_url; ?>" target="<?php echo $page_opening_cta_url_target; ?>" class="<?php the_field( 'page_opening_cta_appearence' ); ?> allupper"><?php the_field( 'page_opening_cta_text' ); ?></a>
                       </div>
                     <?php endif; ?>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <?php if ( $page_opening_layout === 'opening-fullscreen' && $page_scroll_button == 1 ) : ?>
             <div id="intro-scroll-js" class="scroll-down">

             </div>
           <?php endif; ?>
       </div>
     </div>
     <div class="below-the-fold"></div>
   <?php elseif ( $page_opening_layout === 'opening-text-image' ) : ?>
     <div class="flex-hold flex-hold-page-opening verticalize <?php the_field( 'page_opening_color_scheme' ); ?> opening-text-image">
       <div class="page-opening-text">
         <div class="page-opening-text-space <?php the_field( 'page_opening_text_align_horizontal' ); ?>">
           <div class="last-child-no-margin">
             <?php if ( $page_breadcrumbs === 'yes' && function_exists( 'bcn_display' ) ) : ?>
               <div class="breadcrumbs-holder undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
                 <?php bcn_display(); ?>
               </div>
             <?php endif; ?>
             <?php if ( get_field( 'page_opening_title' ) ) : ?>
               <h1><?php the_field( 'page_opening_title' ); ?></h1>
             <?php else : ?>
               <h1><?php the_title(); ?></h1>
             <?php endif; ?>
             <?php if ( get_field( 'page_opening_subtitle' ) ) : ?>
               <h2><?php the_field( 'page_opening_subtitle' ); ?></h2>
             <?php endif; ?>
             <?php if ( $page_taxonomy_show === 'yes' ) : ?>
               <div class="categories-holder">
                 <?php
                 $page_taxonomy_slug = get_field( 'page_taxonomy_slug' );
                 all_categories( $page_taxonomy_slug );
                  ?>
               </div>
             <?php endif; ?>
             <div class="clearer"></div>
             <?php if ( get_field( 'page_opening_cta_text' ) ) : ?>
               <div class="cta-holder">
                 <a href="<?php echo $page_opening_cta_url; ?>" target="<?php echo $page_opening_cta_url_target; ?>" class="<?php the_field( 'page_opening_cta_appearence' ); ?>  allupper"><?php the_field( 'page_opening_cta_text' ); ?></a>
               </div>
             <?php endif; ?>
           </div>
         </div>
       </div>
       <div class="page-opening-image">
         <?php if ( $page_opening_image_shape === 'image-square' ) : ?>
           <?php
           $image_data = array(
               'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
               'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
               'size_fallback' => 'opening_squared'
           );
           $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
               'retina' => 'opening_squared',
               'desktop' => 'opening_squared',
               'mobile' => 'opening_squared',
               'micro' => 'micro'
           );
           print_theme_image( $image_data, $image_sizes );
           ?>
         <?php else : ?>
           <div class="page-opening-image-aligner">
             <div class="page-opening-image-rounder">
               <?php
               $image_data = array(
                   'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
                   'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
                   'size_fallback' => 'round_image'
               );
               $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
                   'retina' => 'opening_squared',
                   'desktop' => 'opening_squared',
                   'mobile' => 'opening_squared',
                   'micro' => 'micro'
               );
               print_theme_image( $image_data, $image_sizes );
               ?>
             </div>
           </div>
         <?php endif; ?>

       </div>
     </div>
   <?php elseif ( $page_opening_layout === 'opening-text-column' ) : ?>
     <div class="wrapper <?php the_field( 'page_opening_color_scheme' ); ?>">
       <div class="wrapper-padded">
         <div class="wrapper-padded-more">
           <div class="page-opening-text-image-column-spacer aligncenter">
             <div class="last-child-no-margin">
               <?php if ( $page_breadcrumbs === 'yes' && function_exists( 'bcn_display' ) ) : ?>
                 <div class="breadcrumbs-holder undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
                   <?php bcn_display(); ?>
                 </div>
               <?php endif; ?>
               <?php if ( get_field( 'page_opening_title' ) ) : ?>
                 <h1><?php the_field( 'page_opening_title' ); ?></h1>
               <?php else : ?>
                 <h1><?php the_title(); ?></h1>
               <?php endif; ?>
               <?php if ( get_field( 'page_opening_subtitle' ) ) : ?>
                 <p><?php the_field( 'page_opening_subtitle' ); ?></p>
               <?php endif; ?>
             </div>
             <?php if ( $page_taxonomy_show === 'yes' ) : ?>
               <div class="categories-holder">
                 <?php
                 $page_taxonomy_slug = get_field( 'page_taxonomy_slug' );
                 all_categories( $page_taxonomy_slug );
                  ?>
               </div>
             <?php endif; ?>
             <div class="clearer"></div>
             <?php if ( get_field( 'page_opening_cta_text' ) ) : ?>
               <div class="cta-holder">
                 <a href="<?php echo $page_opening_cta_url; ?>" target="<?php echo $page_opening_cta_url_target; ?>" class="<?php the_field( 'page_opening_cta_appearence' ); ?>  allupper"><?php the_field( 'page_opening_cta_text' ); ?></a>
               </div>
             <?php endif; ?>
             <div class="wrapper-padded-more-700">
               <?php
               $image_data = array(
                   'image_type' => 'post_thumbnail', // options: post_thumbnail, acf_field, acf_sub_field
                   'image_value' => '', // se utilizzi un custom field indica qui il nome del campo
                   'size_fallback' => 'content_picture'
               );
               $image_sizes = array( // qui sono definiti i ritagli o dimensioni. Devono corrispondere per numero a quanto dedinfito nella funzione nei parametri data-srcset o srcset
                   'retina' => 'content_picture',
                   'desktop' => 'content_picture',
                   'mobile' => 'content_picture',
                   'micro' => 'micro'
               );
               print_theme_image( $image_data, $image_sizes );
               ?>
             </div>
           </div>
         </div>
       </div>
     </div>
   <?php elseif ( $page_opening_layout === 'opening-text' ) : ?>
     <div class="wrapper <?php the_field( 'page_opening_color_scheme' ); ?>">
       <div class="wrapper-padded">
         <div class="wrapper-padded-more">
           <div class="page-opening-simple-spacer <?php the_field( 'page_opening_text_align_horizontal' ); ?>">
             <div class="last-child-no-margin">
               <?php if ( $page_breadcrumbs === 'yes' && function_exists( 'bcn_display' ) ) : ?>
                 <div class="breadcrumbs-holder undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
                   <?php bcn_display(); ?>
                 </div>
               <?php endif; ?>
               <?php if ( get_field( 'page_opening_title' ) ) : ?>
                 <h1><?php the_field( 'page_opening_title' ); ?></h1>
               <?php else : ?>
                 <h1><?php the_title(); ?></h1>
               <?php endif; ?>
               <?php if ( get_field( 'page_opening_subtitle' ) ) : ?>
                 <p><?php the_field( 'page_opening_subtitle' ); ?></p>
               <?php endif; ?>
             </div>
             <?php if ( $page_taxonomy_show === 'yes' ) : ?>
               <div class="categories-holder">
                 <?php
                 $page_taxonomy_slug = get_field( 'page_taxonomy_slug' );
                 all_categories( $page_taxonomy_slug );
                  ?>
               </div>
             <?php endif; ?>
             <div class="clearer"></div>
             <?php if ( get_field( 'page_opening_cta_text' ) ) : ?>
               <div class="cta-holder">
                 <a href="<?php echo $page_opening_cta_url; ?>" target="<?php echo $page_opening_cta_url_target; ?>" class="<?php the_field( 'page_opening_cta_appearence' ); ?>  allupper"><?php the_field( 'page_opening_cta_text' ); ?></a>
               </div>
             <?php endif; ?>
           </div>
         </div>
       </div>
     </div>
  <?php endif; ?>
<?php endif; ?>
