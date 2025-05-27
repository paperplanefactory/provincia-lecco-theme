<?php
global $last_rep_color;
$module_count = 0;
if ( have_rows( 'new_module' ) ) :
	while ( have_rows( 'new_module' ) ) :
		the_row();
		$module_count++;
		$module_index_title = get_sub_field( 'module_index_title' );
		if ( $module_index_title != '' ) {
			echo '<li><a href="#indice-' . $module_count . '">' . get_sub_field( 'module_index_title' ) . '</a></li>';
		}

	endwhile;
endif; ?>