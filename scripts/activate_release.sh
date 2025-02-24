#!/bin/bash
set -e

ROOT_DIR=$1
TIMESTAMP=$2

# Create release directory
mkdir -p $ROOT_DIR/src_bak/$TIMESTAMP

# Backup the current src directory if it exists
if [ -d "$ROOT_DIR/src" ]; then
    echo "Backing up current src directory to src_bak..."
    rsync -az $ROOT_DIR/src/ $ROOT_DIR/src_bak/$TIMESTAMP
fi

# Move src_new to src
if [ -d "$ROOT_DIR/src" -a -d "$ROOT_DIR/src_new" ]; then
    mv $ROOT_DIR/src $ROOT_DIR/src_old
fi
echo "Moving src_new to src..."
mv $ROOT_DIR/src_new $ROOT_DIR/src

if [ -d "$ROOT_DIR/src_old" ]; then
    rm -rf $ROOT_DIR/src_old
fi

cd $ROOT_DIR/src
php artisan config:clear; php artisan cache:clear; php artisan view:clear; php artisan route:clear;

# Cleanup releases
SRC_BAK_DIR="$ROOT_DIR/src_bak/"
# check path first
chmod +x $ROOT_DIR/src/scripts/check_path.sh
$ROOT_DIR/src/scripts/check_path.sh $SRC_BAK_DIR
SRC_BAK_DIRS=$(ls -1t "$SRC_BAK_DIR" | grep -vE '^\.\/$|^\.\.\/$' | tail -n +6)

for d in $SRC_BAK_DIRS; do
    DIR="$ROOT_DIR/src_bak/$d"
    $ROOT_DIR/src/scripts/check_path.sh $DIR
    echo "Deleting release $DIR..."
    rm -rf $DIR
done
