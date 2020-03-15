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
    'chartjs': vendors + 'chart.js/dist/',
    'fontawesome': vendors + 'font-awesome/',
    'icheck': vendors + 'icheck/',
    'moment': vendors + 'moment/',
    'nvd3': vendors + 'nvd3/build/',
    'swiper': vendors + 'swiper/',
    'jquerynicescroll': vendors + 'jquery.nicescroll/dist/',
    'slimscroll': vendors + 'jquery-slimscroll/', // node_modules/jquery-slimscroll/jquery.slimscroll.min.js
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
mix.copy('resources/img', 'public/img');
mix.copy(srcJs + 'src', destJs);

// Copy fonts straight to public
mix.copy(srcCss + 'themify-icons/' + 'fonts', destFonts);
mix.copy(paths.fontawesome + 'fonts', destFonts);

//bootstrapvalidator
mix.copy(paths.bootstrapValidator + 'css/bootstrapValidator.min.css', destVendors + 'bootstrapvalidator/css');
mix.copy(paths.bootstrapValidator + 'js/bootstrapValidator.min.js', destVendors + 'bootstrapvalidator/js');

//Chart.js
mix.copy(paths.chartjs + 'Chart.js', destVendors + 'chartjs/js');

//icheck
mix.copy(paths.icheck + 'icheck.min.js', destVendors + 'iCheck/js');
mix.copy(paths.icheck + 'skins/', destVendors + 'iCheck/css');

//jquery.nicescroll
mix.copy(paths.jquerynicescroll + 'jquery.nicescroll.min.js', destVendors + 'jquerynicescroll');

//moment
mix.copy(paths.moment + 'min/moment.min.js', destVendors + 'moment/js');

//nvd3
mix.copy(paths.nvd3 + 'nv.d3.min.css', destVendors + 'nvd3/css');
mix.copy(paths.nvd3 + 'nv.d3.min.js', destVendors + 'nvd3/js');

//slimscroll
mix.copy(paths.slimscroll + 'jquery.slimscroll.min.js', destVendors + 'jquery-slimscroll/js');

//swiper
mix.copy(paths.swiper + 'css/swiper.min.css', destVendors + 'swiper/css');
mix.copy(paths.swiper + 'js/swiper.min.js', destVendors + 'swiper/js');

mix.styles(
    [
        // destCss + 'bootstrap.css',
        destCss + 'font-awesome.min.css',
        destCss + 'themify-icons/css/themify-icons.css',
        // destCss + 'custom_css/metisMenu.css',
        // destVendors + 'bootstrap-switch/css/bootstrap-switch.min.css'
    ], destCss + 'app2.css');

mix.scripts(
    [
        // destJs + 'jquery.min.js',
        // destJs + 'popper.min.js',
        // destJs + 'jquery.ui.min.js',
        // destJs + 'bootstrap.min.js',
        // destJs + 'custom_js/leftmenu.js',
        destVendors + 'jquerynicescroll/jquery.nicescroll.min.js',
        destVendors + 'jquery-slimscroll/js/jquery.slimscroll.min.js',
        destJs + 'custom_js/rightside_bar.js',
        // destJs + 'custom_js/custom_white.js',                 /* Add custom js for light */
        // destVendors + 'bootstrap-switch/js/bootstrap-switch.min.js'

    ], destJs + 'app2.js');

// flot charts
mix.copy(srcJs + 'flot/js/jquery.flot.js', destJs + 'flot/js');
mix.copy(srcJs + 'flot/js/jquery.flot.stack.js', destJs + 'flot/js');
mix.copy(srcJs + 'flot/js/jquery.flot.resize.js', destJs + 'flot/js');
mix.copy(srcJs + 'flot/js/jquery.flot.time.js', destJs + 'flot/js');
mix.copy(srcJs + 'flot/js/jquery.flot.categories.js', destJs + 'flot/js');
mix.copy(srcJs + 'flot/js/jquery.flot.pie.js', destJs + 'flot/js');
mix.copy(srcJs + 'flot/js/jquery.flot.spline.min.js', destJs + 'flotspline/js');
mix.copy(srcJs + 'flot/js/jquery.flot.tooltip.js', destJs + 'flottooltip/js');

/* custom css and js for dark */
mix.sass(resourcesAssets + 'sass/custom.scss', destCss);
