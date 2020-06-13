<?php
namespace PluginName\Frontend;

class Loader extends \PluginName\Loader {
    public function __construct() {
        parent::__construct(array(
            new StyleSheetLoader(\PluginName\Metadata::getInstance()->name),
            new JavaScriptLoader(
                \PluginName\Metadata::getInstance()->name,
                null,
                null,
                false,
                array(
                    new JavaScriptLoader(
                        'axios',
                        '0.19.2',
                        'https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js'
                    )
                )
            )
        ));
    }
}
