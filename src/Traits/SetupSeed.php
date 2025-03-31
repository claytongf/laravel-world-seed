<?php

namespace Claytongf\WorldSeed\Traits;

trait SetupSeed
{
    /**
     * Command starting time
     *
     * @var float
     */
    private float $startingTime;

    /**
     * Command finished time
     *
     * @var float
     */
    private float $finishedTime;

    /**
     * Number of Files
     *
     * @var int
     */
    private int $numberOfFiles;

    /**
     * Total Countries to Seed
     *
     * @var int
     */
    private int $totalCountries;

    private $basePath;

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

    private function setBasePath(): void
    {
        /* Search for path to ServiceProvider folder */
        $reflector = new \ReflectionClass(\Claytongf\WorldSeed\Providers\WorldSeedServiceProvider::class);
        $providerPath = dirname($reflector->getFileName());
        $this->basePath = dirname($providerPath);
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
        $files = glob("$this->basePath/database/json/cities*.json");
        $this->numberOfFiles = count($files);
    }

    private function getCountries($index): array
    {
        $jsonPath = "{$this->basePath}/database/json/cities{$index}.json";

        if (!file_exists($jsonPath)) {
            // Try fallback path if file not found in base path
            $fallbackPath = database_path("json/cities{$index}.json");

            if (file_exists($fallbackPath)) {
                return json_decode(file_get_contents($fallbackPath), true);
            }

            throw new \Exception("Arquivo cities{$index}.json não encontrado. Caminhos verificados: 
            1. {$jsonPath} 
            2. {$fallbackPath}");
        }

        return json_decode(file_get_contents($jsonPath), true);
    }
}
