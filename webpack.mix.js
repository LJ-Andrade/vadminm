const { mix } = require('laravel-mix');

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

// Web
// mix.js('resources/assets/js/web/web.js', 'public/js')
//     .sass('resources/assets/sass/web.scss', 'public/css')
//     .options({
//       processCssUrls: false
//    });

// // // Web Css Vendors
// mix.combine([
//     'public/plugins/animate/animate.css',
//     'public/plugins/ionicons/ionicons.min.css'
// ], 'public/css/web-vendors.css');

// // Web JS Vendors
// mix.combine([
//     'public/plugins/wow/script.wow.js',
//     'public/plugins/jquery/jquery-3.3.1.min.js',
//     'public/plugins/bootstrap/js/bootstrap.min.js'
// ], 'public/js/web-vendors.js');
  

mix.sass('resources/assets/sass/vadmin/vadmin.sass', 'public/css')
    .options({
      processCssUrls: false
   });

// .js('resources/assets/js/vadmin/vadmin.js', 'public/js')
