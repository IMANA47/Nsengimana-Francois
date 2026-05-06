<?php

namespace App\Services;

class SectionManager
{
    public function enabledSections(): array
    {
        return collect(config('portfolio.sections', []))
            ->filter(fn (array $section) => ($section['enabled'] ?? false) === true)
            ->values()
            ->all();
    }
}
