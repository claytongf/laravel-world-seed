<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\WorldSeed\Models\City;
use Claytongf\WorldSeed\Models\State;

trait HasCities
{
    /**
     * Save cities to the database
     *
     * @param array $cities
     * @param State $state
     * @return void
     */
    private function saveCities(array $cities, State $state): void
    {
        foreach ($cities as $city) {
            City::firstOrCreate([
                'name' => $city['name'],
                'state_id' => $state->id,
                'country_id' => $state->country_id,
                'latitude' => $city['latitude'],
                'longitude' => $city['longitude']
            ]);
        }
    }
}
