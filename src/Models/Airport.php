<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Airport extends Model
{
    protected $fillable = [
        'name',
        'type',
        'icao',
        'iata',
        'elevation_ft',
        'latitude',
        'longitude',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('world.table_names.airports');
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(
            City::class,
            config('world.table_names.relationship.airports_cities'),
            config('world.column_names.relationship.airport_id'),
            config('world.column_names.relationship.city_id')
        )->withTimestamps();
    }

    public function scopeByCode($query, string|null $iata, string|null $icao): void
    {
        $query->where('iata', $iata)->where('icao', $icao);
    }
}
