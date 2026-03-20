<?php

use CodebarAg\FilamentJsonField\Forms\Components\JsonInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Livewire\Component;

// Test component for form integration
class TestJsonInputComponent extends Component
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                JsonInput::make('json_field')
                    ->label('JSON Field')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.test-component');
    }
}

// Create a simple test view
if (! file_exists(__DIR__.'/../resources/views/livewire/')) {
    mkdir(__DIR__.'/../resources/views/livewire/', 0755, true);
}

file_put_contents(__DIR__.'/../resources/views/livewire/test-component.blade.php', '
<div>
    {{ $this->form }}
</div>
');

describe('JsonInput Component', function () {
    it('can be instantiated', function () {
        $field = JsonInput::make('json_field');

        expect($field)->toBeInstanceOf(JsonInput::class);
        expect($field->getName())->toBe('json_field');
    });

    it('has correct default values', function () {
        $field = JsonInput::make('json_field');

        expect($field->getHasLineNumbers())->toBe(true);
        expect($field->getHasLineWrapping())->toBe(true);
        expect($field->getHasAutoCloseBrackets())->toBe(true);
        expect($field->getHasFoldingCode())->toBe(true);
        expect($field->getHasDarkTheme())->toBe(false);
        expect($field->getHasFoldedCode())->toBe(false);
    });

    it('can configure folding code', function () {
        $field = JsonInput::make('json');

        expect($field->getHasFoldingCode())->toBe(true);

        $field->foldingCode(false);
        expect($field->getHasFoldingCode())->toBe(false);

        $field->foldingCode(true);
        expect($field->getHasFoldingCode())->toBe(true);
    });

    it('can configure folded code', function () {
        $field = JsonInput::make('json');

        expect($field->getHasFoldedCode())->toBe(false);

        $field->foldedCode(false);
        expect($field->getHasFoldedCode())->toBe(false);

        $field->foldedCode(true);
        expect($field->getHasFoldedCode())->toBe(true);
    });

    it('can configure auto closing brackets', function () {
        $field = JsonInput::make('json');

        expect($field->getHasAutoCloseBrackets())->toBe(true);

        $field->autoCloseBrackets(false);
        expect($field->getHasAutoCloseBrackets())->toBe(false);

        $field->autoCloseBrackets(true);
        expect($field->getHasAutoCloseBrackets())->toBe(true);
    });

    it('can configure line numbers', function () {
        $field = JsonInput::make('json');

        expect($field->getHasLineNumbers())->toBe(true);

        $field->lineNumbers(false);
        expect($field->getHasLineNumbers())->toBe(false);

        $field->lineNumbers(true);
        expect($field->getHasLineNumbers())->toBe(true);
    });

    it('can configure line wrapping', function () {
        $field = JsonInput::make('json');

        expect($field->getHasLineWrapping())->toBe(true);

        $field->lineWrapping(false);
        expect($field->getHasLineWrapping())->toBe(false);

        $field->lineWrapping(true);
        expect($field->getHasLineWrapping())->toBe(true);
    });

    it('can configure dark theme', function () {
        $field = JsonInput::make('json');

        expect($field->getHasDarkTheme())->toBe(false);

        $field->darkTheme(false);
        expect($field->getHasDarkTheme())->toBe(false);

        $field->darkTheme(true);
        expect($field->getHasDarkTheme())->toBe(true);
    });

    it('has correct validation rules', function () {
        $field = JsonInput::make('json_field');

        $rules = $field->getValidationRules();

        expect($rules)->toContain('array');
    });

    it('has correct validation messages', function () {
        $field = JsonInput::make('json_field');

        $messages = $field->getValidationMessages();

        expect($messages)->toHaveKey('array');
        expect($messages['array'])->toBe('The :attribute must be valid JSON.');
    });

    it('can be configured with all features', function () {
        $field = JsonInput::make('json_field')
            ->darkTheme(true)
            ->lineNumbers(true)
            ->lineWrapping(true)
            ->autoCloseBrackets(true)
            ->foldingCode(true)
            ->foldedCode(true);

        expect($field->getHasDarkTheme())->toBe(true);
        expect($field->getHasLineNumbers())->toBe(true);
        expect($field->getHasLineWrapping())->toBe(true);
        expect($field->getHasAutoCloseBrackets())->toBe(true);
        expect($field->getHasFoldingCode())->toBe(true);
        expect($field->getHasFoldedCode())->toBe(true);
    });

    it('can be made required', function () {
        $field = JsonInput::make('json_field')->required();

        $rules = $field->getValidationRules();

        expect($rules)->toContain('required');
    });

    it('can have custom validation rules', function () {
        $field = JsonInput::make('json_field')
            ->rules(['array', 'min:1']);

        $rules = $field->getValidationRules();

        expect($rules)->toContain('array');
        expect($rules)->toContain('min:1');
    });

    it('can have custom validation messages', function () {
        $field = JsonInput::make('json_field')
            ->validationMessages([
                'array' => 'Custom array message',
                'required' => 'Custom required message',
            ]);

        $messages = $field->getValidationMessages();

        expect($messages['array'])->toBe('Custom array message');
        expect($messages['required'])->toBe('Custom required message');
    });

    it('can be made read-only', function () {
        $field = JsonInput::make('json_field')->readOnly();

        expect($field->isReadOnly())->toBe(true);
    });

    it('can be disabled', function () {
        $field = JsonInput::make('json_field')->disabled();

        expect($field->isDisabled())->toBe(true);
    });

    it('can have a label', function () {
        $field = JsonInput::make('json_field')->label('JSON Data');

        expect($field->getLabel())->toBe('JSON Data');
    });

    it('can have a name', function () {
        $field = JsonInput::make('json_field')->name('custom_name');

        expect($field->getName())->toBe('custom_name');
    });

    it('can have an ID', function () {
        $field = JsonInput::make('json_field')->id('custom_id');

        expect($field->getId())->toBe('custom_id');
    });

    it('can be hidden', function () {
        $field = JsonInput::make('json_field')->hidden();

        expect($field->isHidden())->toBe(true);
    });

    it('can be visible', function () {
        $field = JsonInput::make('json_field')->visible();

        expect($field->isHidden())->toBe(false);
    });

    it('can have a hint', function () {
        $field = JsonInput::make('json_field')->hint('Enter valid JSON');

        expect($field->getHint())->toBe('Enter valid JSON');
    });

    it('can be configured with fluent interface', function () {
        $field = JsonInput::make('json_field')
            ->label('JSON Data')
            ->hint('Enter valid JSON')
            ->required()
            ->darkTheme(true)
            ->lineNumbers(true)
            ->lineWrapping(true)
            ->autoCloseBrackets(true)
            ->foldingCode(true)
            ->foldedCode(true);

        expect($field->getLabel())->toBe('JSON Data');
        expect($field->getHint())->toBe('Enter valid JSON');
        expect($field->isRequired())->toBe(true);
        expect($field->getHasDarkTheme())->toBe(true);
        expect($field->getHasLineNumbers())->toBe(true);
        expect($field->getHasLineWrapping())->toBe(true);
        expect($field->getHasAutoCloseBrackets())->toBe(true);
        expect($field->getHasFoldingCode())->toBe(true);
        expect($field->getHasFoldedCode())->toBe(true);
    });

    it('has correct view path', function () {
        $field = JsonInput::make('json_field');

        expect($field->getView())->toBe('filament-json-field::forms.components.json-input');
    });

    it('has correct asset package name', function () {
        expect(JsonInput::getAssetPackageName())->toBe('laravel-filament-json-field');
    });
});
