<?php

namespace Claytongf\WorldSeed\Commands;

use Claytongf\WorldSeed\Traits\HasCountries;
use Claytongf\WorldSeed\Traits\SetupSeed;
use Illuminate\Console\Command;

class WorldAddCountryCommand extends Command
{
    use SetupSeed;
    use HasCountries;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'world:add-country {codes?* : ISO2 or ISO3 codes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add specific countries to the database';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setBasePath();
        $this->setNumberOfFiles(fileName: 'cities', fileType: 'json');
        parent::__construct();
    }

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
            $this->setTotalCountries($codes);
            $this->startingTime = microtime(true);
            if (config('world.show_progress_bar')) {
                $progress = $this->output->createProgressBar($this->totalCountries);
                $progress->start();
            }
            for ($i = 1; $i <= $this->numberOfFiles; $i++) {
                foreach ($this->getCountries($i) as $country) {
                    if (empty($codes) ||
                    in_array($country['iso2'], $codes) ||
                    in_array($country['iso3'], $codes)
                    ) {
                        if (config('world.show_seeding_progress')) {
                            $this->newLine();
                            $this->info("Seeding country: {$country['name']}");
                        }
                        if (!$this->saveCountries($country)) {
                            $this->alert("Country {$country['name']} already exists.");
                        }

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
