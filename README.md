# My Expenses 💸

Fullstack expenses tracker app

## Tools 🛠

- PHP v8.3.0
- Laravel v11.9
- NodeJS v18.17.0

## How to start (development build using Laravel Sail)

```bash
cp .env.example .env # Creates a new environment variables file
```

```bash
composer install # Installs the dependencies
```

```bash
php artisan key:generate # Generates a new APP_KEY value and stores it in .env
```

```bash
sail up # Creates and starts both laravel and psql containers using Sail
```

```bash
sail artisan migrate:fresh --seed # Executes database migrations and triggers the seeders
```

Released in 2021. This project is under the MIT license.

By [Victor B. Fiamoncini](https://github.com/Victor-Fiamoncini) ☕️
