<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\WorldSeed\Models\Country;

trait HasCountries
{
    use HasStates;
    use HasTimezones;
    use HasCurrencies;
    use HasLanguages;
    use HasTranslations;

    /**
     * Save countries to the database
     *
     * @param array<string, mixed> $country
     * @return bool
     */
    private function saveCountries(array $country): bool
    {
        if ($this->findCountryByCodes($country['iso2'], $country['iso3'])) {
            return false;
        }
        /** @var Country */
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
            'flag_url' => $country['flags']['png'],
        ]);
        $this->saveTranslations($country['translations'], $countryCreated->id);
        $currencies = $this->saveCurrencies($country);
        $languages = $this->saveLanguages($country['languages']);
        $timezones = $this->saveTimezones($country['timezones']);
        $countryCreated->languages()->attach($languages);
        $countryCreated->currencies()->attach($currencies);
        $countryCreated->timezones()->attach($timezones);

        $this->saveStates($country['states'], $countryCreated);
        return true;
    }

    private function findCountryByCodes($iso2, $iso3)
    {
        return Country::byIso($iso2, $iso3)->exists();
    }
}
