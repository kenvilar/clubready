const mix = require('laravel-mix');

//source path configuration
let vendors = 'node_modules/';
let resourcesAssets = 'resources/';
let srcCss = resourcesAssets + 'css/';
let srcJs = resourcesAssets + 'js/';
let srcImg = resourcesAssets + 'img/';

//destination path configuration
let dest = 'public/';
let destFonts = dest + 'fonts/';
let destCss = dest + 'css/';
let destJs = dest + 'js/';
let destImg = dest + 'img/';
let destVendors = dest + 'vendors/';

var paths = {
    'bootstrapValidator': vendors + 'bootstrapvalidator/dist/',
    'icheck': vendors + 'icheck/',
};

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
   .sass('resources/sass/app.scss', 'public/css');

mix.copy(srcCss, destCss);
mix.copy('resources/img','public/img');
mix.copy(srcJs + 'src', destJs);

// bootstrapvalidator
mix.copy(paths.bootstrapValidator + 'css/bootstrapValidator.min.css', destVendors + 'bootstrapvalidator/css');
mix.copy(paths.bootstrapValidator + 'js/bootstrapValidator.min.js', destVendors + 'bootstrapvalidator/js');

//icheck
mix.copy(paths.icheck + 'icheck.min.js', destVendors + 'iCheck/js');
mix.copy(paths.icheck + 'skins/', destVendors + 'iCheck/css');
