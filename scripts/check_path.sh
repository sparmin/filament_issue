#!/bin/bash
set -e

DIR=$1

echo "Checking path ..."

# check if path is set
if [ -z "$DIR" ]; then
    echo "Error: path is not set. Exiting."
    exit 1
fi

# check if path is safe
if [[ "$DIR" != "$HOME/public_html/"* ]] ||
[[ "$DIR" == "./"* ]] ||
[[ "$DIR" == "../"* ]]; then
    echo "Error: path is set to an unsafe value ($DIR). Exiting."
    exit 1
fi

# check if path is a valid directory
if [ ! -d "$DIR" ]; then
    echo "Error: path is not a valid directory."
    exit 1
fi
