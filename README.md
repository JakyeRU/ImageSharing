<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# About ImageSharing
<strong>ImageSharing</strong> is a demo project I made in my free time which is used for image hosting. Images can be public (between verified users) or private.

This project was created using [Laravel](https://laravel.com) and [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze).

# Installation
## Step 1 - Clone the repository
```batch
git clone https://github.com/JakyeRU/ImageSharing.git

cd ImageSharing
```

## Step 2 - Setup .env
```batch
copy .\.env.example .\.env
```
- Update `.env` with your database credentials.
- Update `.env` with your mailserver credentials.

## Step 3 - Install the required dependencies:
```batch
composer install
```

## Step 4 - Generate a new key for your application:
```batch
php artisan key:generate
```

## Step 5 - Run migrations:
*Make sure to update `.env` with your database credentials before running the migrations.*
```batch
php artisan migrate
```

## Step 6 - Start the server and go to your application:
```batch
php artisan serve
```

---