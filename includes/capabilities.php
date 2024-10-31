<?php

add_filter( 'map_meta_cap', 'powerup_cf7_map_meta_cap', 10, 4 );

function powerup_cf7_map_meta_cap( $caps, $cap, $user_id, $args ) {
	$meta_caps = array(
		'powerup_cf7_edit_forms' => 'edit_users',
		'powerup_cf7_edit_form' => 'edit_users');

	$meta_caps = apply_filters( 'powerup_cf7_map_meta_cap', $meta_caps );

	$caps = array_diff( $caps, array_keys( $meta_caps ) );

	if ( isset( $meta_caps[$cap] ) ) {
		$caps[] = $meta_caps[$cap];
	}

	return $caps;
}
