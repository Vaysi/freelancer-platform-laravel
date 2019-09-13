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
    .js('resources/js/admin.js', 'public/js')
    .js('resources/js/auth.js', 'public/js')
    .js('resources/js/user.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/auth.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/front/app.scss', 'public/front/css')
    .sass('resources/sass/user/app.scss', 'public/user/css');

// Copy
mix.copyDirectory('node_modules/filepond/dist','public/vendor/filepond')
    .copy('node_modules/jquery-filepond/filepond.jquery.js','public/vendor/filepond')
    .copy('node_modules/summernote/dist/summernote-bs4.min.js','public/vendor')
    .copy('node_modules/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js','public/vendor/filepond')
    .copy('node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js','public/vendor/filepond');
