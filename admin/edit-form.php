<?php 
  if ( ! defined( 'ABSPATH' ) ) exit; 
  // Exit if accessed directly

  $nonce = $_REQUEST['_wpnonce'];

  if($_POST['sokt_hidden'] == 'Y' && wp_verify_nonce( $nonce, 'save_sokt_url' )) {
    //Form data sent
    $sokt_url = sanitize_text_field( $_POST['sokt_store_url'] );
    if (filter_var($sokt_url, FILTER_VALIDATE_URL) === FALSE || $sokt_url === '') {?>
      <div class="error"><p><strong><?php _e('Invalid URL.' ); ?></strong></p></div>
    <?php
    }
    else{
      update_option('sokt_store_url', $sokt_url);
      ?>
      <div class="updated"><p><strong><?php _e('URL saved.' ); ?></strong></p></div>
      <?php
    }
  } 
  else {
    //Normal page display
    $sokt_url = get_option('sokt_store_url');
  }
?>

<?php
//member, author, editor, administrator
$user = wp_get_current_user();
$allowed_roles = array('administrator');
if( array_intersect($allowed_roles, $user->roles ) ) {  ?> 
  <div class="wrap">
    <?php echo "<h2>" . __( 'Powerup CF7 Configure', 'sokt_trdom' ) . "</h2>"; ?>
     
    <form class="sokt_form" name="sokt_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

      <?php wp_nonce_field( 'save_sokt_url' ); ?>
      <input type="hidden" name="sokt_hidden" value="Y">
      <div>
          <label class="sokt-label"><?php _e("Socket URL: " ); ?></label>
          <input class="sokt-input"  type="text" name="sokt_store_url" 
          value="<?php echo esc_url( $sokt_url ); ?>">
          <label class="sokt-input-help"><?php _e(" ex: https://viasocket.com/" ); ?></label>
      </div>
      <div class="submit">
          <input class="sokt-btn" type="submit" name="Submit" value="<?php _e('Save', 'sokt_trdom' ) ?>" />
      </div>
    </form>
  </div>
<?php } else{ ?>
  <div class="wrap">
    <?php echo "<h2>" . __( 'You does not have permissions for edit', 'sokt_trdom' ) . "</h2>"; ?>
    <input class="sokt-input" readonly="true" type="text" name="sokt_store_url" value="<?php echo esc_url( $sokt_url ); ?>">
  </div>
<?php } ?>



