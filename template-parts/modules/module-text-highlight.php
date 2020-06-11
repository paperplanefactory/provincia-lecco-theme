<!-- module-text-highlight -->
<section class="card-module">
  <div class="module-separator">
    <div class="content-styled">
      <?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
        <h4 class="lighter-h4"><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a><?php the_sub_field( 'module_index_title' ); ?></h4>
      <?php else : ?>
        <a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
      <?php endif; ?>
      <div class="card-outline green insite">
        <?php if ( get_sub_field( 'module_highlight_text_icon' ) != 'none' ) : ?>
          <div class="icon-box">
            <span class="<?php the_sub_field( 'module_highlight_text_icon' ); ?>"></span>
          </div>
        <?php endif; ?>
        <div class="card_inner regular-card last-child-no-margin">
          <?php the_sub_field( 'module_highlight_text_content' ); ?>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- module-text-highlight -->
