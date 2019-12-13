# Laravel_BanHang
 https://www.youtube.com/playlist?list=PLWTu87GngvNxpWN6FVuEcS-YvFNq6RnqG

 Create new Laravel project : 
 composer create-project --prefer-dist laravel/laravel Laravel_BanHang

Clone Laravel Project from Github Clone your project Go to the folder application using cd command on your cmd or terminal Run composer install on your cmd or terminal Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration. By default, the username is root and you can leave the password field empty. (This is for Xampp) By default, the username is root and password is also root. (This is for Lamp) Run php artisan key:generate Run php artisan migrate Run php artisan serve Go to localhost:8000

Generate model from exitind database If you are using MySQL and Laravel 5.1 or above you can use php artisan code:models from this package: reliese/laravel. All you need to do is:

composer require reliese/laravel

Add the service provider to your config/app.php file Reliese\Coders\CodersServiceProvider::class

Publish the config file with php artisan vendor:publish --tag=reliese-models

Make sure your database is correctly configured in config/database.php and .env files.

And finally issue the command: php artisan code:models.

If you get this error "mkdir(): Invalid path" -> try php artisan config:clear -> do step 4 This package will scan your database and create all models for you. If you need something more specific, you can customize its config file.

This project using Redis for cache

https://stackoverflow.com/questions/51908004/install-phpredis-mac-osx

Install Redis :
brew install redis

Start Redis server : 
redis-server /usr/local/etc/redis.conf