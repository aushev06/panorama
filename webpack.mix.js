const mix = require('laravel-mix');


mix.webpackConfig({
    resolve: {
        modules: [
            path.resolve(__dirname, 'node_modules'),
            path.resolve(__dirname, 'resources/spa/src')
        ]
    }
});

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

mix.react('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.react('resources/spa/src/index.js', 'public/js');

mix.styles([
    'public/frontend/css/animate.css',
    'public/frontend/css/custom_bootstrap.css',
    'public/frontend/css/elegant.css',
    'public/frontend/css/fontawesome.css',
    'public/frontend/css/icomoon.css',
    'public/frontend/css/jquery.fancybox.min.css',
    'public/frontend/css/jquery-ui.css',
    'public/frontend/css/normalize.css',
    'public/frontend/css/scroll.css',
    'public/frontend/css/slick.css',
    'public/frontend/css/style.css',
    'public/frontend/css/main.css',
    'public/frontend/css/layout/coming_soon.css',
    'public/frontend/css/layout/faq.css',
], 'public/frontend/css/all.css').version();

mix.scripts([
    'public/frontend/js/jquery.min.js',
    'public/frontend/js/bootstrap.js',
    'public/frontend/js/jquery-ui.min.js',
    'public/frontend/js/jquery.countdown.min.js',
    'public/frontend/js/bootbox.all.min.js',
    'public/frontend/js/slick.min.js',
    'public/frontend/js/jquery.easing.js',
    'public/frontend/js/jquery.scrollUp.min.js',
    'public/frontend/js/jquery.zoom.min.js',
    'public/frontend/js/parallax.js',
    'public/frontend/js/jquery.fancybox.js',
    'public/frontend/js/numscroller-1.0.js',
    'public/frontend/js/vanilla-tilt.min.js',
    'public/frontend/js/main.js',
    'public/frontend/js/jquery.maskedinput.min.js',
    'public/frontend/js/cart.js'
], 'public/frontend/js/all.js').version();
