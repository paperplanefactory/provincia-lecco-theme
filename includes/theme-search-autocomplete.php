<?php
function get_ajax_suggestions() {
    $searchkw =  $_REQUEST['searchkw'];
    $start_search = strlen( $searchkw );

    if ( $start_search > 2 ) {
      $args_suggestions = array(
        'post_type' => array( 'post', 'servizi_cpt', 'amministrazione_cpt', 'documenti_cpt', 'progetti_cpt' ),
        'posts_per_page' => -1,
        'posts_per_page' => 40,
        'nopaging' => true,
        'order' => 'DESC',
        'orderby' => 'date',
        's' => $searchkw,
      );
      $my_suggestions = get_posts( $args_suggestions );
      $response = '';
      if ( !empty ( $my_suggestions ) ) {
        foreach ( $my_suggestions as $post ) : setup_postdata ( $post );
        $response .= '<div class="search-suggestion">';

        $post_type = get_post_type( $post->ID );
        switch ( $post_type ) {
          case 'amministrazione_cpt' :
          $taxonomy = 'amministrazione_tax';
          $cpt_name = 'amministrazione';
          break;
          case 'post' :
          $taxonomy = 'category';
          $cpt_name = 'novità';
          break;
          case 'servizi_cpt' :
          $taxonomy = 'servizi_tax';
          $cpt_name = 'servizi';
          break;
          case 'documenti_cpt' :
          $taxonomy = 'documenti_tax';
          $cpt_name = 'documenti e dati';
          break;
        }
        $response .= '<h4 class="h4-variant light">';
        $icon_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'parent' => 0, 'hide_empty' => false ) );
        foreach ( $icon_terms as $pterm ) {
          $tax_icon = get_field('taxonomy_term_icon', $pterm->taxonomy . '_' . $pterm->term_id);
          if ( $tax_icon != '' ) {
            $response .= '<a href="' . get_term_link( $pterm ) . '" title="Archivio '.$pterm->name.'" aria-label="Archivio '.$pterm->name.'" class="green-link">';
            $response .= '<span class="mini-icon '.$tax_icon.'">';
            $response .= '</span>';
            $response .= '</a>';
          }
        }
        $response .= '<a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h4><h5 class="allupper txt-10">'.$cpt_name.'</h5>';
        $response .= '</div>';
        endforeach; wp_reset_postdata();
      }
    }

    elseif ( $start_search <= 2 ) {
      $response = '';
    }


    echo $response;

    exit; // leave ajax call

}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_ajax_suggestions', 'get_ajax_suggestions');
add_action('wp_ajax_nopriv_get_ajax_suggestions', 'get_ajax_suggestions');

function ajax_suggestions() {
  ?>
  <script>
  $('.search-erase-js').click(function(e) {
    kwpar = '';
    getResults(kwpar);
    e.preventDefault();
  });

  $('.search-input-kw-js').on('input paste focus mouseenter', function() {
    kwpar = $(this).val();
    getResults(kwpar);
  });

  $('.search-suggestion-area').mouseleave(function() {
    $('.search-suggestion-area').removeClass('active');
  });

  function getResults(kwpar) {
    $.ajax({
      type: 'POST',
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      dataType: "html",
      data: {
        action : 'get_ajax_suggestions',
        searchkw : kwpar
      },
      success: function( response ) {
        if (!response) {
          $('.search-suggestion-area').removeClass('active');
        }
        else {
          $('.search-suggestion-area').addClass('active');
        }
        $('.search-suggestion-area').html( response );
      }
    });
  }
  </script>
  <?php
}
add_action('wp_footer', 'ajax_suggestions');
