<?php
global $last_rep_color;
$module_count = 0;
if ( have_rows( 'new_module' ) ) :
	while ( have_rows( 'new_module' ) ) :
		the_row();
		$module_count++;
		$module_index_title = get_sub_field( 'module_index_title' );
		$show_hide_module = get_sub_field( 'show_hide_module' );
		if ( $module_index_title != '' && $show_hide_module == 1 ) {
			echo '<li><a href="#indice-' . $module_count . '">' . get_sub_field( 'module_index_title' ) . '</a></li>';
		}

	endwhile;
endif; ?>