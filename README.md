# simple-blog
This is simple MVC based blog application based on Symfony components.


####  1. Clone this repo
```bash
$ git clone git@github.com:RahatHameed/simple-blog.git
```


#### 2. Requirements
PHP 8.0 and mysql is needed to run this project.


#### 3. Import Database
Create a new database at your local msyql server, then Import Database using the provided file at Database/dump.sql


#### 4. Update Database Config at config/config.php
```bash
define("DB_HOST", "db_host");
define("DB_NAME", "database_name");
define("DB_USER", "db_user_name");
define("DB_PWD", "db_password");
```


#### 5. Install composer packages:
```bash
$ composer install 
```


#### 6. Run PHP server:
```bash
$ php -S localhost:9000
```


#### 7. Open project in browser:
Now open the project in the browser and hit below url.<br>
http://localhost:9000<br>
Your can login with below credentials and starting creating new blog posts.<br>
Username: rahat<br>
Password: 123456<br>


#### 8. Further Recommendations
. You can use env variables for database credentials. <br>
. You can use create database migration/seeders using component like Phinx <br>
. You can caching tool Redis or Memcached for cache.<br>
. You can use any code formatting tool like PHP-CS-Fixer or phpstan. <br>
. You can use PHPUnit for test coverage of the code.<br>
. Finally you can also use dockerize this application.<br>


#### 9. Further Reference
Please follow the symfony documentation to enhance this application.
https://symfony.com/doc/current/create_framework/index.html<bt>
Cheers! Happy coding<br>