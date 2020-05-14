<?php
$redirect_term = get_queried_object();
$redirect_url = get_field( 'term_archive_page', $redirect_term );
if ( $redirect_url != '' ) {
  wp_redirect( $redirect_url, 301 );
}
else {
  $home_url = get_home_url();
  wp_redirect( $home_url, 307 );
}
 ?>
