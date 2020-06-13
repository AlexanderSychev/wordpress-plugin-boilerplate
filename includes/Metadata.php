<?php
namespace PluginName;

class Metadata {
    private static $instance = null;

    /** Plugin's version (for WordPress) */
    public string $version;

    /** Plugin's machine name (can be used as prefix for plugin's entities, e.g. settings) */
    public string $name;

    /** Plugin's description */
    public string $description;

    /** Plugin's environment */
    public string $env;

    /** Plugin timestamp (for .js and .css assets) */
    public int $timestamp;

    private function __construct() {
        // Plugin's metadata should stored at "metadata.json" file at plugin's root directory
        // This file should be autogenerated
        $metadataFilePath = dirname(dirname(__FILE__)) . '/metadata.json';
        $metadata = json_decode(file_get_contents($metadataFilePath), true);

        $this->version = $metadata['PLUGIN_VERSION'];
        $this->name = $metadata['PLUGIN_NAME'];
        $this->description = $metadata['PLUGIN_DESCRIPTION'];
        $this->env = $metadata['PLUGIN_ENV'];
        $this->timestamp = $metadata['PLUGIN_TIMESTAMP'];
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}