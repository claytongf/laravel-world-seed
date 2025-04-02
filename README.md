# World Seed Package for Laravel

This Laravel package provides data about countries, states, cities, currencies, languages, airports, translations, and timezones.

## Installation

### Install Using Composer

```bash
composer require claytongf/laravel-world-seed
```

### Laravel

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Claytongf\\WorldSeed\\Providers\\WorldSeedServiceProvider"
```

### Migrations

After publishing, you can run the migrations and the tables will be created.

```bash
php artisan migrate
```

## Configurations

The config/world.php file (published in the previous step) allows customization of table names, relationship table names, relationship column names, countries to seed, progress bar display, and a list of countries being processed.

> [!NOTE] > _Model selection for seeding is not yet customizable and will be available in future releases. Setting 'countries' or other models to true or false will not affect seeding._

## Available Commands

### World Seed

Seed the entire database.

> [!IMPORTANT]
> Run Migrations first!

```bash
php artisan world:add-country
```

> [!WARNING]
> Seeding the entire dataset can take a while.

> [!TIP]
> For faster seeding, use the command below or specify country codes in the config/world.php file.

### Seed Specific Country

Add specific countries using their ISO2 or ISO3 codes:

```bash
php artisan world:add-country US # or USA
php artisan world:add-country USA MEX CAN # Multiple countries
php artisan world:add-country BR MEX FR ESP # Mixed ISO2 and ISO3 codes

```

Duplicate entries will be ignored.

### Remove Specific Country

Remove countries using their ISO2 or ISO3 codes:

```bash
php artisan world:remove-country CAN # or CA
php artisan world:remove-country CAN BRA MEX # Multiple countries
php artisan world:remove-country CA BR MX # Mixed ISO2 and ISO3 codes
```

Attempts to remove already removed countries will be ignored. For example, if you try to remove MX, CA, and BR, but MX has already been removed, the command will proceed to remove CA and BR.

### Seed Airports

Seed all the airports available.

> [!IMPORTANT]
> Seed countries first, otherwise no airports will be shown.

```bash
php artisan world:add-airport
```

> [!WARNING]
> Seeding all airports can take a while, though less time than seeding countries.

> [!TIP]
> For faster seeding, use the command below or specify airport codes in the config/world.php file.

### Seed Specific Airport

Add specific airports using their IATA or ICAO codes:

```bash
php artisan world:add-airport YYZ # or CYYZ
php artisan world:add-airport YYZ YYN ORL # Multiple airports
php artisan world:add-airport CYYZ ORL CGH # Mixed IATA and ICAO codes
```

Duplicate entries will be ignored.

### Remove Specific Airports

Remove airports using their IATA or ICAO codes:

```bash
php artisan world:remove-airport YYZ # or CYYZ
php artisan world:remove-airport YYZ YYN ORL # Multiple airports
php artisan world:add-airport CYYZ CYYN CGH # Mixed IATA and ICAO codes
```

If an airport is already removed, it will not affect the other airports removal. Per example: if you want to remove the airports with YYZ, YYN and ORL codes, but ORL has already been removed before, the command will ignore the removed airport and continue to remove the other ones.

## Retrieving Data

Data retrieval currently follows standard Laravel conventions. Improved methods will be implemented in future versions.

### Models Available

- Country
- State
- City
- Currency
- Language
- Timezone
- Translation
- Airport

### Relationships

- City
  - BelongsTo State
  - BelongsTo Country
  - BelongsToMany Airport
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
- Airport
  - BelongsToMany City

Suggestions are welcome!

## Package in development

This package is currently in its initial version. All suggestions are welcome.

## Data Integrity

> [!IMPORTANT]
> The dataset may contain inconsistencies, such as airports not linked to any city. Due to the volume of data, addressing all such issues may be time-consuming. Please report any inconsistencies you encounter.

## Future Implementations

- Seeding Countries, States, or Cities individually
- Optional seeding of Languages, Timezones, Currencies, and Translations
- Improved data retrieval methods

## Buy me a Coffee..... or Pizza

[Buy me a Coffee or Pizza](https://www.buymeacoffee.com/botaficha)
