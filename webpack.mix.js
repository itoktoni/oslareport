const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

// mix.js('resources/js/app.js', 'public/assets/js/app.min.js')
//     .sass('resources/sass/app.scss', 'public/assets/css/app.min.css')
//     .sass('resources/sass/print.scss', 'public/assets/css');

mix.sass('resources/sass/app.scss', 'public/assets/css/app.min.css')
.sass('resources/sass/print.scss', 'public/assets/css')
.purgeCss({
    enabled: true,
    whitelist: ['page-action', 'table-responsive', 'badge']
});

mix.combine([
    'resources/js/jquery.min.js',
    'resources/js/popper.js',
    'resources/js/bootstrap.min.js',
    'resources/js/stacktable.min.js',
    'resources/js/selectize.min.js',
    // 'resources/js/nprogress.min.js',
    // 'resources/js/toastr.min.js',
    // 'resources/js/toastr.min.js',
    // 'resources/js/htmx.min.js',
    // 'resources/js/bootstrap-autocomplete.min.js',
    // 'resources/js/flatpickr.min.js',
    // 'resources/js/daterangepicker.min.js',
    // 'resources/js/select2.min.js',
    // 'resources/js/chosen.jquery.min.js',
    // 'resources/js/sweetalert2.min.js',
    // 'resources/js/custom-confirm.js',
    'resources/js/app.js',
], 'public/assets/js/app.min.js');