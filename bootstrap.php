<?php
/**
 * Plugin bootstraping - adding class autoloader
 */

function plugin_name_autoload($name) {
    $beginning = 'PluginName\\';

    if (strpos($name, $beginning) === FALSE) {
        return;
    }

    $namespaceRoot = plugin_dir_path(__FILE__) . 'includes/';

    $toInclude = str_replace($beginning, $namespaceRoot, $name);
    $toInclude = str_replace('\\', '/', $toInclude) . '.php';

    if (file_exists($toInclude)) {
        require_once $toInclude;
    }
}

spl_autoload_register('plugin_name_autoload');
