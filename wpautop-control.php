<?php
/*
Plugin Name: wpautop-control
Plugin URI: http://blog.bigsmoke.us/tag/wpautop-control/
Description: This plugin allows you fine control of when and when not to enable the wpautop filter on posts.
Author: Rowan Rodrik van der Molen
Author URI: http://blog.bigsmoke.us/
Version: 1.0
*/

if ( is_admin() ) {
  add_action('admin_menu', 'wpautop_control_menu');
  add_action('admin_init', 'wpautop_control_settings');

  function wpautop_control_menu() {
    add_submenu_page('options-general.php', 'wpautop-control', 'wpautop control', 'manage_options', 'wpautop-control-menu', 'wpautop_control_options');
  }

  function wpautop_control_options() {
    if (!current_user_can('manage_options'))  {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

  ?>
  <div class="wrap">
    <h2>wpautop control options</h2>

    <form method="post" action="options.php">
      <?php settings_fields('wpautop-control') ?>
      <table class="form-table">
        <tr valign="top">
          <th scope="row">wpautop filter on by default?</th>
          <td>
            <label><input type="radio" name="wpautop_on_by_default" value="1" <?php if ( get_option('wpautop_on_by_default') == '1' ) echo 'checked="1"' ?>> yes</label>
            <label><input type="radio" name="wpautop_on_by_default" value="0" <?php if ( get_option('wpautop_on_by_default') == '0' ) echo 'checked="1"' ?>> no</label>
          </td>
      </table>

      <p class="submit">
      <input type="submit" class="button-primary" value="Save Changes" />
      </p>
    </form>
  </div>
  <?php
  }

  function wpautop_control_settings() {
    register_setting('wpautop-control', 'wpautop_on_by_default', 'intval');
  }
}
else { // ! is_admin()
  add_filter('the_content', 'wpautop_control_filter', 9);

  function wpautop_control_filter($content) {
    global $post;

    // Get the keys and values of the custom fields:
    $post_wpautop_value = get_post_meta($post->ID, 'wpautop', true);

    $default_wpautop_value = intval( get_option('wpautop_on_by_default', '1') );

    $remove_filter = false;
    if ( empty($post_wpautop_value) )
      $remove_filter = ! $default_wpautop_value;
    elseif ($post_wpautop_value == 'true')
      $remove_filter = false;
    elseif ($post_wpautop_value == 'false')
      $remove_filter = true;

    if ( $remove_filter ) {
      remove_filter('the_content', 'wpautop');
      remove_filter('the_excerpt', 'wpautop');
    }

    return $content;
  }
}

?>
