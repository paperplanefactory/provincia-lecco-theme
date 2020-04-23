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
        <div class="flex-hold flex-hold-4 margins-wide footer-block-1">

          <div class="flex-hold-child">
            <h5 class="allupper">Amministrazione</h5>
            <?php
            if ( has_nav_menu( 'footer-menu' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Servizi</h5>
            <?php
            if ( has_nav_menu( 'footer-menu' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Novità</h5>
            <?php
            if ( has_nav_menu( 'footer-menu' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Documenti</h5>
            <?php
            if ( has_nav_menu( 'footer-menu' ) ) {
              wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'ul', 'menu_class' => 'footer-menu' ) );
            }
            ?>
          </div>


        </div>


        <div class="flex-hold flex-hold-4 margins-wide footer-block-2">

          <div class="flex-hold-child">
            <h5 class="allupper">Amministrazione trasparente</h5>
            <p>
              Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
            </p>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Contatti</h5>
            <p>
              Piazza Lorem ipsum dolor, 23<br />09872 Nome della città (AA)
            </p>
            <p>
              CF 0985649876
            </p>
            <p>
              indirizzopecdellente@pec.gov.it<br />+39 0609090909
            </p>
          </div>

          <div class="flex-hold-child">
            <h5 class="allupper">Newsletter</h5>
            <a href="#" class="square-button blue filled">Iscriviti</a><br />
          </div>

          <div class="flex-hold-child">
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
        if ( has_nav_menu( 'footer-menu' ) ) {
          wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => 'ul', 'menu_class' => 'footer-menu-bottom' ) );
        }
        ?>
      </div>
    </div>
  </div>
</footer>

<!--
<div class="preload-container">
  <div class="sk-folding-cube">
    <div class="sk-cube1 sk-cube"></div>
    <div class="sk-cube2 sk-cube"></div>
    <div class="sk-cube4 sk-cube"></div>
    <div class="sk-cube3 sk-cube"></div>
  </div>
</div>
-->
<?php wp_footer(); ?>
</body>
</html>
