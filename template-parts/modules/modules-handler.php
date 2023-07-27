<div class="modules-handler">
  <?php
  global $module_count;
  global $last_rep_color;
  $module_count = 0;
  if (have_rows('new_module')):
    while (have_rows('new_module')):
      the_row();
      $module_count++;
      $choose_module = get_sub_field('choose_module');
      $show_hide_module = get_sub_field('show_hide_module');
      if ($show_hide_module == 1) {
        if (is_user_logged_in()) {
          //echo '<div class="wrapper admin-hideable"><div class="admin-index">Modulo: '.$module_count.' - Tipo di modulo: '.$choose_module.' - URL: '.get_permalink().'#section-'.$module_count.'</div></div>';
        }
        echo '<a name="section-' . $module_count . '" class="section-anchor"></a>';

        switch ($choose_module) {
          // module-text
          case 'module-text':
            include(locate_template('template-parts/modules/module-text.php'));
            break;
          // module-text-highlight
          case 'module-text-highlight':
            include(locate_template('template-parts/modules/module-text-highlight.php'));
            break;
          // module-text-card
          case 'module-text-card':
            include(locate_template('template-parts/modules/module-text-card.php'));
            break;
          // module-slideshow
          case 'module-slideshow':
            include(locate_template('template-parts/modules/module-slideshow.php'));
            break;
          // module-map
          case 'module-map':
            include(locate_template('template-parts/modules/module-map.php'));
            break;
          // module-map-plugin
          case 'module-map-plugin':
            include(locate_template('template-parts/modules/module-map-plugin.php'));
            break;
          // module-video
          case 'module-video':
            include(locate_template('template-parts/modules/module-video.php'));
            break;
          // module-scadenze
          case 'module-scadenze':
            include(locate_template('template-parts/modules/module-scadenze.php'));
            break;
          // module-cta
          case 'module-cta':
            include(locate_template('template-parts/modules/module-cta.php'));
            break;
          // module-listing-auto
          case 'module-listing-auto':
            include(locate_template('template-parts/modules/module-listing-auto.php'));
            break;
          // module-documenti
          case 'module-documenti':
            include(locate_template('template-parts/modules/module-documenti.php'));
            break;
          // module-dati-progetto
          case 'module-dati-progetto':
            include(locate_template('template-parts/modules/module-dati-progetto.php'));
            break;
        }
      }

    endwhile;
  endif;
  ?>
</div>