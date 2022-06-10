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
