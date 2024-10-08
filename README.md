# Laravel 10 + PHP 8.2

### Introduction
![PHP](https://camo.githubusercontent.com/533802c4efc60b28f0ba8348f1ff5ed189e9d0ccda54e5630cf675c65b707aee/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f5048502d3737374242343f7374796c653d666c61742d737175617265266c6f676f3d706870266c6f676f436f6c6f723d7768697465)

Laravel has a set of requirements in order to ron smoothly in specific environment. Please see [requirements](https://laravel.com/docs/10.x) section in Laravel documentation.

So ensure You have [Composer](https://getcomposer.org/) and [Node](https://nodejs.org/) installed on Your machine.

Assuming your machine meets all requirements - let's process to installation.

### Installation
1. Open in cmd or terminal app and navigate to this folder
2. Run following commands

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
npm install
```

```bash
npm run dev
```

```bash
php artisan migrate
```

```bash
php artisan db:seed --class=UserSeeder
```

```bash
php artisan serve
```

And navigate to generated server link (http://127.0.0.1:8000)

### Pages:

* Home page: http://127.0.0.1:8000/
* Login: http://127.0.0.1:8000/login
  `User: admin@gmail.com`
  `Pass: password'
