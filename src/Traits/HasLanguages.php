<?php

namespace Claytongf\WorldSeed\Traits;

use Claytongf\Models\Language;

trait HasLanguages
{
    /**
     * Save languages to the database.
     *
     * This function iterates through the given languages and saves them
     * to the database using the Language model. If a language already
     * exists, it will not be duplicated.
     *
     * @param array $languages An array of languages to be saved, where each language
     *                         is an associative array containing 'name' and 'code'.
     * @return array An array of saved Language model instances.
     */
    private function saveLanguages($languages): array
    {
        $savedLanguages = [];
        $i = 0;
        foreach ($languages as $languageCode => $languageName) {
            $savedLanguages[$i++] = Language::firstOrCreate([
                'name' => $languageName,
                'code' => $languageCode,
            ]);
        }
        return $savedLanguages;
    }
}
