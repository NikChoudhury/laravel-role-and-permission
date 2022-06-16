# Laravel ROLE and PERMISSION

> Create a new Laravel Project

    laravel new role-and-permission

> Configure Database

    create database "laravel_role_and_permission"

> Migrate database

    php artisan migrate

> Install laravel inbuild Package breeze

    composer require laravel/breeze
        php artisan breeze:install
        npm install
        npm run dev

> MaKe model Role with RoleController And Migration table

    php artisan make:model Role -mcr

> Make AdminController In Auth

    php artisan make:controller Auth/Admin Controller

> Make Middleware

    php artisan make:middleware Admin

> Make model Post with PostController And Migration table

    php artisan make:model Post -mcr   

> Migrate Role And Post Table

    php artisan migrate   

> Make Module Model and Migration

    php artisan make:model Module -m

> Make Permission Model and Migration

    php artisan make:model Permission -m

> Make RolePermission Model and Migration

    php artisan make:model RolePermission -m   

> Migrate Module,Permission And RolePermission

    php artisan migrate 

> For Create Permission Seeder

    php artisan make:seeder PermissionSeeder

> Running Permission Seeder

    php artisan db:seed --class=PermissionSeeder

> Create UserController

     php artisan make:controller Admin/UserController -r

> Create UserRole Model And Migration

    php artisan make:model UserRole -m

> Migrate user_roles table

    php artisan migrate

> For Create Users Seeder

    php artisan make:seeder UserSeeder

> Running User Seeder

    php artisan db:seed --class=UserSeeder
