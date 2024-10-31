<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
  // Exit if accessed directly
/**
* Plugin Name: Powerup CF7
* Plugin URI: http://viasocket.com/
* Description: Post your contact form 7 data to Socket.
* Version: 1.0
* Author: Sarfaraz Ansari
* Author URI: https://sarfarazansari.github.io/
* License: MIT
*/
// wpcf7_mail_sent
// wpcf7_submit
//powerup_cf7
//POWERUP_CF7
add_action( 'wpcf7_mail_sent', 'powerup_cf7_post_form_data' );

function powerup_cf7_post_form_data( $contact_form ) {
  $title = $contact_form->title;
  $submission = WPCF7_Submission::get_instance();
  if ( $submission ) {
  	$posted_data = $submission->get_posted_data();
  }

  $args = array(
    'method' => 'POST',
    'body' => json_encode($posted_data),
    'timeout' => '30',
    'redirection' => '10',
    'httpversion' => '1.0',
    'blocking' => true,
    'headers' => array( 
      "Content-type" => "application/json",
      "Cache-Control" => "no-cache",
      "Sent-From" => "powerup_cf7"
    )
  );

  wp_remote_request(get_option('sokt_store_url'), $args );

}


define( 'POWERUP_CF7_VERSION', '1.0' );
define( 'POWERUP_CF7_PLUGIN', __FILE__ );
define( 'POWERUP_CF7_PLUGIN_DIR',
  untrailingslashit( dirname( POWERUP_CF7_PLUGIN ) ) );

require_once POWERUP_CF7_PLUGIN_DIR . '/includes/capabilities.php';
require_once POWERUP_CF7_PLUGIN_DIR . '/admin/admin.php';





