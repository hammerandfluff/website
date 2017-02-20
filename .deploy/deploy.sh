#!/bin/env bash

rsync -azvh --update --delete --exclude-from .deploy/ignore ./ $1@$2:$3
