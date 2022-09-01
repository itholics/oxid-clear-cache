#!/usr/bin/env bash

cd ../../../../../

if [ $1 ]
then
  COMPOSER_MEMORY_LIMIT=-1 composer update ith_modules/clear-template -n --no-scripts --no-dev
fi
vendor/bin/oe-console oe:module:install-configuration source/modules/ith_modules/ith_clear_tmp
vendor/bin/oe-console oe:module:deactivate ith_clear_tmp
vendor/bin/oe-console oe:module:activate ith_clear_tmp