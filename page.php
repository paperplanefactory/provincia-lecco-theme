<?php
/**
*  Paperplane _blankTheme - template predefinito per pagine.
*/
get_header();
?>
<?php
while ( have_posts() ) : the_post();
include( locate_template( 'template-parts/grid/page-opening.php' ) );
include( locate_template( 'template-parts/modules/modules-handler.php' ) );
endwhile;?>
<h1>asdsad</h1>
<h1>asdsad</h1>
<h1>asdsad</h1>
<h1>asdsad</h1>
<h1>asdsad</h1>
<h1>asdsad</h1>
<h1>asdsad</h1>
<?php
get_footer(); ?>
