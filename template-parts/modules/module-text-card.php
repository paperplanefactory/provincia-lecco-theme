<!-- module-text-card -->
<?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
  <div class="content-styled">
    <h4 class="rebold"><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a><?php the_sub_field( 'module_index_title' ); ?></h4>
  </div>
<?php else : ?>
  <a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
<?php endif; ?>
<section class="card-module">
  <div class="module-separator">
    <div class="card insite">
      <div class="card_inner regular-card last-child-no-margin content-styled-card">
        <?php the_sub_field( 'module_card_text_content' ); ?>
      </div>
    </div>
  </div>
</section>
<!-- module-text-card -->
