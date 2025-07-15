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