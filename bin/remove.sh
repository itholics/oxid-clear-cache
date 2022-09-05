#!/usr/bin/env bash

cd ../../../../../

vendor/bin/oe-console oe:module:deactivate ith_clear_tmp
vendor/bin/oe-console oe:module:uninstall-configuration source/modules/ith_modules/ith_clear_tmp
COMPOSER_MEMORY_LIMIT=-1 composer remove itholics/oxid-clear-cache -n --no-scripts --update-no-dev