# Tema WordPress per la Provincia di Lecco
Tema WordPress per il Sito Istituzionale della Provincia di Lecco basato sulle linee guida di https://www.agid.gov.it/

La gestione dei singoli contenuti e delle opzioni del sito è basata su Advanced Custom Fields PRO. Tutti i campi gestiti da ACF PRO sono inclusi nella cartella acf-json e sono pronti per la sincronizzazione.

## CPT necessari:

```
function cptui_register_my_cpts() {

	/**
	 * Post Type: Servizi.
	 */

	$labels = [
		"name" => __( "Servizi", "custom-post-type-ui" ),
		"singular_name" => __( "Servizio", "custom-post-type-ui" ),
		"menu_name" => __( "Servizi", "custom-post-type-ui" ),
		"all_items" => __( "Tutti i servizi", "custom-post-type-ui" ),
		"add_new" => __( "Aggiungi nuovo", "custom-post-type-ui" ),
		"add_new_item" => __( "Aggiungi nuovo servizio", "custom-post-type-ui" ),
		"edit_item" => __( "Modifica servizio", "custom-post-type-ui" ),
		"new_item" => __( "Nuovo servizio", "custom-post-type-ui" ),
		"view_item" => __( "Visualizza servizio", "custom-post-type-ui" ),
		"view_items" => __( "vedi servizio", "custom-post-type-ui" ),
		"search_items" => __( "Cerca tra i servizi", "custom-post-type-ui" ),
		"not_found" => __( "Nessun servizio trovato", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "Nessun servizio trovato nel cestino", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Servizi", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "servizio", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-clipboard",
		"supports" => [ "title", "editor", "thumbnail", "revisions", "author" ],
		"taxonomies" => [ "servizi_tax" ],
	];

	register_post_type( "servizi_cpt", $args );

	/**
	 * Post Type: Amministrazione.
	 */

	$labels = [
		"name" => __( "Amministrazione", "custom-post-type-ui" ),
		"singular_name" => __( "Amministrazione", "custom-post-type-ui" ),
		"menu_name" => __( "Amministrazione", "custom-post-type-ui" ),
		"all_items" => __( "Tutti gli elementi di amministrazione", "custom-post-type-ui" ),
		"add_new" => __( "Aggiungi nuovo elemento di amministrazione", "custom-post-type-ui" ),
		"add_new_item" => __( "Aggiungi nuovo elemento di amministrazione", "custom-post-type-ui" ),
		"edit_item" => __( "Modifica elemento di amministrazione", "custom-post-type-ui" ),
		"new_item" => __( "Nuovo elemento di amministrazione", "custom-post-type-ui" ),
		"view_item" => __( "Vedi elemento di amministrazione", "custom-post-type-ui" ),
		"view_items" => __( "Vedi elementi di amministrazione", "custom-post-type-ui" ),
		"search_items" => __( "Cerca elementi di amministrazione", "custom-post-type-ui" ),
		"not_found" => __( "Nessun elemento di amministrazione trovato", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "Nessun elemento di amministrazione trovato nel cestino", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Amministrazione", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "elemento-amministrazione", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-admin-home",
		"supports" => [ "title", "editor", "thumbnail", "revisions", "author" ],
		"taxonomies" => [ "amministrazione_tax" ],
	];

	register_post_type( "amministrazione_cpt", $args );

	/**
	 * Post Type: Documenti.
	 */

	$labels = [
		"name" => __( "Documenti", "custom-post-type-ui" ),
		"singular_name" => __( "Documento", "custom-post-type-ui" ),
		"menu_name" => __( "Documenti", "custom-post-type-ui" ),
		"all_items" => __( "Tutti i documenti", "custom-post-type-ui" ),
		"add_new" => __( "Aggiungi nuovo documento", "custom-post-type-ui" ),
		"add_new_item" => __( "Aggiungi nuovo documento", "custom-post-type-ui" ),
		"edit_item" => __( "Modifica documento", "custom-post-type-ui" ),
		"new_item" => __( "Nuovo documento", "custom-post-type-ui" ),
		"view_item" => __( "Visualizza documento", "custom-post-type-ui" ),
		"view_items" => __( "Vedi documenti", "custom-post-type-ui" ),
		"search_items" => __( "Cerca documenti", "custom-post-type-ui" ),
		"not_found" => __( "Nessun documento trovato", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "Nessun documento trovato nel cestino", "custom-post-type-ui" ),
		"parent" => __( "Documento genitore", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Documento genitore", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Documenti", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "documento", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-media-spreadsheet",
		"supports" => [ "title", "editor", "thumbnail", "revisions", "author" ],
		"taxonomies" => [ "documenti_tax" ],
	];

	register_post_type( "documenti_cpt", $args );

	/**
	 * Post Type: Progetti.
	 */

	$labels = [
		"name" => __( "Progetti", "custom-post-type-ui" ),
		"singular_name" => __( "Progetto", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Progetti", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "progetto", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-excerpt-view",
		"supports" => [ "title", "thumbnail", "revisions", "author" ],
		"taxonomies" => [ "argomenti_tax", "aree_amministrative_tax" ],
	];

	register_post_type( "progetti_cpt", $args );

	/**
	 * Post Type: Argomenti.
	 */

	$labels = [
		"name" => __( "Argomenti", "custom-post-type-ui" ),
		"singular_name" => __( "Argomento", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Argomenti", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "argomento", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-pressthis",
		"supports" => [ "title", "thumbnail", "revisions", "author" ],
	];

	register_post_type( "argomento_cpt", $args );

	/**
	 * Post Type: Siti tematici.
	 */

	$labels = [
		"name" => __( "Siti tematici", "custom-post-type-ui" ),
		"singular_name" => __( "Sito tematico", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Siti tematici", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "siti_tematici_cpt", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-admin-site-alt3",
		"supports" => [ "title", "thumbnail", "revisions", "author" ],
		"taxonomies" => [ "argomenti_tax" ],
	];

	register_post_type( "siti_tematici_cpt", $args );

	/**
	 * Post Type: Avvisi (per tutto il sito).
	 */

	$labels = [
		"name" => __( "Avvisi (per tutto il sito)", "custom-post-type-ui" ),
		"singular_name" => __( "Avviso (per tutto il sito)", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Avvisi (per tutto il sito)", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "avviso_cpt", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-megaphone",
		"supports" => [ "title", "thumbnail", "revisions", "author" ],
	];

	register_post_type( "avviso_cpt", $args );

	/**
	 * Post Type: Avvisi (specifici per contenuto).
	 */

	$labels = [
		"name" => __( "Avvisi (specifici per contenuto)", "custom-post-type-ui" ),
		"singular_name" => __( "Avviso (specifici per contenuto)", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Avvisi (specifici per contenuto)", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "avviso_content_cpt", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-megaphone",
		"supports" => [ "title", "editor" ],
		"taxonomies" => [ "category", "servizi_tax", "amministrazione_tax", "documenti_tax" ],
	];

	register_post_type( "avviso_content_cpt", $args );

	/**
	 * Post Type: Amministrazione Trasparente.
	 */

	$labels = [
		"name" => __( "Amministrazione Trasparente", "custom-post-type-ui" ),
		"singular_name" => __( "Amministrazione Trasparente", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Amministrazione Trasparente", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "amministrazione-trasparente", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-nametag",
		"supports" => [ "title", "editor", "thumbnail", "revisions", "page-attributes" ],
	];

	register_post_type( "amm_trasp_cpt", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
```
## Custom taxonomies necessarie:
```
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Categorie servizi.
	 */

	$labels = [
		"name" => __( "Categorie servizi", "custom-post-type-ui" ),
		"singular_name" => __( "Categoria servizi", "custom-post-type-ui" ),
		"menu_name" => __( "Categorie servizi", "custom-post-type-ui" ),
		"all_items" => __( "Tutte le categorie servizi", "custom-post-type-ui" ),
		"edit_item" => __( "Modifica categoria servizi", "custom-post-type-ui" ),
		"view_item" => __( "Visualizza  categoria servizi", "custom-post-type-ui" ),
		"update_item" => __( "Aggiorna categoria servizi", "custom-post-type-ui" ),
		"add_new_item" => __( "Aggiungi categoria servizi", "custom-post-type-ui" ),
		"parent_item" => __( "Categoria servizi genitore", "custom-post-type-ui" ),
		"search_items" => __( "Cerca categoria servizi", "custom-post-type-ui" ),
		"popular_items" => __( "Categorie servizi popolari", "custom-post-type-ui" ),
		"add_or_remove_items" => __( "Rimuovi categoria servizi", "custom-post-type-ui" ),
		"choose_from_most_used" => __( "Scegli tra le categorie servizi più utilizzate", "custom-post-type-ui" ),
		"not_found" => __( "Categoria servizi non trovata", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Categorie servizi", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'categorie-servizi', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "servizi_tax",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
			];
	register_taxonomy( "servizi_tax", [ "servizi_cpt" ], $args );

	/**
	 * Taxonomy: Categorie amministrazione.
	 */

	$labels = [
		"name" => __( "Categorie amministrazione", "custom-post-type-ui" ),
		"singular_name" => __( "Categoria amministrazione", "custom-post-type-ui" ),
		"menu_name" => __( "Categorie amministrazione", "custom-post-type-ui" ),
		"all_items" => __( "Tutte le categorie amministrazione", "custom-post-type-ui" ),
		"edit_item" => __( "Modifica categoria amministrazione", "custom-post-type-ui" ),
		"view_item" => __( "Visualizza categoria amministrazione", "custom-post-type-ui" ),
		"update_item" => __( "Aggiorna categoria amministrazione", "custom-post-type-ui" ),
		"add_new_item" => __( "Aggiungi nuova categoria amministrazione", "custom-post-type-ui" ),
		"parent_item" => __( "Categoria amministrazione genitore", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Categorie amministrazione", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'categorie-amministrazione', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "amministrazione_tax",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
			];
	register_taxonomy( "amministrazione_tax", [ "amministrazione_cpt" ], $args );

	/**
	 * Taxonomy: Categorie documenti.
	 */

	$labels = [
		"name" => __( "Categorie documenti", "custom-post-type-ui" ),
		"singular_name" => __( "Categoria documenti", "custom-post-type-ui" ),
		"menu_name" => __( "Categorie documenti", "custom-post-type-ui" ),
		"all_items" => __( "Tutte le categorie documenti", "custom-post-type-ui" ),
		"edit_item" => __( "Modifica categoria documenti", "custom-post-type-ui" ),
		"view_item" => __( "Visualizza categoria documenti", "custom-post-type-ui" ),
		"update_item" => __( "Aggiorna documenti categoria documenti", "custom-post-type-ui" ),
		"add_new_item" => __( "Aggiungi categoria documenti", "custom-post-type-ui" ),
		"parent_item" => __( "Categoria documenti genitore", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Categorie documenti", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'categorie-documenti', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "documenti_tax",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
			];
	register_taxonomy( "documenti_tax", [ "documenti_cpt", "temporary_cpt" ], $args );

	/**
	 * Taxonomy: Argomenti.
	 */

	$labels = [
		"name" => __( "Argomenti", "custom-post-type-ui" ),
		"singular_name" => __( "Argomento", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Argomenti", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'argomenti', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "argomenti_tax",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
			];
	register_taxonomy( "argomenti_tax", [ "post", "servizi_cpt", "amministrazione_cpt", "documenti_cpt", "progetti_cpt", "argomento_cpt" ], $args );

	/**
	 * Taxonomy: Organizzazione.
	 */

	$labels = [
		"name" => __( "Organizzazione", "custom-post-type-ui" ),
		"singular_name" => __( "Organizzazione", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Organizzazione", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'aree_amministrative_tax', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "aree_amministrative_tax",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
			];
	register_taxonomy( "aree_amministrative_tax", [ "post", "servizi_cpt", "amministrazione_cpt", "documenti_cpt" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
```
