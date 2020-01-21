
## About Posts API

Posts is backend service developed using laravel framework. Currently, it is being used in starwars-fe for user authentication using Passport. https://laravel.com/docs/5.7/passport 
In future, it will be use to authenticate user using tokens. 




Installation
------------

- git clone https://github.com/mohsininayatkhan/post.git 
- cd posts
- cp .env.example .env
- composer install 

Configuration
-------------
Create a database in MySQL and confiure it in .env file

```php
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=posts
DB_USERNAME=root
DB_PASSWORD=
```
Execute the follwing command to run database migration, while will create required tables in database.

```php
php artisan migrate
```


**NOTE**: App key can be generated by clicking 'Generate App Key' button, if you are seeing it on browser OR by running following commands from CLI from project directory. Running commands from CLI is preferred. 

```php
php artisan key:generate
php artisan config:cache
```



Routes
-------------
- [POST] api/login
- [POST] api/register