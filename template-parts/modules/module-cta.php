<!-- module-cta -->
<?php
$module_call_to_action_link_appearence = get_sub_field( 'module_call_to_action_link_appearence' );
$module_call_to_action_link_type = get_sub_field( 'module_call_to_action_link_type' );
?>
<section class="cta-module">
	<div class="module-separator">
		<div class="content-styled">
			<?php if ( get_sub_field( 'module_index_title' ) != '' ) : ?>
				<h2 class="as-h4 rebold"><a name="indice-<?php echo $module_count; ?>"
						class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h2>
			<?php else : ?>
				<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
			<?php endif; ?>
			<?php if ( get_sub_field( 'module_cta_intro' ) ) : ?>
				<?php echo get_sub_field( 'module_cta_intro' ); ?>
			<?php endif; ?>
		</div>
		<ul class="tags-holder">
			<?php
			if ( $module_call_to_action_link_type === 'link-interno' ) :
				$module_call_to_action_link_internal = get_sub_field( 'module_call_to_action_link_internal' );
				?>
				<?php foreach ( $module_call_to_action_link_internal as $post ) :
					setup_postdata( $post ); ?>
					<?php if ( $module_call_to_action_link_appearence === 'link-button' ) : ?>
						<li><a href="<?php the_permalink(); ?>" class="square-button green filled"><?php the_title(); ?></a></li>
					<?php else : ?>
						<li><a href="<?php the_permalink(); ?>" class="tag-button filled-button"><?php the_title(); ?></a></li>
					<?php endif; ?>
				<?php endforeach;
				wp_reset_postdata(); ?>
			<?php else : ?>
				<?php
				if ( have_rows( 'module_call_to_action_repeater' ) ) :
					while ( have_rows( 'module_call_to_action_repeater' ) ) :
						the_row();
						if ( $module_call_to_action_link_type === 'link-esterno' ) {
							$module_call_to_action_repeater_destination = get_sub_field( 'module_call_to_action_repeater_url' );
						} elseif ( $module_call_to_action_link_type === 'link-file' ) {
							$module_call_to_action_repeater_destination = get_sub_field( 'module_call_to_action_repeater_file' );
						}
						?>
						<?php if ( $module_call_to_action_link_appearence === 'link-button' ) : ?>
							<li><a href="<?php echo $module_call_to_action_repeater_destination; ?>" class="square-button green filled"
									target="_blank" rel="nofollow"><?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?></a>
							</li>
						<?php else : ?>
							<li><a href="<?php echo $module_call_to_action_repeater_destination; ?>" class="tag-button filled-button"
									target="_blank" rel="nofollow"><?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?></a>
							</li>
						<?php endif; ?>
					<?php endwhile; endif; ?>
			<?php endif; ?>
		</ul>

	</div>
</section>
<!-- module-cta -->