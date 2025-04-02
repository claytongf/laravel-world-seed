<?php

namespace Claytongf\WorldSeed\Commands;

use Claytongf\WorldSeed\Traits\HasCountries;
use Claytongf\WorldSeed\Traits\SetupSeed;
use Claytongf\WorldSeed\Models\Airport;
use Illuminate\Console\Command;

class WorldRemoveAirportCommand extends Command
{
    use SetupSeed;
    use HasCountries;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'world:remove-airport {codes* : IATA or ICAO codes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove specific airports to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $codes = $this->argument('codes');
            $this->startingTime = microtime(true);
            if (config('world.show_progress_bar')) {
                $progress = $this->output->createProgressBar(count($codes));
                $progress->start();
            }

            foreach ($codes as $code) {
                if (config('world.show_seeding_progress')) {
                    $this->newLine();
                    $this->info("Removing airport: {$code}");
                }
                Airport::where('iata', $code)->orWhere('icao', $code)->delete();

                if (isset($progress) && config('world.show_progress_bar')) {
                    $progress->advance();
                }
                $this->newLine();
            }
            $progress->finish();

            $this->finishedTime = microtime(true);
            $time = number_format(($this->finishedTime - $this->startingTime), 2);

            $this->info("Airport removal completed successfully! Command took $time seconds.");
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
