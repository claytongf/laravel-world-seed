<?php

return [
    'models' => [
        'country' => Claytongf\Models\Country::class,
        'state' => Claytongf\Models\State::class,
        'city' => Claytongf\Models\City::class,
        'currency' => Claytongf\Models\Currency::class,
        'language' => Claytongf\Models\Language::class,
        'timezone' => Claytongf\Models\Timezone::class,
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
        'relationship' => [
            'countries_currencies' => 'countries_currencies',
            'countries_languages' => 'countries_languages',
            'countries_timezones' => 'countries_timezones',
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
    *   Set show_progress_bar to true if you would like to see the progress bar while
    *   running the seeder command.
    */

    'show_progress_bar' => true,

    /*
    *   Set show_countries_seeding_progress to true if you would like to see the progress bar
    *   for each country while running the seeder command.
    */

    'show_countries_seeding_progress' => true,

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

];
