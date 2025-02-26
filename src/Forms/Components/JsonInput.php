<?php

namespace CodebarAg\FilamentJsonField\Forms\Components;

use CodebarAg\FilamentJsonField\Concerns\HasAutoCloseBrackets;
use CodebarAg\FilamentJsonField\Concerns\HasDarkTheme;
use CodebarAg\FilamentJsonField\Concerns\HasFoldingCode;
use CodebarAg\FilamentJsonField\Concerns\HasLineNumbers;
use CodebarAg\FilamentJsonField\Concerns\HasLineWrapping;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Field;

class JsonInput extends Field
{
    use Concerns\CanBeReadOnly;
    use HasAutoCloseBrackets;
    use HasDarkTheme;
    use HasFoldingCode;
    use HasLineNumbers;
    use HasLineWrapping;

    // @phpstan-ignore-next-line
    protected string $view = 'laravel-filament-json-field::forms.components.json-input';

    public function setUp(): void
    {
        parent::setUp();

        $this
            ->rules(['array'])
            ->validationMessages([
                'array' => __('The :attribute must be valid JSON.'),
            ]);
    }
}
