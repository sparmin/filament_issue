#!/bin/bash
set -e

# Set variables
ROOT_DIR=$1
REPO_DIR=$ROOT_DIR/repo

# Execute build script inside REPO_DIR
cd $REPO_DIR

if [ -d "$ROOT_DIR"/src ]; then
    echo "src directory exists..."

    if [ -f "$ROOT_DIR"/src/.env ]; then
        echo "src/.env file exists..."
        echo "Copy src files to repo..."
        rsync -arz "$ROOT_DIR/src/storage" "$ROOT_DIR/src/.env" "$REPO_DIR"

        echo "Execute build script..."
        chmod +x ./scripts/build.sh
        ./scripts/build.sh
    else
        echo "src/.env file does not exist..."
    fi
else
    echo "src directory does not exist..."
    echo "Create src directory..."
    mkdir -p $ROOT_DIR/src
fi

# Move ROOT_DIR files to src_new directory
mkdir -p $ROOT_DIR/src_new/
rsync -az $REPO_DIR/ $ROOT_DIR/src_new
