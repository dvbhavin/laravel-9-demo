# laravel-9-demo
In this project composer 2.0 version is required

1. Open terminal and go to project directory
	composer update

2. Run command php artisan key:generate

3. Create database in phpmyadmin database name "laravel-9-demo"

4. Run command php artisan migrate

5. Run commond php artisan passport:install

#Create csv using command

6. Run Command  php artisan csv:generate 25

Generated csc files in public folder of laravel-9-demo

7. Run database seeder in bellow sequence for basic user data

	7.1. php artisan db:seed --class=UserSeeder

6. Open browser and hit this url "http://localhost/laravel-9-demo/"	

default email    : admin@gmail.com
default password : 12345678

7.For Api Run open postman for api run
    7.1 Login Api using Post method
        ---URL: localhost/laravel-9-demo/api/login

    7.2 Store csv data using job queue api using post method
        ---URL: localhost/laravel-9-demo/api/store_student

    7.3 Logout Api using Post method
        ---URL: localhost/laravel-9-demo/api/logout