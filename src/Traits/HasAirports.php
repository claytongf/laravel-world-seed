<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\WorldSeed\Models\Airport;
use Claytongf\WorldSeed\Models\City;
use Claytongf\WorldSeed\Models\Country;

trait HasAirports
{
    protected function saveAirport(array $airport): Airport
    {
        return Airport::firstOrCreate([
            'name' => $airport['name'],
            'iata' => $airport['iata'],
            'icao' => $airport['icao'],
            'latitude' => $airport['latitude'],
            'longitude' => $airport['longitude'],
            'elevation_ft' => $airport['elevation_ft'],
            'type' => $airport['type'],
        ]);
    }

    protected function attachAirportToCity(Airport $airport, City $city): void
    {
        $airport->cities()->attach($city);
    }

    protected function findAirportByCodes(string|null $iata, string|null $icao): bool
    {
        return Airport::byCode($iata, $icao)->exists();
    }

    protected function findCity($city, string $isoCountry, string $isoRegion): ?City
    {
        $region = explode('-', $isoRegion)[1];
        return City::where('name', $city)
            ->whereHas('country', function ($query) use ($isoCountry) {
                $query->where('iso3', $isoCountry)->orWhere('iso2', $isoCountry);
            })
            ->whereHas('state', function ($query) use ($region) {
                $query->where('state_code', $region);
            })
            ->first();
    }

    protected function findCountry(string $isoCountry): bool
    {
        return Country::byIso($isoCountry)->exists();
    }
}
