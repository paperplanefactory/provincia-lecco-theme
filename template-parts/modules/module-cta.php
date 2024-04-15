<!-- module-cta -->
<?php
$module_call_to_action_link_appearence = get_sub_field( 'module_call_to_action_link_appearence' );
$module_call_to_action_link_type = get_sub_field( 'module_call_to_action_link_type' );
?>
<section class="cta-module">
	<div class="module-separator">
		<div class="content-styled">
			<?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
				<h4 class="rebold"><a name="indice-<?php echo $module_count; ?>"
						class="anchor-head"></a><?php echo get_sub_field( 'module_index_title' ); ?></h4>
			<?php else : ?>
				<a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
			<?php endif; ?>
			<?php if ( get_sub_field( 'module_cta_intro' ) ) : ?>
				<?php echo get_sub_field( 'module_cta_intro' ); ?>
			<?php endif; ?>
		</div>
		<div class="tags-holder">
			<?php
			if ( $module_call_to_action_link_type === 'link-interno' ) :
				$module_call_to_action_link_internal = get_sub_field( 'module_call_to_action_link_internal' );
				?>
				<?php foreach ( $module_call_to_action_link_internal as $post ) :
					setup_postdata( $post ); ?>
					<?php if ( $module_call_to_action_link_appearence === 'link-button' ) : ?>
						<a href="<?php the_permalink(); ?>" class="square-button green filled" title="<?php the_title(); ?>"
							aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" class="tag-button filled-button" title="<?php the_title(); ?>"
							aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
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
							<a href="<?php echo $module_call_to_action_repeater_destination; ?>" class="square-button green filled"
								title="<?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?>"
								aria-label="<?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?>" target="_blank"
								rel="nofollow"><?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?></a>
						<?php else : ?>
							<a href="<?php echo $module_call_to_action_repeater_destination; ?>" class="tag-button filled-button"
								title="<?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?>"
								aria-label="<?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?>" target="_blank"
								rel="nofollow"><?php the_sub_field( 'module_call_to_action_repeater_testo' ); ?></a>
						<?php endif; ?>
					<?php endwhile; endif; ?>
			<?php endif; ?>
		</div>

	</div>
</section>
<!-- module-cta -->