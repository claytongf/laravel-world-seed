<?php

namespace Claytongf\Traits;

use Claytongf\Models\Timezone;

trait HasTimezones
{
    /**
     * Saves timezones to the database.
     *
     * This function iterates through the given timezones and saves them
     * to the database using the Timezone model. If a timezone already
     * exists, it will not be duplicated.
     *
     * @param array $timezones An array of timezones to be saved, where each timezone
     *                         is an associative array containing 'gmtOffsetName', 'zoneName',
     *                         'abbreviation', and 'tzName'.
     * @return array An array of saved Timezone model instances.
     */
    private function saveTimezones($timezones): array
    {
        $savedTimezones = [];
        $i = 0;
        foreach ($timezones as $timezone) {
            $savedTimezones[$i++] = Timezone::firstOrCreate([
                'name' => $timezone['gmtOffsetName'],
                'zone_name' => $timezone['zoneName'],
                'abbreviation' => $timezone['abbreviation'],
                'tz_name' => $timezone['tzName'],
            ]);
        }
        return $savedTimezones;
    }
}
