<?php
if (!defined('ABSPATH')) {
    die(__('Cheatin&#8217; uh?'));
}

if (get_option($this->pluginPrefix .  '-menuselector') == '') {
    update_option($this->pluginPrefix .  '-menuselector',$this->menuselector);
}

?>

<div id="wrap">
    <h1><?php _e('Twitch Status Settings', 'marctv-twitch-status'); ?></h1>

    <form method="post" action="options.php">

        <?php settings_fields($this->pluginPrefix . '-settings-group'); ?>
        <?php do_settings_sections($this->pluginPrefix . '-settings-group'); ?>


        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label
                        for="<?php echo $this->pluginPrefix; ?>-channelname"><?php _e('Twitch Channel', 'marctv-twitch-status'); ?></label></th>
                <td><input name="<?php echo $this->pluginPrefix; ?>-channelname" type="text" id="<?php echo $this->pluginPrefix; ?>-channelname" value="<?php echo get_option($this->pluginPrefix .  '-channelname',$this->channelname) ?>" class="regular-text">

                    <p class="description"><?php _e('The Twitch.TV channelname of the navigation menu item.', 'marctv-twitch-status'); ?></p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="<?php echo $this->pluginPrefix; ?>-showmeta"><?php echo __('Show meta', 'marctv-twitch-status'); ?></label></th>
                <td>
                    <input
                            id="<?php echo $this->pluginPrefix . '-showmeta'; ?>"
                            name="<?php echo $this->pluginPrefix . '-showmeta'; ?>"
                            type="checkbox" <?php checked(get_option($this->pluginPrefix . '-showmeta'), 'on') ?> />
                        <?php echo __('Show preview image and game title on hover.', 'marctv-twitch-status'); ?>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="mtw_status">Status</label></th>
                <td>
                    <ul id="mtvchannelstatus">
                        <li class="offline"><?php printf(__('Twitch Channel %s is currently offline.','marctv-twitch-status'),
                                '<strong>' . get_option($this->pluginPrefix .  '-channelname') . '</strong>')?>
                        </li>
                    </ul>
                    <p class="description"><?php _e('Here appears the appended menu item if your twitch channel is actively broadcasting.', 'marctv-twitch-status'); ?></p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="<?php echo $this->pluginPrefix; ?>-channelurl">Link URL</label></th>
                <td><input name="<?php echo $this->pluginPrefix; ?>-channelurl" type="url" id="<?php echo $this->pluginPrefix; ?>-channelurl" value="<?php echo get_option($this->pluginPrefix .  '-channelurl', $this->channelurl); ?>" class="regular-text">

                    <p class="description"><?php _e('The URL of the navigation menu item. This is where the users will end up after they clicked on the link.', 'marctv-twitch-status'); ?></p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="<?php echo $this->pluginPrefix; ?>-menuselector">jQuery selector</label></th>
                <td><input name="<?php echo $this->pluginPrefix; ?>-menuselector" type="text" id="<?php echo $this->pluginPrefix; ?>-menuselector" value="<?php echo get_option($this->pluginPrefix .  '-menuselector', $this->menuselector); ?>" class="large-text">

                    <p class="description"><?php _e('The jQuery selector of the primary menu. This should point to the unordered list in the navigation menu. Leave empty for default settings.', 'marctv-twitch-status'); ?> <a target="_blank" href="http://api.jquery.com/category/selectors/"><?php _e('What is this?', 'marctv-twitch-status'); ?></a></p>
                </td>
            </tr>

            </tbody>
        </table>

        <?php submit_button(); ?>

    </form>
</div>