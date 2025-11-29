<?php
add_action( 'init', function () {
	global $theme_version;

	if ( class_exists( 'ACF' ) ) {
		$theme_version = get_transient( 'theme_force_cache' );
		if ( false === $theme_version ) {
			$theme_version_value = get_field( 'theme_version', 'option' );
			set_transient( 'theme_force_cache', $theme_version_value, 0 );
		}
	} else {
		$theme_version = '1.0'; // default se ACF non c'è
	}
}, 20 );

// Clear cache quando salvi le opzioni
add_action( 'acf/save_post', function () {
	$screen = get_current_screen();
	if ( strpos( $screen->id, 'theme-general-settings' ) !== false ) {
		delete_transient( 'theme_force_cache' );
	}
}, 20 );