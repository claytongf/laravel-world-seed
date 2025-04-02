<?php

namespace Claytongf\WorldSeed\Commands;

use Claytongf\WorldSeed\Traits\HasAirports;
use Claytongf\WorldSeed\Traits\SetupSeed;
use Illuminate\Console\Command;

class WorldAddAirportCommand extends Command
{
    use HasAirports;
    use SetupSeed;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'world:add-airport {codes?* : IATA or ICAO codes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add specific airports to the database by IATA ou ICAO codes';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setBasePath();
        $this->setNumberOfFiles(fileName: 'airports', fileType: 'csv');
        parent::__construct();
    }

    /**
     * Return an array of airport codes to seed.
     *
     * If the user hasn't passed any codes, it will return the list of airports
     * set in the config file.
     *
     * @return array
     */
    public function getCodes(): array
    {
        if (empty($this->argument('codes'))) {
            return config('world.list_airports_to_seed');
        }
        return array_map('strtoupper', $this->argument('codes'));
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $codes = $this->getCodes();
            $existingAirports = 0;
            $airportsSeeded = 0;
            $this->totalAirports = count($codes) > 0 ? count($codes) : 8665;
            $this->startingTime = microtime(true);
            for ($i = 1; $i <= $this->numberOfFiles; $i++) {
                foreach ($this->getAirports($i) as $airport) {
                    if (empty($codes) ||
                    in_array($airport['iata'], $codes) ||
                    in_array($airport['icao'], $codes)
                    ) {
                        if (!$this->findCountry($airport['iso_country'])) {
                            continue;
                        } elseif ($this->findAirportByCodes($airport['iata'], $airport['icao'])) {
                            $existingAirports++;
                        } else {
                            $city = $this->findCity($airport['city'], $airport['iso_country'], $airport['iso_region']);
                            if ($city) {
                                $airportCreated = $this->saveAirport($airport);
                                if (config('world.show_seeding_progress')) {
                                    $this->newLine();
                                    $this->info("Seeding airport: {$airport['name']}");
                                }
                                $airportsSeeded++;

                                $this->attachAirportToCity($airportCreated, $city);
                            }
                        }
                    }
                }
            }

            $this->finishedTime = microtime(true);
            $time = number_format(($this->finishedTime - $this->startingTime), 2);
            $this->newLine();
            $alreadySeeded = $existingAirports > 0 ? "$existingAirports already seeded." : '';
            $this->info("Seeded $airportsSeeded airports from $this->totalAirports available. $alreadySeeded");
            $this->newLine();
            $this->info("World seed completed successfully! Command took $time seconds.");
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
