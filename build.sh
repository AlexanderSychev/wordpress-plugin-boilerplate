PLUGIN_TIMESTAMP=$(date +%s)
PLUGIN_ENV=$PLUGIN_ENV

rm -f ./plugin-name.zip ./metadata.json

PLUGIN_TIMESTAMP=$PLUGIN_TIMESTAMP PLUGIN_ENV=$PLUGIN_ENV php ./build/generate-metadata.php

zip -r ./plugin-name.zip ./* -x ./build/**\* build.sh .editorconfig README.md .gitignore
