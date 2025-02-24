#!/bin/bash
set -e

echo "Build started ..."
# Enter maintenance mode or return true
# if already is in maintenance mode
#(php artisan down) || true

echo "Composer install ..."
# Install composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "Clear cache ..."
# Clear the old cache
php artisan clear-compiled

echo "Recreate cache ..."
# Recreate cache
php artisan optimize

echo "Install npm dependencies ..."
# Install npm dependencies
npm install

echo "Compile npm assets ..."
# Compile npm assets
npm run build

echo "Run database migrations ..."
# Run database migrations
php artisan migrate --force

# Exit maintenance mode
#php artisan up

echo "Link storage ..."
# Link storage
php artisan storage:link

echo "Build finished!"

echo "Generate application key ..."
# Generate application key
php artisan key:generate
php artisan config:cache
