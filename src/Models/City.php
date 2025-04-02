<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $fillable = [
        'name',
        'state_id',
        'country_id',
        'latitude',
        'longitude',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('world.table_names.cities');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, config('world.column_names.relationship.state_id'));
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, config('world.column_names.relationship.country_id'));
    }

    public function airports(): BelongsToMany
    {
        return $this->belongsToMany(
            Airport::class,
            config('world.table_names.relationship.airports_cities'),
            config('world.column_names.relationship.city_id'),
            config('world.column_names.relationship.airport_id')
        )->withTimestamps();
    }
}
