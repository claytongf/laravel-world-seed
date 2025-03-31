<?php

namespace Claytongf\WorldSeed\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = [
            'country_name',
            'language',
            config('world.column_names.relationship.country_id')
        ];

        $this->casts = [
            'country_name' => 'string',
            'language' => 'string',
            config('world.column_names.relationship.country_id') => 'integer',
        ];

        $this->table = config('world.table_names.translations');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, config('world.column_names.relationship.country_id'));
    }
}
