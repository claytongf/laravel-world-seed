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
    protected $signature = 'world:add-country {codes* : ISO2 or ISO3 codes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate specific countries to the database';

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
        $codes = $this->argument('codes');
        dd($codes);
    }

    protected function promptForMissingArgumentsUsing()
    {
        return [
            'codes*' => 'Please enter the ISO2 or ISO3 codes of the countries you want to migrate',
        ];
    }
}
