#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

# Keep Docker service DNS names in sync with Compose environment
if [ -n "${DB_HOST:-}" ]; then
    sed -i "s/^DB_HOST=.*/DB_HOST=${DB_HOST}/" .env
fi
if [ -n "${DB_DATABASE:-}" ]; then
    sed -i "s/^DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" .env
fi
if [ -n "${DB_USERNAME:-}" ]; then
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" .env
fi
if [ -n "${DB_PASSWORD:-}" ]; then
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" .env
fi
if [ -n "${APP_URL:-}" ]; then
    sed -i "s|^APP_URL=.*|APP_URL=${APP_URL}|" .env
fi

if [ ! -d vendor ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if ! grep -qE '^APP_KEY=base64:.+' .env; then
    php artisan key:generate --force --ansi
fi

echo "Waiting for MySQL..."
until php -r "new PDO(
    'mysql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT') ?: '3306') . ';dbname=' . getenv('DB_DATABASE'),
    getenv('DB_USERNAME'),
    getenv('DB_PASSWORD')
);" >/dev/null 2>&1; do
    sleep 2
done
echo "MySQL is ready."

php artisan migrate --force
php artisan db:seed --force

if [ ! -L public/storage ]; then
    php artisan storage:link || true
fi

chown -R www-data:www-data storage bootstrap/cache || true
chmod -R ug+rwx storage bootstrap/cache || true

exec "$@"
