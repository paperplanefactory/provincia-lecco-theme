<?php
// Accorcio stringhe
function shorten_abstract( $page_abstract, $length ) {
	if ( strlen( $page_abstract ) > $length ) {
		$page_abstract = trim( substr( $page_abstract, 0, $length ) ) . "&hellip;";
		$page_abstract = preg_replace( '`\[[^\]]*\]`', '', $page_abstract );
	}
	echo $page_abstract;
}

// page title generator
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Replaces the login header logo URL
 *
 * @param $url
 */
function namespace_login_headerurl( $url ) {
	$url = home_url( '/' );
	return $url;
}

add_filter( 'login_headertitle', 'namespace_login_headertitle' );
/**
 * Replaces the login header logo title
 *
 * @param $title
 */
function namespace_login_headertitle( $title ) {
	$title = get_bloginfo( 'name' );
	return $title;
}











function pr_le_siti_tematici_redirect() {
	global $post;
	if ( is_singular( 'siti_tematici_cpt' ) ) {
		$redirect_url = get_field( 'sito_tematico_url', $post->ID );
		wp_redirect( $redirect_url );
		exit;
	}


}
add_action( 'template_redirect', 'pr_le_siti_tematici_redirect' );