<?php
$metadata = json_encode(array(
    'PLUGIN_ENV' => getenv('PLUGIN_ENV'),
    'PLUGIN_TIMESTAMP' => intval(getenv('PLUGIN_TIMESTAMP')),
    'PLUGIN_VERSION' => '1.0.0',
    'PLUGIN_NAME' => 'plugin-name',
    'PLUGIN_DESCRIPTION' => 'Plugin description'
));

$targetFile = dirname(__DIR__) . '/metadata.json';

file_put_contents($targetFile, $metadata);
