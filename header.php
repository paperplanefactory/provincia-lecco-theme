<?php
// Paperplane _blankTheme - template per header.
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#3499EF">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#3499EF">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#3499EF">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	wp_head();
	global $acf_options_parameter;
	if ( function_exists( 'pll_the_languages' ) ) {
		$acf_options_parameter = pll_current_language( 'slug' );
	} else {
		$acf_options_parameter = 'any-lang';
	}
	global $header_wrapper;
	global $mega_menu_wrapper;
	$header_width = get_field( 'theme_header_width', 'option' );
	if ( $header_width === 'full-width' ) {
		$header_wrapper = '';
		$mega_menu_wrapper = '';
	}
	if ( $header_width === 'contained-width' ) {
		$header_wrapper = 'wrapper-padded-intro';
	}
	global $footer_wrapper;
	$footer_width = get_field( 'theme_footer_width', 'option' );
	if ( $footer_width === 'full-width' ) {
		$footer_wrapper = 'wrapper-padded-intro';
	}
	if ( $footer_width === 'contained-width' ) {
		$footer_wrapper = 'wrapper-padded-more';
	}
	$static_bloginfo_stylesheet_directory = get_bloginfo( 'stylesheet_directory' );
	global $today;
	$today = date( 'Y-m-d H:i:s' );
	?>
	<link rel="apple-touch-icon" sizes="57x57"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/favicon-16x16.png">
	<link rel="manifest"
		href="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage"
		content="<?php echo $static_bloginfo_stylesheet_directory; ?>/assets/images/favicons/ms-icon-144x144.png">
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php echo $static_bloginfo_stylesheet_directory; ?>/ie-only.min.css" />
<![endif]-->
</head>

<body>
	<nav class="accessible-navi-container" aria-label="Navigazione rapida">
		<!-- link per saltare la navigazione principale -->
		<a href="#page-content" id="skip-to-content" class="accessible-navi square-button green filled">
			Vai al contenuto principale
		</a>
		<a href="#footer" id="skip-to-footer" class="accessible-navi square-button green filled">
			Vai al piede di pagina
		</a>
	</nav>
	<div id="preheader"></div>
	<header id="header" class="bg-3 txt-12 white-links paragraph-variant-holder">
		<div class="wrapper bg-2 header-first-stripe underlined-links-on-hover">
			<div class="wrapper-padded">
				<div class="<?php echo $header_wrapper; ?>">
					<?php
					if ( has_nav_menu( 'header-menu-above' ) ) {
						wp_nav_menu( array( 'theme_location' => 'header-menu-above', 'container' => 'ul', 'menu_class' => 'header-menu-top' ) );
					}
					?>
				</div>
			</div>
		</div>
		<div class="wrapper-padded">
			<div class="<?php echo $header_wrapper; ?>">
				<div id="header-structure">
					<div class="logo">
						<a href="<?php echo home_url(); ?>" rel="bookmark" class="absl">
							<span class="screen-reader-text">
								Homepage | Sito istituzionale della Provincia di Lecco
							</span>
						</a>
					</div>
					<div class="side-head">
						<ul>

							<li class="search-menu">
								<button onclick="openSearch()" id="seach-overlay-heading"
									class="activate-search activate-search-js button-appearance-normalizer"
									aria-label="Cerca" aria-expanded="false" aria-controls="search-overlay"
									aria-haspopup="dialog" data-collapsed="Apri pannello di ricerca"
									data-expanded="Chiudi pannello di ricerca">
									<span class="lablel">Cerca</span>
									<div class="icon-hold">
										<span class="icon-search"></span>
									</div>
								</button>
							</li>
							<li class="hamb-menu">
								<button onclick="hamburgerMenu()" aria-expanded="false" aria-label="Menu"
									data-collapsed="Apri il menu di navigazione"
									data-expanded="Chiudi il menu di navigazione" aria-controls="head-overlay"
									class="hambuger-element ham-activator">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>
							</li>
						</ul>
					</div>
					<nav class="menu navi" aria-label="Principale">
						<?php
						if ( has_nav_menu( 'header-menu-left' ) ) {
							wp_nav_menu( array( 'theme_location' => 'header-menu-left', 'container' => 'ul', 'menu_class' => 'header-menu header-menu-js underlined-links-on-hover' ) );
						}
						?>
						<?php
						if ( has_nav_menu( 'header-menu-right' ) ) {
							wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'container' => 'ul', 'menu_class' => 'header-menu head-navi-side underlined-links-on-hover' ) );
						}
						?>
					</nav>
				</div>
			</div>
		</div>
	</header>





	<nav id="header-compact" class="hidden bg-3 txt-12 white-links paragraph-variant-holder" aria-label="Menu compatto">
		<div class="wrapper-padded">
			<div class="<?php echo $header_wrapper; ?>">
				<div id="header-structure">
					<div class="logo">
						<a href="<?php echo home_url(); ?>" rel="bookmark" class="absl">
							<span class="screen-reader-text">Homepage | Sito istituzionale della
								<?php echo get_bloginfo( 'name' ); ?></span>
						</a>
					</div>
					<nav class="menu navi" aria-label="Principale">
						<?php
						if ( has_nav_menu( 'header-menu-left' ) ) {
							wp_nav_menu( array( 'theme_location' => 'header-menu-left', 'container' => 'ul', 'menu_class' => 'header-menu header-menu-js underlined-links-on-hover' ) );
						}
						?>
						<?php
						if ( has_nav_menu( 'header-menu-right' ) ) {
							wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'container' => 'ul', 'menu_class' => 'header-menu head-navi-side underlined-links-on-hover' ) );
						}
						?>
					</nav>
					<div class="side-head">
						<ul>
							<li class="search-menu">
								<button onclick="openSearch()" id="seach-overlay-heading"
									class="activate-search activate-search-js" aria-label="Cerca" aria-expanded="false"
									aria-controls="search-overlay" aria-haspopup="dialog"
									data-collapsed="Apri pannello di ricerca"
									data-expanded="Chiudi pannello di ricerca">
									<span class="icon-search"></span>
								</button>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</nav>

	<banner id="search-overlay" class="hidden bg-12" aria-labelledby="seach-overlay-heading" role="dialog"
		aria-modal="true" aria-label="Pannello di ricerca">
		<div class="scroll-opportunity">
			<div class="wrapper">
				<div class="wrapper-padded">
					<div class="<?php echo $header_wrapper; ?>">
						<div class="search-overlay-structure">
							<div class="flex-hold flex-hold-2 margins-wide keep-2-mobile">
								<div class="flex-hold-child">
									<h2 id="search-overlay-heading">Cerca</h2>
								</div>
								<div class="flex-hold-child alignright">
									<button onclick="closeSearch()"
										class="search-overlay-title search-overlay-title-js button-appearance-normalizer"
										aria-label="Chiudi pannello di ricerca"><span
											class="icon-close"></span></button>
								</div>
							</div>
							<div class="search-form overlay-form">
								<form action="<?php the_field( 'archives_url_ricerca', 'any-lang' ); ?>" role="search"
									autocomplete="off" class="suggested-results-form-js search-form">
									<label for="search-kw-header-input">Digita una parola chiave per la ricerca:</label>
									<input id="search-kw-header-input" type="text" name="search-kw"
										class="search-autocomplete search-input-kw-js search-input-kw-js-ovarlay"
										placeholder="Cerca informazioni, persone, servizi" role="combobox"
										aria-controls="search-suggestion-area" aria-haspopup="listbox" maxlength="100"
										autocomplete="off" spellcheck="true" />

									<button type="submit" class="search-submit search-submit-js" aria-label="Cercaa">
										<span class="icon-search"></span>
									</button>
									<!--
										<button onclick="searchErase()" class="search-erase search-erase-js"
										aria-label="Cancella il contenuto della casella di testo">x</button>
					-->
								</form>
								<ul class="search-suggestion-area" id="search-suggestion-area" role="dialog"
									aria-modal="true" aria-label="Suggerimenti di ricerca">
								</ul>
							</div>
							<!-- Elemento invisibile per il focus trap -->
							<button class="focus-trap-end"><span class="screen-reader-text">Gestione navigazione
									finestra</span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</banner>



	<div id="head-overlay" class="hidden bg-3 txt-12 white-links paragraph-variant-holder">
		<div class="scroll-opportunity">
			<div class="wrapper">
				<div class="wrapper-padded">
					<div class="<?php echo $header_wrapper; ?>">
						<nav class="menu navi" aria-label="Principale">
							<?php
							if ( has_nav_menu( 'header-menu-left' ) ) {
								wp_nav_menu( array( 'theme_location' => 'header-menu-left', 'container' => 'ul', 'menu_class' => 'header-menu header-menu-mobile header-menu-js' ) );
							}
							?>
							<?php
							if ( has_nav_menu( 'header-menu-right' ) ) {
								wp_nav_menu( array( 'theme_location' => 'header-menu-right', 'container' => 'ul', 'menu_class' => 'header-menu head-navi-side' ) );
							}
							?>
						</nav>

						<?php if ( have_rows( 'global_socials', 'option' ) ) : ?>
							<p class="as-h5 allupper txt-12">Seguici su</p>
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

						<div class="flex-hold flex-hold-4 margins-wide footer-block-2 lined-mobile">

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
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Elemento invisibile per il focus trap -->
			<button class="hamburger-focus-trap-end"><span class="screen-reader-text">Gestione navigazione
					finestra</span></button>
		</div>
	</div>
	<main id="page-content" tabindex="-1"><!-- si chiude in footer -->
		<?php
		$meta_query_avvisi = array(
			array(
				'key' => 'scadenza_avviso',
				'value' => $today,
				'compare' => '>=',
			),
		);
		$args_avvisi = array(
			'post_type' => 'avviso_cpt',
			'posts_per_page' => 1,
			'meta_query' => $meta_query_avvisi,
		);
		$my_avvisi = get_posts( $args_avvisi );
		if ( ! empty( $my_avvisi ) ) :
			?>
			<?php foreach ( $my_avvisi as $post ) :
				setup_postdata( $post ); ?>
				<?php include( locate_template( 'template-parts/grid/avviso.php' ) ); ?>
			<?php endforeach;
			wp_reset_postdata(); ?>
		<?php endif; ?>