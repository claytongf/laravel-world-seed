<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $casts = [
        'name' => 'string',
        'official_name' => 'string',
        'native_name' => 'string',
        'phone_code' => 'integer',
        'capital' => 'string',
        'iso2' => 'string',
        'iso3' => 'string',
        'numeric_code' => 'string',
        'region' => 'string',
        'subregion' => 'string',
        'flag_url' => 'string'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('world.table_names.countries');
    }

    /************** RELATIONSHIPS ***************/

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

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class, config('world.column_names.relationship.country_id'));
    }

    /****************** SCOPES *****************/

    public function scopeByIso($query, string $iso2, string|null $iso3 = null): void
    {
        $query->where('iso2', $iso2)->orWhere('iso3', $iso3 ? $iso3 : $iso2);
    }
}
