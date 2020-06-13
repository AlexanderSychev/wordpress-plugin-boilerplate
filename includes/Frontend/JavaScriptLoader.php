<?php
namespace PluginName\Frontend;

/** Common JavaScript files loader for plugin */
class JavaScriptLoader extends \PluginName\Loader {
    /** Name of script for WordPress */
    private string $scriptName;

    /** Path to script file */
    private string $scriptPath;

    /** Version of script */
    private string $scriptVersion;

    /** Is script should be loaded on WordPress Dashboard (admin part) */
    private bool $isAdmin;

    public function __construct(
        string $scriptName,
        string $scriptVersion = null,
        string $scriptPath = null,
        bool $isAdmin = false,
        array $dependencies = array()
    ) {
        parent::__construct($dependencies);
        $topUrl = plugin_dir_url(dirname(dirname(__FILE__)));

        $this->isAdmin = $isAdmin;
        $this->scriptName = $scriptName;
        $this->scriptVersion =
            is_null($scriptVersion)
            ? \PluginName\Metadata::getInstance()->timestamp
            : $scriptVersion;

        $this->scriptPath = is_null($scriptPath) ? $topUrl . 'assets/js/' . $this->scriptName . '.js' : $scriptPath;
    }

    public function enqueue(): void {
        wp_enqueue_script(
            $this->scriptName,
            $this->scriptPath,
            $this->getDependentJavaScriptNames(),
            $this->scriptVersion,
            true
        );
    }

    protected function onInstallInternal(): void {
        $action = $this->isAdmin ? 'admin_enqueue_scripts' : 'wp_enqueue_scripts';
        add_action($action, array(&$this, 'enqueue'));
    }

    private function getDependentJavaScriptNames(): array {
        $result = array();
        foreach($this->dependencies as $dependency) {
            if ($dependency instanceof JavaScriptLoader) {
                $result[] = $dependency->scriptName;
            }
        }
        return $result;
    }
}
