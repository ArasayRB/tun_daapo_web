<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Tun Daapo

Basado en el framework Laravel, esta aplicación es un CMS que permite a los usuarios acceder a los servicios que pfrese la página, contactar con el grupo vía email o por chat dentro del propio sistema habilitado, así como leer artículos escritos por el equipo.

                      *************************************************************

Based on Laravel framwrok, this application is a CMS provides to user access to services page, contact with the group by mail or chat inside systen, and read articles writed by the team.

## Modo de uso / Use Mode
Debes tener previamente instaladao composer, npm, git

### Clonar proyecto / Clone project
Clona el proyecto desde esta dirección a la carpeta de proyectos LAMPP o al htdocs de Xampp si fuera el caso. Luego posiciónate en la carpeta del proyecto desde la terminal y ejecuta '$composer install', luego '$npm install', esto instalará las dependencias del proyecto.

                      *************************************************************

Clone this project since this address to Lampp projects folder or Xampp htdocs. Then open terminal and go to your project folder and execute '$composer install', next step '$npm install', this going to install all project dependencies.

### Configra archivo env / Configurate env file
En la carpeta principal crea un archivo *.env*, copia y pega lo que hay *.env.example*, cambia las credenciales. Luego ejecuta 'php artisan key:generate' para generar una nueva llave para la aplicación la cual pondrás en el archivo .env en APP_KEY='app_key_generated'

                      *************************************************************

In principal folder create an file *.env*, copy and paste data ubicate in *.env.example*, change credentials. Then, for a new application key, execute 'php artisan key:generate', this key generated you going to put on .env file in APP_KEY='app_key_generated'.

### Esquema de Base de datos /Data Base Schema
Inicia el servidor php de tu preferencia y crea una base de datos que será donde se alojarán los datos del proyectco. Luego ese nombre ponlo en las configuraciones de .env DB_DATABASE=batabase_name.

Ejecuta 'php artisan migrate:install' para que se ejecuten las migraciones en la base de datos, luego 'php artisan db:seed' para que se llene la base de datos con ejemplos de prueba y que usted pueda ver como funciona la aplicación. Para ver usuarios creados por defecto vaya hasta /database/seeders/UserTableSeeder, puede usar cualquiera de las credenciales allí escritas para acceder al sistema. Listo, podrá ver en funcionamiento el proyecto.

                      *************************************************************

Init your prefer php server, create a database for save project data. Then put that data base name on .env configurations where say DB_DATABASE=database_name.

Execute 'php artisan migrate:install' for data base migrations, then 'php artisan db:seed' for cover data base with examples data test, that way you can see how function the app. You can see defaults users created on /database/seeders/UserTableSeeder, you can use any credentials there to access to the system. Well, you can watch how project function.
