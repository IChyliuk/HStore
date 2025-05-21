if [ ! -f .env ]; then
  composer install
  cp ../.env ./
  php artisan key:generate
  chown -R www-data:www-data storage
  chown -R www-data:www-data bootstrap/cache
  chmod -R 775 storage
  chmod -R 755 bootstrap/cache
fi

# Проверим, есть ли миграции
if ! php artisan migrate:status | grep -q 'Yes'; then
  php artisan migrate --seed
fi

php artisan optimize
php-fpm
