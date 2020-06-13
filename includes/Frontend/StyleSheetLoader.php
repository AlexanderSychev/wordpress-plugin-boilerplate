<?php
namespace PluginName\Frontend;

class StyleSheetLoader extends \PluginName\Loader {
    /** Name of CSS for WordPress */
    private string $stylesheetName;

    /** Path to CSS file */
    private string $stylesheetPath;

    /** Version of CSS */
    private string $stylesheetVersion;

    /** Is CSS should be loaded on WordPress Dashboard (admin part) */
    private bool $isAdmin;

    public function __construct(
        string $stylesheetName,
        string $stylesheetVersion = null,
        string $stylesheetPath = null,
        bool $isAdmin = false,
        array $dependencies = array()
    ) {
        parent::__construct($dependencies);
        $topUrl = plugin_dir_url(dirname(dirname(__FILE__)));

        $this->isAdmin = $isAdmin;
        $this->stylesheetName = $stylesheetName;
        $this->stylesheetVersion =
            is_null($stylesheetVersion)
            ? \PluginName\Metadata::getInstance()->timestamp
            : $stylesheetVersion;

        $this->stylesheetPath =
            is_null($stylesheetPath)
            ? $topUrl . 'assets/css/' . $this->stylesheetName . '.css'
            : $stylesheetPath;
    }

    public function enqueue(): void {
        wp_enqueue_style(
            $this->stylesheetName,
            $this->stylesheetPath,
            $this->getDependentStyleSheetNames(),
            $this->stylesheetVersion
        );
    }

    protected function onInstallInternal(): void {
        $action = $this->isAdmin ? 'admin_enqueue_scripts' : 'wp_enqueue_scripts';
        add_action($action, array(&$this, 'enqueue'));
    }

    private function getDependentStyleSheetNames(): array {
        $result = array();
        foreach($this->dependencies as $dependency) {
            if ($dependency instanceof StyleSheetLoader) {
                $result[] = $dependency->stylesheetName;
            }
        }
        return $result;
    }
}
