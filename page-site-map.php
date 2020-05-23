<?php
/**
*  Paperplane _blankTheme
 * Template Name: Pagina site map
*/
get_header();
?>
<?php
while ( have_posts() ) : the_post();
 ?>
  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-intro">
        <div class="single-content-opening-padder">
          <div class="breadcrumbs-holder grey-links undelinked-links" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php bcn_display(); ?>
          </div>

          <div class="flex-hold flex-hold-page-opening">
            <div class="page-opening-left printable">
              <h1><?php the_title(); ?></h1>
              <?php if ( get_field( 'page_abstract' ) ) : ?>
                <p class="paragraph-variant">
                  <?php the_field( 'page_abstract' ); ?>
                </p>
              <?php endif; ?>
            </div>
            <div class="page-opening-right no-print">
              <div class="padder">
                <?php include( locate_template( 'template-parts/grid/intro-actions.php' ) ); ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>



  <div class="wrapper">
    <div class="wrapper-padded">
      <div class="wrapper-padded-more">
          <div class="wrapper-padded-more-780 modules-wrapper">
            <div class="padder">
              <div class="text-module">
                <div class="module-separator">
                  <div class="last-child-no-margin">
                    <?php page_site_map(); ?>
                  </div>
                </div>
              </div>

            </div>
          </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>
<?php get_footer(); ?>
