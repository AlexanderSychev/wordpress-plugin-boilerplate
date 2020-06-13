<?php
namespace PluginName;

class Plugin {
    private static $instance = null;

    /** All loaders list. All elements should be instances of "Loader" class ancestors */
    private array $loaders;

    private function __construct() {
        $this->loaders = array(
            new Frontend\Loader()
        );
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function onInstall(): void {
        foreach ($this->loaders as $loader) {
            $loader->onInstall();
        }
    }

    public function onActivate(): void {
        foreach ($this->loaders as $loader) {
            $loader->onInstall();
        }
    }

    public function onDeactivate(): void {
        foreach ($this->loaders as $loader) {
            $loader->onInstall();
        }
    }

    public function onUninstall(): void {
        foreach ($this->loaders as $loader) {
            $loader->onInstall();
        }
    }
}
