#!/bin/bash

# Initial set-up
BASE="$(git config --get remote.origin.url) $(git rev-parse HEAD)"
git commit -m "Initial commit from fork of $BASE"

# Use git flow to proper branch + tag
git flow init -d
git config gitflow.prefix.versiontag v-

# Initiate Kirby
mkdir content
touch content/site.txt

mkdir content/home

# Initiate NPM
npm i

# Initiate Gulp
gulp --production