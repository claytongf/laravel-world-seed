<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\WorldSeed\Models\Translation;

trait HasTranslations
{
    public function saveTranslations($translations, $countryId): void
    {
        foreach ($translations as $language => $countryName) {
            Translation::firstOrCreate([
                'country_id' => $countryId,
                'language' => $language,
                'country_name' => $countryName
            ]);
        }
    }
}
