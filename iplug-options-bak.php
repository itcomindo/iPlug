<?php
defined('ABSPATH') || exit;


// Add the plugin options page
add_action('admin_menu', 'iplug_options');
function iplug_options()
{
    add_options_page('Iplug Options', 'Iplug', 'manage_options', 'iplug', 'iplug_options_html');
}

// Register the plugin settings
add_action('admin_init', 'iplug_register_settings');
function iplug_register_settings()
{
    register_setting('iplug-settings', 'iplug_checkbox');
    register_setting('iplug-settings', 'iplug_radio');
    register_setting('iplug-settings', 'iplug_select');
    register_setting('iplug-settings', 'iplug_text');
    register_setting('iplug-settings', 'iplug_textarea');
}

// Create the plugin options page HTML
function iplug_options_html()
{
?>
    <div class="wrap">
        <h1>Iplug Plugins Options</h1>
        <form method="post" action="options.php">
            <?php settings_fields('iplug-settings'); ?>
            <?php do_settings_sections('iplug-settings'); ?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">Checkbox Option</th>
                        <td><input type="checkbox" name="iplug_checkbox" value="1" <?php checked(get_option('iplug_checkbox'), 1); ?> /></td>
                    </tr>
                    <tr>
                        <th scope="row">Radio Option</th>
                        <td>
                            <label><input type="radio" name="iplug_radio" value="option1" <?php checked(get_option('iplug_radio'), 'option1'); ?> /> Option 1</label><br />
                            <label><input type="radio" name="iplug_radio" value="option2" <?php checked(get_option('iplug_radio'), 'option2'); ?> /> Option 2</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Select Option</th>
                        <td>
                            <select name="iplug_select">
                                <option value="option1" <?php selected(get_option('iplug_select'), 'option1'); ?>>Option 1</option>
                                <option value="option2" <?php selected(get_option('iplug_select'), 'option2'); ?>>Option 2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Text Option</th>
                        <td><input type="text" name="iplug_text" value="<?php echo esc_attr(get_option('iplug_text')); ?>" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Textarea Option</th>
                        <td><textarea name="iplug_textarea"><?php echo esc_textarea(get_option('iplug_textarea')); ?></textarea></td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// Add the plugin options to the database table
add_action('admin_init', 'iplug_add_options_to_db');
function iplug_add_options_to_db()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'masmon';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            option_key varchar(option_key VARCHAR(255) NOT NULL,
option_value longtext NOT NULL,
PRIMARY KEY (id)
);";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    $checkbox_option = get_option('iplug_checkbox');
    if (!empty($checkbox_option)) {
        $wpdb->insert($table_name, array('option_key' => 'iplug_checkbox', 'option_value' => $checkbox_option));
    }

    $radio_option = get_option('iplug_radio');
    if (!empty($radio_option)) {
        $wpdb->insert($table_name, array('option_key' => 'iplug_radio', 'option_value' => $radio_option));
    }

    $select_option = get_option('iplug_select');
    if (!empty($select_option)) {
        $wpdb->insert($table_name, array('option_key' => 'iplug_select', 'option_value' => $select_option));
    }

    $text_option = get_option('iplug_text');
    if (!empty($text_option)) {
        $wpdb->insert($table_name, array('option_key' => 'iplug_text', 'option_value' => $text_option));
    }

    $textarea_option = get_option('iplug_textarea');
    if (!empty($textarea_option)) {
        $wpdb->insert($table_name, array('option_key' => 'iplug_textarea', 'option_value' => $textarea_option));
    }
}



// remove emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
// remove generator meta tag
remove_action('wp_head', 'wp_generator');
// remove wlwmanifest link
remove_action('wp_head', 'wlwmanifest_link');
// remove rsd link
remove_action('wp_head', 'rsd_link');
// remove shortlink
remove_action('wp_head', 'wp_shortlink_wp_head');