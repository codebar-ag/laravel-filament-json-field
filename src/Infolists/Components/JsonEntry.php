<?php

namespace CodebarAg\FilamentJsonField\Infolists\Components;

use CodebarAg\FilamentJsonField\Concerns\HasAutoCloseBrackets;
use CodebarAg\FilamentJsonField\Concerns\HasDarkTheme;
use CodebarAg\FilamentJsonField\Concerns\HasFoldingCode;
use CodebarAg\FilamentJsonField\Concerns\HasLineNumbers;
use CodebarAg\FilamentJsonField\Concerns\HasLineWrapping;
use Filament\Infolists\Components\Entry;

class JsonEntry extends Entry
{
    use HasAutoCloseBrackets;
    use HasDarkTheme;
    use HasFoldingCode;
    use HasLineNumbers;
    use HasLineWrapping;

    protected string $view = 'filament-json-field::infolists.components.json-entry';

    public static function getAssetPackageName(): ?string
    {
        return 'laravel-filament-json-field';
    }
}
