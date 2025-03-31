<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Timezone extends Model
{
    protected $fillable = [
        'name',
        'zone_name',
        'abbreviation',
        'tz_name',
    ];

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(
            Country::class,
            config('world.table_names.relationship.countries_timezones'),
            config('world.column_names.relationship.timezone_id'),
            config('world.column_names.relationship.country_id')
        );
    }
}
