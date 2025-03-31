<?php

namespace Claytongf\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function state()
    {
        return $this->belongsTo(State::class, config('world.column_names.relationship.state_id'));
    }

    public function country()
    {
        return $this->belongsTo(Country::class, config('world.column_names.relationship.country_id'));
    }
}
