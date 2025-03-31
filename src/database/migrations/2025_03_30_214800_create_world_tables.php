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

        Schema::create($tableNames['countries'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('native_name');
            $table->string('official_name');
            $table->tinyInteger('phone_code');
            $table->string('capital')->nullable();
            $table->string('iso2', 2);
            $table->string('iso3', 3);
            $table->string('numeric_code', 3);
            $table->json('translations');
            $table->string('region');
            $table->string('subregion');
            $table->string('flag_url');
            $table->timestamps();
        });

        Schema::create($tableNames['currencies'], function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('code', 4);
            $table->string('symbol', 2);
            $table->unique(['name', 'code', 'symbol']);
            $table->timestamps();
        });

        Schema::create($tableNames['states'], function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('state_code', 3)->nullable();
            $table->string('type')->nullable();
            $table->foreignId(config('world.column_names.relationship.country_id'))
                ->constrained(config('world.table_names.countries'))->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create($tableNames['cities'], function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->foreignId(config('world.column_names.relationship.state_id'))
                ->constrained(config('world.table_names.states'))->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId(config('world.column_names.relationship.country_id'))
                ->constrained(config('world.table_names.countries'))->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create($tableNames['languages'], function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('code', 3);
            $table->timestamps();
        });

        Schema::create($tableNames['timezones'], function (Blueprint $table) {
            $table->id();
            $table->string('name', 9);
            $table->string('zone_name', 30)->unique();
            $table->string('abbreviation', 3);
            $table->string('tz_name', 60);
            $table->timestamps();
        });

        Schema::create($tableNames['relationship']['countries_languages'], function (Blueprint $table) use ($relationshipColumns, $tableNames) {
            $table->id();
            $table->foreignId($relationshipColumns['country_id'])->constrained($tableNames['countries'])->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId($relationshipColumns['language_id'])->constrained($tableNames['languages'])->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create($tableNames['relationship']['countries_timezones'], function (Blueprint $table) use ($relationshipColumns, $tableNames) {
            $table->id();
            $table->foreignId($relationshipColumns['country_id'])->constrained($tableNames['countries'])->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId($relationshipColumns['timezone_id'])->constrained($tableNames['timezones'])->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create($tableNames['relationship']['countries_currencies'], function (Blueprint $table) use ($relationshipColumns, $tableNames) {
            $table->id();
            $table->foreignId($relationshipColumns['country_id'])->constrained($tableNames['countries'])->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId($relationshipColumns['currency_id'])->constrained($tableNames['currencies'])->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists($tableNames['timezones']);
        Schema::dropIfExists($tableNames['languages']);
        Schema::dropIfExists($tableNames['cities']);
        Schema::dropIfExists($tableNames['states']);
        Schema::dropIfExists($tableNames['currencies']);
        Schema::dropIfExists($tableNames['countries']);
    }
};
