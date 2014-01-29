<?php
/*
  Plugin Name: MarcTV Twitch Status
  Plugin URI: http://www.marctv.de/blog/marctv-wordpress-plugins/
  Description: Add your Twitch Status to your navigation menu.
  Version: 1.2.1
  Author: Marc Tönsing
  Author URI: http://www.marctv.de
  License: GPL2
 */
if (!is_admin() && get_option('mtw_channelname') && get_option('mtw_url')) {
  wp_enqueue_style(
      "jquery.twitch_status", WP_PLUGIN_URL . "/marctv-twitch-status/jquery.marctv-twitch-status.css", false, "1.0");

  wp_enqueue_script(
      "jquery.twitch_status", WP_PLUGIN_URL . "/marctv-twitch-status/jquery.marctv-twitch-status.js", array("jquery"), "1.0", 0);

  $params = array(
    'channelname' => get_option('mtw_channelname'),
    'url' => get_option('mtw_url'),
    'selector' => get_option('mtw_selector')
  );

  wp_localize_script('jquery.twitch_status', 'marctvtwitchsettings', $params);
}

function marctv_twitch_menu() {
  add_options_page('Twitch Status', 'Twitch Status', 'manage_options', 'twitch-status-options', marctv_twitch_status_settings);
}

add_action('admin_menu', 'marctv_twitch_menu');



function marctv_twitch_status_settings() {

  load_plugin_textdomain('marctv-twitch-status', false, basename(dirname(__FILE__)) . '/languages');

  if (isset($_POST['formset'])) {
    $formset = $_POST['formset'];
  }
  else {
    $formset = "";
  }

  if ($formset == "1") {  //our form has been submitted let's save the values
    update_option('mtw_channelname', $_POST['mtwchannelname']);
    update_option('mtw_url', $_POST['mtwurl']);
    update_option('mtw_selector', $_POST['mtwselector']);
    ?>
    <div class="updated">
      <p><strong><?php _e('Options saved.', 'mt_trans_domain'); ?></strong></p>
    </div>
    <?php
  }

  if (!get_option('mtw_selector')) {
    update_option('mtw_selector', 'nav:first ul, #primary-navigation ul, .site-navigation ul');
  }

  if (!get_option('mtw_channelname')) {
    update_option('mtw_channelname', 'marctvde');
  }

  if (!get_option('mtw_url')) {
    update_option('mtw_url', 'http://twitch.tv/marctvde');
  }


  $channelname = get_option('mtw_channelname');
  $url = get_option('mtw_url');
  $selector = get_option('mtw_selector');
  ?>

  <div id="wrap">
    <h1><?php _e('Twitch Status Settings', 'marctv-twitch'); ?></h1>
    <div class="twitch-welcome">
      <p><?php _e('Configure Twitch TV Account settings.', 'marctv-twitch'); ?></p>
    </div>

    <form method="post" enctype="multipart/form-data" name="twitchform" id="twitchform">

      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row"><label for="mtwchannelname">Twitch Channelname</label></th>
            <td><input name="mtwchannelname" type="text" id="mtwchannelname" value="<?php echo $channelname; ?>" class="regular-text">
              <p class="description"><?php _e('The Twitch.TV channelname of the navigation menu item.', 'marctv-twitch'); ?></p></td>
          </tr>

          <tr valign="top">
            <th scope="row"><label for="mtw_url">Link URL</label></th>
            <td><input name="mtwurl" type="url" id="mtwurl" value="<?php echo $url; ?>" class="regular-text">
              <p class="description"><?php _e('The URL of the navigation menu item. This is where the users will end up after they clicked on the link.', 'marctv-twitch'); ?></p></td>
          </tr>

          <tr valign="top">
            <th scope="row"><label for="mtw_selector">jQuery selector</label></th>
            <td><input name="mtwselector" type="text" id="mtwselector" value="<?php echo $selector; ?>" class="regular-text">
              <p class="description"><?php _e('The jQuery selector of the primary menu. Leave blank for default settings.', 'marctv-twitch'); ?></p></td>
          </tr>

        </tbody></table>
      <input type="hidden" id="formset" name="formset" value="1"/>
      <input type="submit" name="submit" value="<?php _e('Save Settings', 'marctv-twitch'); ?>" class="button button-primary">

    </form>
  </div>
<?php }
?>
