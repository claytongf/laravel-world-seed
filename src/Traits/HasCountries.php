<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\WorldSeed\Models\Country;

trait HasCountries
{
    use HasStates;
    use HasTimezones;
    use HasCurrencies;
    use HasLanguages;

    /**
     * Save countries to the database
     *
     * @param array $country
     * @return void
     */
    private function saveCountries(array $country): void
    {
        $countryCreated = Country::firstOrCreate([
            'name' => $country['name'],
            'native_name' => $country['native'],
            'official_name' => $country['official'],
            'capital' => $country['capital'],
            'phone_code' => $country['phonecode'],
            'iso2' => $country['iso2'],
            'iso3' => $country['iso3'],
            'numeric_code' => $country['numeric_code'],
            'region' => $country['region'],
            'subregion' => $country['subregion'],
            'translations' => json_encode($country['translations']),
            'flag_url' => $country['flags']['png'],
        ]);
        $currencies = $this->saveCurrencies($country);
        $languages = $this->saveLanguages($country['languages']);
        $timezones = $this->saveTimezones($country['timezones']);
        $countryCreated->languages()->attach($languages);
        $countryCreated->currencies()->attach($currencies);
        $countryCreated->timezones()->attach($timezones);

        $this->saveStates($country['states'], $countryCreated);
    }
}
