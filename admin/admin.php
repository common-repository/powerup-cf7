<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
  // Exit if accessed directly

add_action( 'admin_menu', 'powerup_cf7_admin_menu', 8 );

function powerup_cf7_admin_menu(){
	global $_wp_last_object_menu;

	$_wp_last_object_menu++;

	add_menu_page(
		__( 'Powerup CF7 Configure', 'powerup_cf7_configure' ),
		__( 'Powerup CF7', 'powerup_cf7_configure' ),
		'powerup_cf7_edit_form', 'powerup_cf7_configure',
		'powerup_cf7_admin_page', 'dashicons-sos',
		$_wp_last_object_menu );
}

function powerup_cf7_admin_page(){
	include('edit-form.php');
}

add_action('admin_print_styles', 'powerup_cf7_admin_enqueue_style');

function powerup_cf7_admin_enqueue_style() {
	wp_enqueue_style( 'myCSS', plugins_url( 'style.css', __FILE__ ) );
}