StorAvell - Laravel + Angular Ecommerce Platform
==========

This project aims to create a user and developer friendly ecommerce platform that can provide the neccessary features for a nontehnical user to get a shop up and running but also give the developer all the power and ease of development that come with Laravel and Angular frameworks

Install Guide
---
    1 Install Main Components
        * composer install
        * npm install -g gulp bower
        * npm install
        * bower install
    2 Install Vendor Dependencies
        * php artisan vendor:publish
        * php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\JWTAuthServiceProvider"
        * php artisan jwt:generate
        * php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"
        * php artisan vendor:publish --provider="Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider" --tag=config
        * php artisan clear-compiled
        * php artisan ide-helper:generate
        * php artisan optimize
        * php artisan ide-helper:meta
        * php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
        * php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
        * php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
        * php artisan vendor:publish --tag=datatables
    3 Post Install Run:
        * php artisan view:clear
        * php artisan route:clear
        * php artisan module:dump
        * gulp
        
Database Setup
---
Create a user the assign that user to the admin roles

@TODO -> create a seed for this
 
@TODO -> create automated install task ( maybe with artisan command )