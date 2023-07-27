<!-- map-module-plugin -->
<?php if (get_sub_field('module_index_title_in_module') == 1): ?>
    <div class="content-styled">
        <h4 class="rebold"><a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
            <?php the_sub_field('module_index_title'); ?>
        </h4>
    </div>
<?php else: ?>
    <a name="indice-<?php echo $module_count; ?>" class="anchor-head"></a>
<?php endif; ?>
<section class="map-module-plugin">
    <div class="video_frame">
        <?php
        $shortcode_mappa = get_sub_field('shortcode_mappa');
        echo do_shortcode('' . $shortcode_mappa . ''); ?>
    </div>
</section>
<!-- map-module-plugin -->