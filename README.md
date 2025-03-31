# World Seed Package for Laravel

A Laravel package that contains information about countries, states, cities, currencies, languages and timezones

## Installation

### Install Through Composer

```bash
composer require claytongf/laravel-world-seed
```

### Laravel

Copy the package config to your local config with the publish command:

```bash
php artisan vendor:publish --provider="Claytongf\\WorldSeedServiceProvider"
```

### Migrations

After publishing, you may create the migrations

```bash
php artisan migrate
```

## Available Commands

### World Seed

Seed entire database.
!! You need to migrate first!!

```bash
php artisan world:seed
```

### Seed Spacific Country

If you didn´t seed the entire database, you may add countries that still available for seeding.

```bash
php artisan world:add-country US
```

or

```bash
php artisan world:add-country USA
```

- You can use ISO2 and/or ISO3 codes to add a country.
- You also can add more than one country at once

```bash
php artisan world:add-country USA MEX CAN
```

If a country that you wanted to seed is already in the database, it will not duplicate.

## Package in development

This package is in its first version. Any suggestions will be very welcome.

## Future Implementations

- Seed Countries, States or Cities only
- Languages would be not required
- Timezones would be not required
- Currencies would be not required

## Buy me a Coffee..... or Pizza

[Buy me a Coffee or Pizza](https://www.buymeacoffee.com/botaficha)
