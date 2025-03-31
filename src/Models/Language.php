<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Language extends Model
{
    protected $fillable = [
        'name', 'code',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('world.table_names.languages');
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(
            Country::class,
            config('world.table_names.relationship.countries_languages'),
            config('world.column_names.relationship.language_id'),
            config('world.column_names.relationship.country_id')
        );
    }
}
