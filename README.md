# World Seed Package for Laravel

A Laravel package that contains information about countries, states, cities, currencies, languages, countries translations and timezones

## Installation

### Install Through Composer

```bash
composer require claytongf/laravel-world-seed
```

### Laravel

Copy the package config to your local config with the publish command:

```bash
php artisan vendor:publish --provider="Claytongf\\WorldSeed\\Providers\\WorldSeedServiceProvider"
```

### Migrations

After publishing, you may create the migrations

```bash
php artisan migrate
```

## Configurations

After publishing the provider, you may access the world.php config file.
You can customize the table names, relationship table names, relationship column names, also list countries to seed, show progress bar and see countries that are being processed.

> [!NOTE] > _Currently, you cannot customize which model to seed. It will be done in future releases. So, setting 'countries' or other models to true or false will not affect seeding._

## Available Commands

### World Seed

Seed entire database.

> [!IMPORTANT]
> You need to migrate first!

```bash
php artisan world:seed
```

> [!WARNING]
> If you seed the entire json, keep in mind that it will take a while to seed.

> [!TIP]
> So, for faster seeding, you may execute the command below or add the country codes as you wish in the world.php config file.

### Seed Specific Country

If you didn't seed the entire database, you may add countries that still available for seeding.

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

- You can mix ISO2 and ISO3 codes as well

```bash
php artisan world:add-country BR MEX FR ESP
```

If a country that you wanted to seed is already in the database, it will not duplicate.

### Remove Specific Country

- You can remove any country from the database using ISO2 and/or ISO3 codes.

```bash
php artisan world:remove-country CAN
```

or

```bash
php artisan world:add-country CA
```

- You can also remove more than one country at once.

```bash
php artisan world:remove-country CAN BRA MEX
```

or

```bash
php artisan world:add-country CA BR MX
```

- You can mix ISO2 and ISO3 codes as well

```bash
php artisan world:add-country BR MEX FR ESP
```

If a country is already removed, it will not affect the other countries removal. Per example: if you want to remove the countries with MX, CA and BR codes, but MX has already been removed before, the command will ignore the removed country and continue to remove the other ones.

## Retrieving Data

For now, the data can be fetched according to Laravel's default behavior. New methods will be released in future versions.

### Models Available

- Country
- State
- City
- Currency
- Language
- Timezone
- Translation

### Relationships

- City
  - BelongsTo State
  - BelongsTo Country
- State
  - BelongsTo Country
- Country
  - BelongsToMany Currency
  - BelongsToMany Language
  - BelongsToMany Timezone
  - HasMany Translation
- Currency
  - BelongsToMany Country
- Language
  - BelongsToMany Country
- Timezone
  - BelongsToMany Country
- Translation
  - BelongsTo Country

Any suggestions will be very welcome.

## Package in development

This package is in its first version. Any suggestions will be very welcome.

## Future Implementations

- Seed Countries, States or Cities only
- Languages would not be required
- Timezones would not be required
- Currencies would not be required
- Translations would not be required
- Retrieving data improvements

## Buy me a Coffee..... or Pizza

[Buy me a Coffee or Pizza](https://www.buymeacoffee.com/botaficha)
