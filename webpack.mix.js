const mix = require('laravel-mix');
//const WebpackShellPlugin = require('webpack-shell-plugin');
const WebpackShellPluginNext = require('webpack-shell-plugin-next');

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
    .js('resources/js/admin/sb-admin-2.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin/sb-admin-2.scss', 'public/css');

    mix.webpackConfig({
      plugins:
        [
          new WebpackShellPluginNext({onBuildStart:['php artisan lang:js resources/js/vue-translations.js --no-lib --quiet'], onBuildEnd:[]})
        ]
    });
