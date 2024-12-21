# My Expenses 💸

Fullstack expenses tracker app

## Tools 🛠

- PHP v8.3.0
- Laravel v11.9
- NodeJS v18.17.0

## How to start (development build using Laravel Sail)

```bash
cp .env.example .env # Creates a new environment variables file

composer install # Installs the dependencies

php artisan key:generate # Generates a new APP_KEY value and stores it in .env

sail up # Creates and starts both laravel and psql containers using Sail

sail artisan migrate:fresh --seed # Executes database migrations and triggers the seeders
```

## VSCode Config

```json
{
    "blade.format.enable": true,
    "bladeFormatter.format.enabled": true,
    "bladeFormatter.format.indentSize": 4,
    "bladeFormatter.format.wrapAttributes": "force-expand-multiline",
    "bladeFormatter.format.wrapLineLength": 120,
    "bladeFormatter.format.wrapAttributesMinAttrs": 2,
    "bladeFormatter.format.indentInnerHtml": true,
    "bladeFormatter.format.useTabs": false,
    "bladeFormatter.format.sortTailwindcssClasses": true,
    "bladeFormatter.format.sortHtmlAttributes": "none",
    "bladeFormatter.format.noMultipleEmptyLines": false,
    "bladeFormatter.format.noPhpSyntaxCheck": false,
    "bladeFormatter.format.noSingleQuote": true,
    "[php]": {
        "editor.defaultFormatter": "open-southeners.laravel-pint"
    },
    "[blade]": {
        "editor.defaultFormatter": "shufo.vscode-blade-formatter"
    }
}
```

Released in 2021. This project is under the MIT license.

By [Victor B. Fiamoncini](https://github.com/Victor-Fiamoncini) ☕️
