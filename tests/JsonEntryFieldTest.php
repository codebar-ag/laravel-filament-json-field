<?php

use CodebarAg\FilamentJsonField\Infolists\Components\JsonEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

// Test component for infolist integration
class TestJsonEntryComponent extends Component
{
    use InteractsWithInfolists;

    public array $data = [
        'json_field' => ['key' => 'value', 'nested' => ['test' => 'data']],
    ];

    public function mount(): void
    {
        $this->infolist->fill($this->data);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                JsonEntry::make('json_field')
                    ->label('JSON Field'),
            ])
            ->state($this->data);
    }

    public function render()
    {
        return view('livewire.test-infolist-component');
    }
}

// Create a simple test view for infolists
if (! file_exists(__DIR__.'/../resources/views/livewire/')) {
    mkdir(__DIR__.'/../resources/views/livewire/', 0755, true);
}

file_put_contents(__DIR__.'/../resources/views/livewire/test-infolist-component.blade.php', '
<div>
    {{ $this->infolist }}
</div>
');

describe('JsonEntry Component', function () {
    it('can be instantiated', function () {
        $entry = JsonEntry::make('json_field');

        expect($entry)->toBeInstanceOf(JsonEntry::class);
        expect($entry->getName())->toBe('json_field');
    });

    it('has correct default values', function () {
        $entry = JsonEntry::make('json_field');

        expect($entry->getHasLineNumbers())->toBe(true);
        expect($entry->getHasLineWrapping())->toBe(true);
        expect($entry->getHasAutoCloseBrackets())->toBe(true);
        expect($entry->getHasFoldingCode())->toBe(true);
        expect($entry->getHasDarkTheme())->toBe(false);
        expect($entry->getHasFoldedCode())->toBe(false);
    });

    it('can configure folding code', function () {
        $entry = JsonEntry::make('json');

        expect($entry->getHasFoldingCode())->toBe(true);

        $entry->foldingCode(false);
        expect($entry->getHasFoldingCode())->toBe(false);

        $entry->foldingCode(true);
        expect($entry->getHasFoldingCode())->toBe(true);
    });

    it('can configure folded code', function () {
        $entry = JsonEntry::make('json');

        expect($entry->getHasFoldedCode())->toBe(false);

        $entry->foldedCode(false);
        expect($entry->getHasFoldedCode())->toBe(false);

        $entry->foldedCode(true);
        expect($entry->getHasFoldedCode())->toBe(true);
    });

    it('can configure auto closing brackets', function () {
        $entry = JsonEntry::make('json');

        expect($entry->getHasAutoCloseBrackets())->toBe(true);

        $entry->autoCloseBrackets(false);
        expect($entry->getHasAutoCloseBrackets())->toBe(false);

        $entry->autoCloseBrackets(true);
        expect($entry->getHasAutoCloseBrackets())->toBe(true);
    });

    it('can configure line numbers', function () {
        $entry = JsonEntry::make('json');

        expect($entry->getHasLineNumbers())->toBe(true);

        $entry->lineNumbers(false);
        expect($entry->getHasLineNumbers())->toBe(false);

        $entry->lineNumbers(true);
        expect($entry->getHasLineNumbers())->toBe(true);
    });

    it('can configure line wrapping', function () {
        $entry = JsonEntry::make('json');

        expect($entry->getHasLineWrapping())->toBe(true);

        $entry->lineWrapping(false);
        expect($entry->getHasLineWrapping())->toBe(false);

        $entry->lineWrapping(true);
        expect($entry->getHasLineWrapping())->toBe(true);
    });

    it('can configure dark theme', function () {
        $entry = JsonEntry::make('json');

        expect($entry->getHasDarkTheme())->toBe(false);

        $entry->darkTheme(false);
        expect($entry->getHasDarkTheme())->toBe(false);

        $entry->darkTheme(true);
        expect($entry->getHasDarkTheme())->toBe(true);
    });

    it('can be configured with all features', function () {
        $entry = JsonEntry::make('json_field')
            ->darkTheme(true)
            ->lineNumbers(true)
            ->lineWrapping(true)
            ->autoCloseBrackets(true)
            ->foldingCode(true)
            ->foldedCode(true);

        expect($entry->getHasDarkTheme())->toBe(true);
        expect($entry->getHasLineNumbers())->toBe(true);
        expect($entry->getHasLineWrapping())->toBe(true);
        expect($entry->getHasAutoCloseBrackets())->toBe(true);
        expect($entry->getHasFoldingCode())->toBe(true);
        expect($entry->getHasFoldedCode())->toBe(true);
    });

    it('can have a label', function () {
        $entry = JsonEntry::make('json_field')->label('JSON Data');

        expect($entry->getLabel())->toBe('JSON Data');
    });

    it('can have a name', function () {
        $entry = JsonEntry::make('json_field')->name('custom_name');

        expect($entry->getName())->toBe('custom_name');
    });

    it('can have an ID', function () {
        $entry = JsonEntry::make('json_field')->id('custom_id');

        expect($entry->getId())->toBe('custom_id');
    });

    it('can be hidden', function () {
        $entry = JsonEntry::make('json_field')->hidden();

        expect($entry->isHidden())->toBe(true);
    });

    it('can be visible', function () {
        $entry = JsonEntry::make('json_field')->visible();

        expect($entry->isHidden())->toBe(false);
    });

    it('can have a hint', function () {
        $entry = JsonEntry::make('json_field')->hint('JSON data display');

        expect($entry->getHint())->toBe('JSON data display');
    });

    it('can be configured with fluent interface', function () {
        $entry = JsonEntry::make('json_field')
            ->label('JSON Data')
            ->hint('JSON data display')
            ->darkTheme(true)
            ->lineNumbers(true)
            ->lineWrapping(true)
            ->autoCloseBrackets(true)
            ->foldingCode(true)
            ->foldedCode(true);

        expect($entry->getLabel())->toBe('JSON Data');
        expect($entry->getHint())->toBe('JSON data display');
        expect($entry->getHasDarkTheme())->toBe(true);
        expect($entry->getHasLineNumbers())->toBe(true);
        expect($entry->getHasLineWrapping())->toBe(true);
        expect($entry->getHasAutoCloseBrackets())->toBe(true);
        expect($entry->getHasFoldingCode())->toBe(true);
        expect($entry->getHasFoldedCode())->toBe(true);
    });

    it('can format JSON data correctly', function () {
        $entry = JsonEntry::make('json_field');

        $testData = ['key' => 'value', 'nested' => ['test' => 'data']];
        $entry->state($testData);

        expect($entry->getState())->toBe($testData);
    });

    it('can handle null values', function () {
        $entry = JsonEntry::make('json_field');

        $entry->state(null);

        expect($entry->getState())->toBeNull();
    });

    it('can handle complex nested JSON', function () {
        $entry = JsonEntry::make('json_field');

        $complexData = [
            'users' => [
                [
                    'id' => 1,
                    'name' => 'John Doe',
                    'email' => 'john@example.com',
                    'settings' => [
                        'theme' => 'dark',
                        'notifications' => true,
                        'preferences' => [
                            'language' => 'en',
                            'timezone' => 'UTC',
                        ],
                    ],
                ],
                [
                    'id' => 2,
                    'name' => 'Jane Smith',
                    'email' => 'jane@example.com',
                    'settings' => [
                        'theme' => 'light',
                        'notifications' => false,
                    ],
                ],
            ],
            'metadata' => [
                'total_users' => 2,
                'created_at' => '2024-01-01T00:00:00Z',
                'tags' => ['important', 'urgent', 'feature'],
            ],
        ];

        $entry->state($complexData);

        expect($entry->getState())->toBe($complexData);
    });

    it('has correct view path', function () {
        $entry = JsonEntry::make('json_field');

        expect($entry->getView())->toBe('filament-json-field::infolists.components.json-entry');
    });

    it('can have extra attributes', function () {
        $entry = JsonEntry::make('json_field')->extraAttributes(['data-test' => 'value']);

        expect($entry->getExtraAttributes())->toBe(['data-test' => 'value']);
    });
});
