<?php

return [
    'models' => [
        'country' => Claytongf\WorldSeed\Country::class,
        'state' => Claytongf\WorldSeed\State::class,
        'city' => Claytongf\WorldSeed\City::class,
        'currency' => Claytongf\WorldSeed\Currency::class,
        'language' => Claytongf\WorldSeed\Language::class,
        'timezone' => Claytongf\WorldSeed\Timezone::class,
        'translation' => Claytongf\WorldSeed\Translation::class
    ],

    /*
    *   Change the table names of the models if needed.
    */

    'table_names' => [
        'countries' => 'countries',
        'states' => 'states',
        'cities' => 'cities',
        'currencies' => 'currencies',
        'languages' => 'languages',
        'timezones' => 'timezones',
        'translations' => 'translations',
        'airports' => 'airports',
        'relationship' => [
            'countries_currencies' => 'countries_currencies',
            'countries_languages' => 'countries_languages',
            'countries_timezones' => 'countries_timezones',
            'airports_cities' => 'airports_cities',
        ]
    ],

    /*
    *   Change the column names of the relationship tables if needed.
    */

    'column_names' => [
        'relationship' => [
            'country_id' => 'country_id',
            'state_id' => 'state_id',
            'city_id' => 'city_id',
            'currency_id' => 'currency_id',
            'language_id' => 'language_id',
            'timezone_id' => 'timezone_id',
            'translation_id' => 'translation_id',
            'airport_id' => 'airport_id',
        ]
    ],

    /*
    *   The list of countries to seed. If empty, all countries will be seeded.
    *   Example: you can seed only the countries you need by passing an array of country codes.
    *   You can use ISO2 codes or ISO3 codes.
    *   Example: ['US', 'CA', 'MX']
    *   Example: ['USA', 'CAN', 'MEX']
    *   You CAN mix both code types.
    */

    'list_countries_to_seed' => [],

    /*
    *   The list of airports to seed. If empty, all airports will be seeded.
    *   Example: you can seed only the airports you need by passing an array of airport codes.
    *   You can use IATA codes or ICAO codes.
    *   Example: ['ORL', 'YYZ', 'CGH'] //IATA
    *   Example: ['KORL', 'CYYZ', 'SBSP'] //ICAO
    *   You CAN mix both code types.
    */

    'list_airports_to_seed' => [],

    /*
    *   Set show_progress_bar to true if you would like to see the progress bar while
    *   running the seeder command.
    */

    'show_progress_bar' => true,

    /*
    *   Set show_seeding_progress to true if you would like to see the progress bar
    *   for each country while running the seeder command.
    */

    'show_seeding_progress' => true,

    /****************** NOT IMPLEMENTED YET *****************/

    /*
    *   Set countries to true if you want to seed them.
    */

    'countries' => true,

    /*
    *   Set states to true if you want to seed them.
    */

    'states' => true,

    /*
    *   Set cities to true if you want to seed them.
    */

    'cities' => true,

    /*
    *   Set currencies, languages and timezones to true if you want to seed them.
    */

    'currencies' => true,

    /*
    *   Set languages and timezones to true if you want to seed them.
    */

    'languages' => true,

    /*
    *   Set timezones to true if you want to seed them.
    */

    'timezones' => true,

    /*
    *   Set translations to true if you want to seed them.
    */

    'translations' => true,
];
