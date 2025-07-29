<img src="https://banners.beyondco.de/Laravel%20Filament%20Json%20Field.png?theme=light&packageManager=composer+require&packageName=codebar-ag%2Flaravel-filament-json-field&pattern=circuitBoard&style=style_1&description=A+Laravel+Filament+Json+Field+integration.&md=1&showWatermark=1&fontSize=100px&images=light-bulb">

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codebar-ag/laravel-filament-json-field.svg?style=flat-square)](https://packagist.org/packages/codebar-ag/laravel-filament-json-field)
[![GitHub-Tests](https://github.com/codebar-ag/laravel-filament-json-field/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/codebar-ag/laravel-filament-json-field/actions/workflows/run-tests.yml)
[![GitHub Code Style](https://github.com/codebar-ag/laravel-filament-json-field/actions/workflows/fix-php-code-style-issues.yml/badge.svg?branch=main)](https://github.com/codebar-ag/laravel-filament-json-field/actions/workflows/fix-php-code-style-issues.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/codebar-ag/laravel-filament-json-field.svg?style=flat-square)](https://packagist.org/packages/codebar-ag/laravel-filament-json-field)


## 💡 What is Filament Json Field?

Filament Json Field is a Laravel Filament JSON Field integration with CodeMirror support, providing a powerful and feature-rich JSON editor for your Filament forms and infolists.

## 🛠 Requirements

| Package       | PHP              | Laravel        | Filament Forms | Filament Infolists | Filament Support |
|-----------|------------------|---------------|----------------|--------------------|------------------|
| v13.0 (alpha)   | ^8.3, ^8.4 | ^13.0         | ^4.0           | ^4.0               | ^4.0            |
| v12.0     | ^8.2, ^8.3, ^8.4 | ^12.0         | ^3.3           | ^3.3               | ^3.3            |
| v2.0      | ^8.1             | ^11.0         | ^3.2           | ^3.2               | ^3.2            |
| v1.0      | ^8.1             | ^10.45, ^11.0 | ^3.2           | ^3.2               | ^3.2            |


## ⚙️ Installation

You can install the package via composer:

```bash
composer require codebar-ag/laravel-filament-json-field
php artisan filament:assets
```


## Usage

### Forms

```php
use CodebarAg\FilamentJsonField\Forms\Components\JsonInput;

...

public function form(Form $form): Form
{
    return $form
        ->schema([
            JsonInput::make('json')
                ->label('JSON Data')
                ->lineNumbers(true)
                ->lineWrapping(true)
                ->autoCloseBrackets(true)
                ->darkTheme(true)
                ->foldingCode(true)
                ->foldedCode(true) // Folded code will fold the code on form load
                ->readOnly(false), // Set to true to make the field read-only
        ]);
}
```

### Infolists

```php
use CodebarAg\FilamentJsonField\Infolists\Components\JsonEntry;

...

public function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            JsonEntry::make('json')
                ->label('JSON Data')
                ->lineNumbers(true)
                ->lineWrapping(true)
                ->autoCloseBrackets(true)
                ->darkTheme(true)
                ->foldingCode(true)
                ->foldedCode(true), // Folded code will fold the code on form load
        ]);
}
```

### Options

The following options are currently supported:

| Option              | Supported | Description |
|---------------------|:---------:|-------------|
| Line Numbers        |     ✅     | Display line numbers in the editor |
| Line Wrapping       |     ✅     | Enable line wrapping for long lines |
| Auto Close Brackets |     ✅     | Automatically close brackets and quotes |
| Dark Theme          |     ✅     | Enable dark theme styling |
| Folding Code        |     ✅     | Enable code folding functionality |
| Folded Code         |     ✅     | Start with code folded (forms only) |
| Read Only           |     ✅     | Make the field read-only (forms only) |

### Features

- **CodeMirror Integration**: Powered by CodeMirror 5 for excellent JSON editing experience
- **Syntax Highlighting**: Full JSON syntax highlighting with validation
- **Error Handling**: Built-in JSON validation with user-friendly error messages
- **Responsive Design**: Works seamlessly across different screen sizes
- **Customizable**: Extensive configuration options for different use cases
- **Filament 4.0 Ready**: Fully compatible with the latest Filament version

## 🚧 Testing

Copy your own phpunit.xml-file.

```bash
cp phpunit.xml.dist phpunit.xml
```

Run the tests:

```bash
./vendor/bin/pest
```

## 🚧 Building

```bash
node bin/build
```

Note: there is no output, but the build will be in the `dist` directory.

## 📝 Changelog

Please see [CHANGELOG](CHANGELOG.md) for recent changes.

## ✏️ Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

```bash
composer test
```

### Code Style

```bash
./vendor/bin/pint
```

## 🧑‍💻 Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on reporting security vulnerabilities.

## 🙏 Credits
- [Rhys Lees](https://github.com/RhysLees)
- [Sebastian Fix](https://github.com/StanBarrows)
- [All Contributors](../../contributors)
- [Skeleton Repository from Spatie](https://github.com/spatie/package-skeleton-laravel)
- [Laravel Package Training from Spatie](https://spatie.be/videos/laravel-package-training)

## 🎭 License

The MIT License (MIT). Please have a look at [License File](LICENSE.md) for more information.
