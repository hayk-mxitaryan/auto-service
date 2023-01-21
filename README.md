## Auto Service Package

## Installation:

> composer require hayk-mxitaryan/auto-service

## How to use package:

### If you want to create service class and base controller with controller just add --s to your command

> php artisan make:controller ExampleController --s 

#### And package will create service class in App\Services folder and Base Controller in your controller folder 

### You can also create them separately using built in commands

#### Creating service class

> php artisan make:service-class Directory\ExampleService

#### Creating base controller

##### !! Base Controller Command need only directory where you want create base controller !!

> php artisan make:base-controller Directory

#### You can automatically connect all the services you want using the command

##### You have to put at the end --s= service dir and service name   

> php artisan make:base-controller dir --s=ExampleDir\ExampleService

#### You can specify multiple services by separating them with - sybmol

> php artisan make:base-controller dir --s=ExampleDir\ExampleService-ExampleDir2\ExampleService2

#### If your service is in the main folder App\Services you can just specify the name of the service

>php artisan make:base-controller dir --s=ExampleService

## Thank you for your attention. Use the package to make your work with laravel easier 
