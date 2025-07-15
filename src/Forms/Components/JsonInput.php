<?php

namespace CodebarAg\FilamentJsonField\Forms\Components;

use CodebarAg\FilamentJsonField\Concerns\HasAutoCloseBrackets;
use CodebarAg\FilamentJsonField\Concerns\HasDarkTheme;
use CodebarAg\FilamentJsonField\Concerns\HasFoldingCode;
use CodebarAg\FilamentJsonField\Concerns\HasLineNumbers;
use CodebarAg\FilamentJsonField\Concerns\HasLineWrapping;
use Filament\Forms\Components\Concerns\CanBeReadOnly;
use Filament\Forms\Components\Field;

class JsonInput extends Field
{
    use CanBeReadOnly;
    use HasAutoCloseBrackets;
    use HasDarkTheme;
    use HasFoldingCode;
    use HasLineNumbers;
    use HasLineWrapping;

    protected string $view = 'filament-json-field::forms.components.json-input';

    public static function getAssetPackageName(): ?string
    {
        return 'laravel-filament-json-field';
    }

    public function setUp(): void
    {
        parent::setUp();

        $this
            ->rules(['array'])
            ->validationMessages([
                'array' => __('The :attribute must be valid JSON.'),
            ]);
    }

    public function getGutters(): array
    {
        $gutters = [];
        
        if ($this->getHasLineNumbers()) {
            $gutters[] = 'CodeMirror-linenumbers';
        }
        
        if ($this->getHasFoldingCode()) {
            $gutters[] = 'CodeMirror-foldgutter';
        }
        
        return $gutters;
    }
}
