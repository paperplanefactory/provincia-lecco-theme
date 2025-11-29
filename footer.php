<?php
// Paperplane _blankTheme - template per footer.
wp_reset_query();
global $acf_options_parameter;
global $footer_wrapper;
?>
</main><!-- si apre in header -->
<footer id="footer" class="bg-3 txt-12 white-links paragraph-variant-holder underlined-links-on-hover">
	<div class="wrapper">
		<div class="wrapper-padded">
			<div class="<?php echo $footer_wrapper; ?>">
				<div class="flex-hold flex-hold-4 margins-wide footer-block-1 lined-mobile">
					<div class="flex-hold-child">
						<h2 class="as-h5 allupper txt-12">Amministrazione</h2>
						<?php
						if ( has_nav_menu( 'footer-menu-amministrazione' ) ) {
							wp_nav_menu( array( 'theme_location' => 'footer-menu-amministrazione', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
						}
						?>
					</div>

					<div class="flex-hold-child">
						<h2 class="as-h5 allupper txt-12">Servizi</h2>
						<?php
						if ( has_nav_menu( 'footer-menu-servizi' ) ) {
							wp_nav_menu( array( 'theme_location' => 'footer-menu-servizi', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
						}
						?>
					</div>

					<div class="flex-hold-child">
						<h2 class="as-h5 allupper txt-12">Novità</h2>
						<?php
						if ( has_nav_menu( 'footer-menu-novita' ) ) {
							wp_nav_menu( array( 'theme_location' => 'footer-menu-novita', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
						}
						?>
					</div>

					<div class="flex-hold-child">
						<h2 class="as-h5 allupper txt-12">Documenti</h2>
						<?php
						if ( has_nav_menu( 'footer-menu-documenti' ) ) {
							wp_nav_menu( array( 'theme_location' => 'footer-menu-documenti', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
						}
						?>
					</div>
				</div>
				<div class="flex-hold flex-hold-4 margins-wide footer-block-2 lined-mobile h2-as-h5">
					<div class="flex-hold-child">
						<?php the_field( 'informazioni_amministrazione_trasparente', $acf_options_parameter ); ?>
					</div>
					<div class="flex-hold-child">
						<?php the_field( 'informazioni_carta_dei_servizi', $acf_options_parameter ); ?>
					</div>
					<div class="flex-hold-child">
						<?php the_field( 'informazioni_contatti', $acf_options_parameter ); ?>
					</div>
					<div class="flex-hold-child">
						<?php echo get_field( 'informazioni_newsletter', $acf_options_parameter ); ?>
						<?php if ( have_rows( 'global_socials', 'option' ) ) : ?>
							<h2 class="as-h5 allupper txt-12">Seguici su</h2>
							<ul class="inline-socials">
								<?php while ( have_rows( 'global_socials', 'option' ) ) :
									the_row();

									// Ottieni l'URL del profilo
									$profile_url = get_sub_field( 'global_socials_profile_url' );

									// Estrai il nome del social dalla URL
									$social_name = '';

									// Estrarre dominio dalla URL
									$url_parts = parse_url( $profile_url );
									$domain = isset( $url_parts['host'] ) ? $url_parts['host'] : '';

									// Estrai il nome del social media dal dominio
									if ( strpos( $domain, 'facebook.com' ) !== false ) {
										$social_name = 'Facebook';
									} elseif ( strpos( $domain, 'twitter.com' ) !== false || strpos( $domain, 'x.com' ) !== false ) {
										$social_name = 'Twitter';
									} elseif ( strpos( $domain, 'instagram.com' ) !== false ) {
										$social_name = 'Instagram';
									} elseif ( strpos( $domain, 'linkedin.com' ) !== false ) {
										$social_name = 'LinkedIn';
									} elseif ( strpos( $domain, 'youtube.com' ) !== false ) {
										$social_name = 'YouTube';
									} elseif ( strpos( $domain, 'tiktok.com' ) !== false ) {
										$social_name = 'TikTok';
									} elseif ( strpos( $domain, 'pinterest.com' ) !== false ) {
										$social_name = 'Pinterest';
									} elseif ( strpos( $domain, 'github.com' ) !== false ) {
										$social_name = 'GitHub';
									} elseif ( strpos( $domain, 'snapchat.com' ) !== false ) {
										$social_name = 'Snapchat';
									} elseif ( strpos( $domain, 'whatsapp.com' ) !== false ) {
										$social_name = 'WhatsApp';
									} elseif ( strpos( $domain, 'telegram.org' ) !== false || strpos( $domain, 't.me' ) !== false ) {
										$social_name = 'Telegram';
									} elseif ( strpos( $domain, 'reddit.com' ) !== false ) {
										$social_name = 'Reddit';
									} elseif ( strpos( $domain, 'discord.com' ) !== false || strpos( $domain, 'discord.gg' ) !== false ) {
										$social_name = 'Discord';
									} elseif ( strpos( $domain, 'medium.com' ) !== false ) {
										$social_name = 'Medium';
									} elseif ( strpos( $domain, 'tumblr.com' ) !== false ) {
										$social_name = 'Tumblr';
									} elseif ( strpos( $domain, 'flickr.com' ) !== false ) {
										$social_name = 'Flickr';
									} elseif ( strpos( $domain, 'vimeo.com' ) !== false ) {
										$social_name = 'Vimeo';
									} elseif ( strpos( $domain, 'twitch.tv' ) !== false ) {
										$social_name = 'Twitch';
									} else {
										// Fallback: usa il dominio senza .com/.org/ecc.
										$domain_parts = explode( '.', $domain );
										$social_name = ucfirst( $domain_parts[0] );
									}

									// Se hai già il nome del social in un campo, puoi usare quello invece
									$icon_class = get_sub_field( 'global_socials_icon' );

									// Se l'icona è in formato "icon-facebook" puoi estrarre il nome dall'icona
									if ( empty( $social_name ) && ! empty( $icon_class ) ) {
										$icon_parts = explode( '-', $icon_class );
										if ( count( $icon_parts ) > 1 ) {
											$social_name = ucfirst( $icon_parts[1] );
										}
									}

									// Costruisci l'aria-label
									$aria_label = $social_name;
									?>
									<li>
										<a href="<?php echo esc_url( $profile_url ); ?>"
											class="social-icorn <?php echo esc_attr( $icon_class ); ?>" target="_blank"
											aria-label="<?php echo esc_attr( $aria_label ); ?>" rel="noopener">
										</a>
									</li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapper bg-2">
		<div class="wrapper-padded">
			<div class="<?php echo $footer_wrapper; ?>">
				<?php
				if ( has_nav_menu( 'footer-menu-legal' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer-menu-legal', 'container' => 'ul', 'menu_class' => 'footer-menu-bottom' ) );
				}
				?>
				<ul class="footer-menu-bottom">
					<li>
						Sito realizzato da <a
							href="https://paperplanefactory.com/case-study/linee-guida-agid-sito-web-wordpress/"
							target="_blank">PaperPlane</a>
						basato su <a href="https://wordpress.org/" target="_blank">WordPress</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>