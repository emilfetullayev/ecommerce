<?php

use App\Models\Translation;

function t($key, $locale = null)
{
    $locale = $locale ?? app()->getLocale();

    return \App\Models\Translation::where('key', $key)
        ->where('locale', $locale)
        ->value('value') ?? $key;
}
