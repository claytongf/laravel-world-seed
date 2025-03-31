<?php

namespace Claytongf\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'code',
        'symbol',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('world.table_names.currencies');
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(
            Country::class,
            config('world.table_names.relationship.countries_currencies'),
            config('world.column_names.relationship.currency_id'),
            config('world.column_names.relationship.country_id')
        );
    }
}
