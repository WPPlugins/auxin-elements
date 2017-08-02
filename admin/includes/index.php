<?php // load admin related classes & functions

// load admin related functions
include_once( 'admin-the-functions.php' );


do_action( 'auxels_admin_classes_loaded' );

// load admin related functions
include_once( 'admin-hooks.php' );

// init the class for extending the menu nav in back-end
Auxin_Master_Nav_Menu_Admin::get_instance();

// custom permalink setting fields for custom post types
//$axi_permalink = new Auxin_Permalink();
//$axi_permalink->setup();

// init Auxin_Install
// init Auxin_Admin_Dashboard
// init Auxin_Import
// init
