<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Name
 * Plugin URI:        http://example.com/
 * Description:       Plugin description
 * Version:           1.0.0
 * Author:            Author's name
 * Author URI:        http://example.com/
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

require_once plugin_dir_path(__FILE__) . 'bootstrap.php';

/**
 * Currently plugin version.
 */
define(
    'PLUGIN_NAME_VERSION',
    \PluginName\Metadata::getInstance()->version
);

\PluginName\Plugin::getInstance()->onInstall();

/**
 * The code that runs during plugin activation.
 */
function activate_plugin_name() {
    \PluginName\Plugin::getInstance()->onActivate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_plugin_name() {
    \PluginName\Plugin::getInstance()->onDeactivate();
}

register_activation_hook(__FILE__, 'activate_plugin_name');
register_deactivation_hook(__FILE__, 'deactivate_plugin_name');
