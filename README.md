<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Download/Install Project


Follow the steps below to install this project on your local computer

1.First clone with the command :    

    git clone https://github.com/Melez2190/Invoice.git  
   
or simply download the zipped file

2.In mysql create a database "database_name"

3.Then in the .env file in DB_DATABASE change the database name to your "database_name"

4.The next step is to install the tailwind via the composer:    

    1.composer require laravel-frontend-presets/tailwindcss --dev 

    2.php artisan ui tailwindcss --auth
     
    3.npm install && npm run dev
     


5.php artisan serve 

6.php artisan migrate

7.php artisan db:seed


## Download invoice in pdf

For the option to download the invoice in pdf format, install via composer
barryvdh / laravel-dompdf :     

composer require barryvdh/laravel-dompdf     


For more information, see [Barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
