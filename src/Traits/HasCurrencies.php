<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\WorldSeed\Models\Currency;

trait HasCurrencies
{
    /**
     * Save currencies to the database.
     *
     * This function iterates through the given currencies and saves them
     * to the database using the Currency model. If a currency already
     * exists, it will not be duplicated.
     *
     * @param array $currencies An array of currencies to be saved, where each currency
     *                          is an associative array containing 'name', 'code', and 'symbol'.
     * @return array An array of saved Currency model instances.
     */
    private function saveCurrencies($country): Currency
    {
        return Currency::firstOrCreate([
            'name' => $country['currency_name'],
            'code' => $country['currency'],
            'symbol' => $country['currency_symbol'],
        ]);
    }
}
