<?php

namespace Claytongf\Traits;

trait SetupSeed
{
    /**
     * Command starting time
     *
     * @var float
     */
    private $startingTime;

    /**
     * Command finished time
     *
     * @var float
     */
    private $finishedTime;

    /**
     * Number of Files
     *
     * @var int
     */
    private $numberOfFiles;

    private int $totalCountries;

    /**
     * Sets the total number of countries to be seeded,
     * get by the list of countries in config/world.php
     * If the list of countries to seed is not empty, the total number of countries
     * in the list will be used. Otherwise, 250 will be used.
     */
    private function setTotalCountries(): void
    {
        $this->totalCountries = count(config('world.list_countries_to_seed')) > 0
            ? count(config('world.list_countries_to_seed')) : 250;
    }

    /**
     * Sets the number of JSON files containing city data.
     *
     * This method counts the number of JSON files in the database/json directory
     * that match the pattern 'cities*.json' and assigns the count to the
     * $numberOfFiles property.
     */
    private function setNumberOfFiles(): void
    {
        $files = glob(database_path('json/cities*.json'));
        $this->numberOfFiles = count($files);
    }

    private function getCountries($index): array
    {
        return json_decode(file_get_contents(database_path("json/cities{$index}.json")), true);
    }
}
