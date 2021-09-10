# WebRisk v0.10.1
Last Updated: 2021-09-07

##INSTALLATION

----
Required:
 - PHP 8.0
 - Composer 2

Installation steps
 - Run the dependency installation: ```composer install```
 - Copy `.env.example` to `.env`
 - Generate app key: `php artisan key:generate`
 - Start docker: ```vendor/bin/sail up -d```
 - Initiate DB: ```vendor/bin/sail artisan migrate```

Register your admin account:
 - navigate to http://localhost
 - Click on "Register"
 - Fill out form
 - Update `player` record in DB to have `is_admin=1`
 - Add your admin username to the `.env` file as `ROOT_ADMIN`
 
##Laravel Sail

---
I decided to use [Laravel Sail](https://laravel.com/docs/8.x/sail) since it works well with Laravel and is easy to setup.

If you run multiple docker boxes, you may want to change the ports available to you for the docker boxes. You can update these in the `.env` file. For example: if you wanted to run the web app on port 8001 (http://localhost:8001) and the DB on port 3307, you would configure the `.env` like this:

```env
# For Sail
APP_PORT=8001
FORWARD_DB_PORT=3307
```

After updating this file, simply restart the docker group
 - `sail down`
 - `sail up -d`


##Converting to Laravel

-----
The original WebRisk is not built into any specific framework. I am attempting to rebuild this into my favorite framework: Laravel.

I am following this post on Tighten's website for converting this code into Laravel:
 - https://tighten.co/blog/converting-a-legacy-app-to-laravel/

If you would like to contribute to this conversion, please follow the steps on this post. 

