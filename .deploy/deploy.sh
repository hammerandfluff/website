#!/bin/env bash

composer install --no-dev --optimize-autoloader
rsync -azvh --update --delete-after --quiet --exclude-from $TRAVIS_BUILD_DIR/.deploy/ignore $TRAVIS_BUILD_DIR/ $1@$2:$3
