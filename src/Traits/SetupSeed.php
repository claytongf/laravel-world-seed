<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\WorldSeed\Exceptions\FileNotFoundException;

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

    /**
     * Total Airports to Seed
     *
     * @var integer
     */
    private int $totalAirports;

    private $basePath;

    /**
     * Sets the total number of countries to be seeded,
     * get by the list of countries in config/world.php
     * If the list of countries to seed is not empty, the total number of countries
     * in the list will be used. Otherwise, 250 will be used.
     */
    private function setTotalCountries(array|null $countries = null): void
    {
        if ($countries) {
            $this->totalCountries = count($countries);
        } elseif (count(config('world.list_countries_to_seed')) > 0) {
            $this->totalCountries = count(config('world.list_countries_to_seed'));
        } else {
            $this->totalCountries = 250;
        }
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
    private function setNumberOfFiles(string $fileName, string $fileType): void
    {
        $files = glob("$this->basePath/database/$fileType/$fileName*.$fileType");
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

            throw new FileNotFoundException("Arquivo cities{$index}.json não encontrado. Caminhos verificados:
            1. {$jsonPath}
            2. {$fallbackPath}");
        }

        return json_decode(file_get_contents($jsonPath), true);
    }

    private function getAirports($index): array
    {
        $file = "{$this->basePath}/database/csv/airports{$index}.csv";

        if (!file_exists($file)) {
            throw new FileNotFoundException("File airports{$index}.csv does not exist. Paths checked:
            {$file}");
        }

        $csv = fopen($file, 'r');
        fgetcsv($csv);
        $airports = [];
        while ($row = fgetcsv($csv)) {
            $airports[] = $this->transformData($row);
        }
        fclose($csv);

        return $airports;
    }

    protected function transformData(array $data): array
    {
        return [
            'ident' => $this->cleanString($data[0]),
            'type' => $this->cleanString($data[1]),
            'name' => $this->cleanString($data[2]),
            'latitude' => $data[3],
            'longitude' => $data[4],
            'elevation_ft' => $data[5] !== '\\N' ? (int)$data[5] : null,
            'continent' => $this->cleanString($data[6]),
            'iso_country' => $this->cleanString($data[7]),
            'iso_region' => $this->cleanString($data[8]),
            'city' => $this->cleanString($data[9]),
            'icao' => $this->cleanString($data[10]),
            'iata' => $this->cleanString($data[11]),
            'gps_code' => $this->cleanString($data[12]),
            'local_code' => $this->cleanString($data[13]),
        ];
    }

    /**
     * Clean and format string values from CSV
     */
    protected function cleanString(?string $value): ?string
    {
        if ($value === null || $value === '\\N' || $value === '') {
            return null;
        }

        return trim($value, '" ');
    }
}
