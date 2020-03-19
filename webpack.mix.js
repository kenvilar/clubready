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
    'fontawesome': vendors + 'font-awesome/',
    'icheck': vendors + 'icheck/',
    'jquerynicescroll': vendors + 'jquery.nicescroll/dist/',
    'simplelineicons': vendors + 'simple-line-icons/',
    'slimscroll': vendors + 'jquery-slimscroll/',
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
mix.copy(srcImg, destImg);
mix.copy(srcJs + 'src', destJs);

// Copy fonts straight to public
mix.copy(srcCss + 'themify-icons/' + 'fonts', destFonts);
mix.copy(paths.fontawesome + 'fonts', destFonts);

//bootstrapvalidator
mix.copy(paths.bootstrapValidator + 'css/bootstrapValidator.min.css', destVendors + 'bootstrapvalidator/css');
mix.copy(paths.bootstrapValidator + 'js/bootstrapValidator.min.js', destVendors + 'bootstrapvalidator/js');

//icheck
mix.copy(paths.icheck + 'icheck.min.js', destVendors + 'iCheck/js');
mix.copy(paths.icheck + 'skins/', destVendors + 'iCheck/css');

//jquery.nicescroll
mix.copy(paths.jquerynicescroll + 'jquery.nicescroll.min.js', destVendors + 'jquerynicescroll');

//simple-line-icons
mix.copy(paths.simplelineicons + 'css/simple-line-icons.css', destVendors + 'simple-line-icons/css/simple-line-icons.css');
mix.copy(paths.simplelineicons + 'fonts', destVendors + 'simple-line-icons/fonts');

//slimscroll
mix.copy(paths.slimscroll + 'jquery.slimscroll.min.js', destVendors + 'jquery-slimscroll/js');

mix.styles(
    [
        destCss + 'font-awesome.min.css',
        destCss + 'themify-icons/css/themify-icons.css',
        destCss + 'custom_css/metisMenu.css',
    ], destCss + 'app2.css');

mix.scripts(
    [
        destJs + 'custom_js/leftmenu.js',
        destVendors + 'jquerynicescroll/jquery.nicescroll.min.js',
        destVendors + 'jquery-slimscroll/js/jquery.slimscroll.min.js',
        destJs + 'custom_js/rightside_bar.js',
    ], destJs + 'app2.js');

/* custom css and js for dark */
mix.sass(resourcesAssets + 'sass/custom.scss', destCss);
