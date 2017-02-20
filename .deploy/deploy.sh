#!/bin/env bash

composer update --no-dev
rsync -azvh --update --delete-after --quiet --exclude-from $TRAVIS_BUILD_DIR/.deploy/ignore $TRAVIS_BUILD_DIR/ $1@$2:$3
