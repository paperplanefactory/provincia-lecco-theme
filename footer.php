<?php
// Paperplane _blankTheme - template per footer.
wp_reset_query();
global $acf_options_parameter;
global $footer_wrapper;
?>
<footer id="footer" class="bg-3 txt-12 white-links paragraph-variant-holder">
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="<?php echo $footer_wrapper; ?>">
        <div class="flex-hold flex-hold-4 margins-wide footer-block-1 lined-mobile">
          <div class="flex-hold-child">
            <h5 class="allupper">Amministrazione</h5>
            <?php
            if ( has_nav_menu( 'footer-menu-amministrazione' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu-amministrazione', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Servizi</h5>
            <?php
            if ( has_nav_menu( 'footer-menu-servizi' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu-servizi', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Novità</h5>
            <?php
            if ( has_nav_menu( 'footer-menu-novita' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu-novita', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Documenti</h5>
            <?php
            if ( has_nav_menu( 'footer-menu-documenti' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu-documenti', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>
        </div>
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
            <?php the_field( 'informazioni_newsletter', $acf_options_parameter ); ?>
            <h5 class="allupper">Seguici su</h5>
            <?php if ( have_rows( 'global_socials', 'option' ) ) : ?>
              <ul class="inline-socials">
                <?php while ( have_rows( 'global_socials', 'option' ) ) : the_row(); ?>
                  <li>
                    <a href="<?php the_sub_field( 'global_socials_profile_url' ); ?>" target="_blank" aria-label="Visit <?php the_sub_field( 'global_socials_profile_url' ); ?>" rel="noopener">
                      <i class="<?php the_sub_field( 'global_socials_icona' ); ?>" aria-hidden="true"></i>
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
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
