import * as esbuild from 'esbuild';

// Build JavaScript
await esbuild.build({
    entryPoints: ['./resources/js/laravel-filament-json-field.js'],
    outfile: './dist/laravel-filament-json-field.js',
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'browser',
    treeShaking: true,
    target: ['es2020'],
    minify: true,
});

// Build CSS (if needed in the future)
// await esbuild.build({
//     entryPoints: ['./resources/css/laravel-filament-json-field.css'],
//     outfile: './dist/laravel-filament-json-field.css',
//     bundle: true,
//     platform: 'browser',
//     minify: true,
// });
