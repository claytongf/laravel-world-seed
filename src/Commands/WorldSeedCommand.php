<?php

namespace Claytongf\WorldSeed\Commands;

use Claytongf\WorldSeed\Traits\HasCountries;
use Claytongf\WorldSeed\Traits\SetupSeed;
use Exception;
use Illuminate\Console\Command;

class WorldSeedCommand extends Command
{
    use SetupSeed;
    use HasCountries;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'world:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed world information, with currencies, countries, states, cities, timezones and languages';

    /**
     * Constructor
     *
     * @param int $totalCountries Total number of countries to be seeded. If not provided, the total number of countries
     *                            in the list of countries to seed will be used. If the list is empty, 250 will be used.
     */
    public function __construct()
    {
        $this->setTotalCountries();
        $this->setNumberOfFiles();
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->startingTime = microtime(true);
            if (config('world.show_progress_bar')) {
                $progress = $this->output->createProgressBar($this->totalCountries);
                $progress->start();
            }

            for ($i = 1; $i <= $this->numberOfFiles; $i++) {
                foreach ($this->getCountries($i) as $country) {
                    if (empty(config('world.list_countries_to_seed')) ||
                    in_array($country['iso2'], config('world.list_countries_to_seed')) ||
                    in_array($country['iso3'], config('world.list_countries_to_seed'))
                    ) {
                        if (config('world.show_countries_seeding_progress')) {
                            $this->info("Seeding country: {$country['name']}");
                        }
                        $this->saveCountries($country);

                        if (isset($progress) && config('world.show_progress_bar')) {
                            $progress->advance();
                        }
                        $this->newLine();
                    }
                }
            }
            $progress->finish();

            $this->finishedTime = microtime(true);
            $time = number_format(($this->finishedTime - $this->startingTime), 2);

            $this->info("World seed completed successfully! Command took $time seconds.");
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
