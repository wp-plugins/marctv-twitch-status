<?php
/*
  Plugin Name: MarcTV Twitch Status
  Plugin URI: http://www.marctv.de/blog/marctv-wordpress-plugins/
  Description: Add your Twitch Status to your navigation menu.
  Version: 1.5.2
  Author: MarcDK
  Author URI: http://www.marctv.de
  License: GPL2
 */


class MarcTVTwitch
{

    private $version = '1.5';
    private $pluginPrefix = 'marctv-twitch';
    private $channelname = 'marctvde';
    private $channelurl = 'http://twitch.tv/marctvde';
    private $menuselector = 'nav:first ul:first, #primary-navigation ul:first, .site-navigation ul:first';

    public function __construct()
    {
        load_plugin_textdomain('marctv-twitch-status', false, dirname(plugin_basename(__FILE__)) . '/language/');

        if (is_admin()) {
            $this->backendInit();
        }

        $this->frontendInit();
    }

    /**
     * Actions for backend.
     */
    public function backendInit()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueScripts'));
        add_action('admin_menu', array($this, 'registerSettingsPage'));
        add_action('admin_init', array($this, 'registerSettings'));
    }

    public function frontendInit()
    {
        add_action('wp_print_styles', array($this, 'enqueScripts'));

    }

    /**
     * Registers settings for plugin.
     */
    public function registerSettings()
    {
        register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-channelname');
        register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-channelurl');
        register_setting($this->pluginPrefix . '-settings-group', $this->pluginPrefix . '-menuselector');

    }

    /**
     * Add a menu item to the admin bar.
     */
    public function registerSettingsPage()
    {
        add_options_page('Twitch Status', 'Twitch Status', 'manage_options', $this->pluginPrefix, array($this, 'showSettingsPage'));
    }

    /**
     * Includes the settings page.
     */
    public function showSettingsPage()
    {
        include('pages/settings.php');
    }


    public function enqueScripts() {

        wp_enqueue_style(
            $this->pluginPrefix . '-styles', WP_PLUGIN_URL . "/marctv-twitch-status/jquery.marctv-twitch-status.css", false, $this->version);

        wp_enqueue_script(
            $this->pluginPrefix, WP_PLUGIN_URL . "/marctv-twitch-status/jquery.marctv-twitch-status.js", array("jquery"), $this->version, 0);

        /* populate option fields with defaults and open them for jQuery to read. */

        $params = array(
            'channelname' => get_option($this->pluginPrefix . '-channelname', $this->channelname),
            'channelurl' => get_option($this->pluginPrefix . '-channelurl', $this->channelurl),
            'menuselector' => get_option($this->pluginPrefix . '-menuselector',$this->menuselector)
        );

        if (is_admin()) {
            $params['menuselector'] = '#mtvchannelstatus';
        }

        wp_localize_script($this->pluginPrefix, 'marctvtwitchsettings', $params);

    }
};

new MarcTVTwitch;


?>
