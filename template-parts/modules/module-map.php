<!-- module-map -->
<?php if ( get_sub_field( 'module_index_title_in_module' ) == 1 ) : ?>
  <div class="content-styled">
    <h4><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a><?php the_sub_field( 'module_index_title' ); ?></h4>
  </div>
<?php else : ?>
  <a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
<?php endif; ?>
<div class="map-module">
  <div class="video_frame">
    <?php the_sub_field( 'module_map_embed' ); ?>
  </div>
</div>
<!-- module-map -->
