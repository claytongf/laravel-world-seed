<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\Models\Country;
use Claytongf\Models\State;

trait HasStates
{
    use HasCities;

    /**
     * Save States to the database
     *
     * @param array $states
     * @param Country $country
     * @return void
     */
    private function saveStates(array $states, Country $country): void
    {
        foreach ($states as $state) {
            $stateCreated = State::firstOrCreate([
                'name' => $state['name'],
                'state_code' => $state['state_code'],
                'type' => $state['type'],
                'country_id' => $country->id
            ]);
            $this->saveCities($state['cities'], $stateCreated);
        }
    }
}
