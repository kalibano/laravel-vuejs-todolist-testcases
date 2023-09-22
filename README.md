## Installation:
* Clone the repo
* Copy `.env.example` to `.env`
* Configure `.env`
* Make sure `storage/framework/cache`, `storage/framework/sessions`, `storage/framework/views` directories exist. Run `mkdir -p storage/framework/{sessions,views,cache}`
* Run `composer install`
* Run `php artisan key:generate`
* Run `php artisan jwt:secret`
* Run `php artisan migrate`
* Run `php artisan db:seed`
* Run `npm install`
* Run `php artisan serve`

* admin@mail.com
* 12345678

## test:
* Run `php artisan test`
