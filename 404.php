<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header();
?>
<div class="wrapper">
  <div class="wrapper-padded">
    <div class="wrapper-padded-intro">
      <div class="single-content-opening-padder">
        <h1><a href="<?php echo home_url(); ?>"><?php the_field( '404_message', $acf_options_parameter ); ?></a></h1>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
