const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/scss/main.scss', 'public/css');

mix.babelConfig({
    plugins: [
        '@babel/plugin-syntax-dynamic-import',
        "@babel/plugin-proposal-class-properties"
    ],
});
