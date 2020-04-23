<?php
// Add the role to WordPress list of roles
// Then add the capability 'organize_shop' to the 'shop_owner' role
$role = add_role( 'servizi_editor', 'Editor servizi', ['edit_posts' => true]);
$role->add_cap( 'servizi_cpt_manager' );


// If 'shop_owner' already exists make `$wp_roles` visible then
// add the capability 'organize_shop' to the 'Show Owner' role
public $wp_roles;
$wp_roles->add_cap( 'servizi_editor', 'servizi_cpt_manager' );
