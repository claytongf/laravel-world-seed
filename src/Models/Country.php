<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'official_name',
        'native_name',
        'phone_code',
        'capital',
        'iso2',
        'iso3',
        'numeric_code',
        'translations',
        'region',
        'subregion',
        'flag_url'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('world.table_names.countries');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(
            Language::class,
            config('world.table_names.relationship.countries_languages'),
            config('world.column_names.relationship.country_id'),
            config('world.column_names.relationship.language_id')
        );
    }

    public function currencies(): BelongsToMany
    {
        return $this->belongsToMany(
            Currency::class,
            config('world.table_names.relationship.countries_currencies'),
            config('world.column_names.relationship.country_id'),
            config('world.column_names.relationship.currency_id')
        );
    }

    public function timezones(): BelongsToMany
    {
        return $this->belongsToMany(
            Timezone::class,
            config('world.table_names.relationship.countries_timezones'),
            config('world.column_names.relationship.country_id'),
            config('world.column_names.relationship.timezone_id')
        );
    }
}
