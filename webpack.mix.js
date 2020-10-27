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
    .js('resources/js/pageap.js', 'public/js')
    .js('resources/js/pageapcob.js', 'public/js')
    .js('resources/js/pageapob.js', 'public/js')
    .js('resources/js/pagealc.js', 'public/js')
    .js('resources/js/pagealcob.js', 'public/js')
    .js('resources/js/pagealpob.js', 'public/js')
    .js('resources/js/pagesan.js', 'public/js')
    .js('resources/js/pagecal.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
