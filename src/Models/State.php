<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
        'state_code',
        'type',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, config('world.column_names.relationship.country_id'));
    }
}
