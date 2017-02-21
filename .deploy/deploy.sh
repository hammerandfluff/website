#!/bin/env bash

rm -rf vendor
composer install --no-dev --no-autoloader --no-suggest
composer dump-autoload -a
rsync -azvh --update --delete-after --exclude-from $TRAVIS_BUILD_DIR/.deploy/ignore $TRAVIS_BUILD_DIR/ $1@$2:$3
