<?php
namespace PluginName;

/** Standard plugin's loader - run's all needed WordPress hooks */
abstract class Loader {
    /** Array of dependencies - instances of loaders, must be used before this loader */
    protected array $dependencies;

    public function __construct(array $dependencies = array()) { // Add all dependent loaders via ancestor constructor
        $this->dependencies = $dependencies;
    }

    /** Loader and it's dependencies installation handler */
    public function onInstall(): void {
        foreach ($this->dependencies as $dependency) {
            $dependency->onInstall();
        }
        $this->onInstallInternal();
    }

    /** Loader and it's dependencies activation handler */
    public function onActivate(): void {
        foreach ($this->dependencies as $dependency) {
            $dependency->onActivate();
        }
        $this->onActivateInternal();
    }

    /** Loader and it's dependencies deactivation handler */
    public function onDeactivate(): void {
        foreach ($this->dependencies as $dependency) {
            $dependency->onDeactivate();
        }
        $this->onDeactivateInternal();
    }

    /** Loader and it's dependencies uninstall handler */
    public function onUninstall(): void {
        foreach ($this->dependencies as $dependency) {
            $dependency->onInstall();
        }
        $this->onUninstallInternal();
    }

    // Implement all needed methods below

    /** Loader's installation handler (not for activation hook) */
    protected function onInstallInternal(): void {}

    /** Loader's activation handler (for activation hook) */
    protected function onActivateInternal(): void {}

    /** Loader's deactivation handler (for deactivation hook) */
    protected function onDeactivateInternal(): void {}

    /** Loader uninstall handler (for "uninstall.php") */
    protected function onUninstallInternal(): void {}
}
