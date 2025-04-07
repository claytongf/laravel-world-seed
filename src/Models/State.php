<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    protected $fillable = [
        'name',
        'state_code',
        'type',
        'country_id',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, config('world.column_names.relationship.country_id'));
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, config('world.column_names.relationship.state_id'));
    }
}
