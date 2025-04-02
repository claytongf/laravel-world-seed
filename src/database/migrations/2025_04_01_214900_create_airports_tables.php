<?php

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableNames = config('world.table_names');
        $relationshipColumns = config('world.column_names.relationship');

        if (empty($tableNames) || empty($relationshipColumns)) {
            throw new FileNotFoundException('Error: config/world.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::create($tableNames['airports'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type', 20);
            $table->float('latitude');
            $table->float('longitude');
            $table->string('icao', 4)->nullable();
            $table->string('iata', 4)->nullable();
            $table->smallInteger('elevation_ft');
            $table->unique(['name', 'iata']);
            $table->timestamps();
        });

        Schema::create($tableNames['relationship']['airports_cities'], function (Blueprint $table) use ($relationshipColumns, $tableNames) {
            $table->id();
            $table->foreignId($relationshipColumns['airport_id'])->constrained($tableNames['airports'])->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId($relationshipColumns['city_id'])->constrained($tableNames['cities'])->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('world.table_names');

        if (empty($tableNames)) {
            throw new FileNotFoundException('Error: config/world.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::dropIfExists($tableNames['relationship']['countries_currencies']);
        Schema::dropIfExists($tableNames['relationship']['countries_languages']);
        Schema::dropIfExists($tableNames['relationship']['countries_timezones']);
        Schema::dropIfExists($tableNames['translations']);
        Schema::dropIfExists($tableNames['timezones']);
        Schema::dropIfExists($tableNames['languages']);
        Schema::dropIfExists($tableNames['cities']);
        Schema::dropIfExists($tableNames['states']);
        Schema::dropIfExists($tableNames['currencies']);
        Schema::dropIfExists($tableNames['countries']);
    }
};
