composer install
exit
composer install
php artisan key:generate
php artisan migrate
php artisan make:migration create_users_table --create=users
php artisan migrate
php artisan migrate:fresh
php artisan make:migration create_users_table --create=users
php artisan migrate:fresh
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
exit
sudo systemctl restart php8.2-fpm
exit
php artisan migrate
php artisan migrate:status
docker exec -it mysql_fletmax mysql -u root -p
exit
php artisan migrate
php artisan migrate:fresh
exit
php artisan session:table
php artisan migrate
exit
