let mix = require('laravel-mix');

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

mix.options({

    optimization: {
        uglify: true,
        minimize: true,
        runtimeChunk: true,
        splitChunks: {
            chunks: "async",
            minSize: 1000,
            minChunks: 2,
            maxAsyncRequests: 5,
            maxInitialRequests: 3,
            name: true,
            cacheGroups: {
                default: {
                    minChunks: 1,
                    priority: -20,
                    reuseExistingChunk: true,
                },
                vendors: {
                    test: /[//]node_modules[//]/,
                    priority: -10
                }
            }
        }
    }

});
/*
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
**/
mix.combine([
    'public/cubic/plugins/components/jquery/dist/jquery.min.js',
    'public/cubic/js/medialibrary.js',
    'public/cubic/plugins/components/dropzone-master/dist/dropzone.js',
    'public/cubic/bootstrap/dist/js/bootstrap.min.js',
    'public/cubic/js/jquery.slimscroll.js',
    'public/cubic/js/sidebarmenu.js',
    'public/cubic/js/sweetalert2.js',
    'public/cubic/js/waves.js',
    'public/cubic/plugins/components/Magnific-Popup-master/dist/jquery.magnific-popup.js' ,
    'public/cubic/js/custom.js',
], 'public/cubic/js/admin.min.js');



mix.combine([
    'public/cubic/bootstrap/dist/css/bootstrap.min.css',
    'public/cubic/less/icons/components-font-awesome/css/font-awesome.css',
    'public/cubic/less/icons/material-design-iconic-font/css/materialdesignicons.min.css',
    'public/cubic/plugins/components/chartist-js/dist/chartist.min.css',
    'public/cubic/plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
    'public/cubic/css/animate.css',
    'public/cubic/css/buttons.dataTables.min.css',
    'public/cubic/css/style.css',
    'public/cubic/css/colors/default.css',
    'public/cubic/custom.css',
    'public/cubic/plugins/components/dropzone-master/dist/dropzone.css',
    'public/cubic/plugins/alertify/css/alertify.min.css',
    'public/cubic/plugins/components/Magnific-Popup-master/dist/magnific-popup.css',
    'public/cubic/css/main.css'

], 'public/cubic/css/admin.min.css').options({
    processCssUrls: true
});


mix.combine([
    'public/rentit/assets/plugins/bootstrap/css/bootstrap.min.css',
    'public/rentit/assets/plugins/bootstrap-select/css/bootstrap-select.min.css',
    'public/rentit/assets/plugins/fontawesome/css/font-awesome.min.css',
    'public/rentit/assets/plugins/prettyphoto/css/prettyPhoto.css',
    'public/rentit/assets/plugins/owl-carousel2/assets/owl.carousel.min.css',
    'public/rentit/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css',
    'public/rentit/assets/plugins/animate/animate.min.css',
    'public/rentit/assets/plugins/swiper/css/swiper.min.css',
    'public/rentit/assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css',
    'public/rentit/assets/css/theme.css',
    'public/rentit/assets/main.css',


], 'public/rentit/assets/css/all-css.min.css').options({

});


mix.combine([
    /*'public/rentit/assets/plugins/jquery/jquery-1.11.1.min.js',

    'public/rentit/assets/plugins/swiper/js/swiper.jquery.min.js',

    'public/rentit/assets/plugins/bootstrap-select/js/bootstrap-select.min.js',
    'public/rentit/assets/plugins/superfish/js/superfish.min.js',
    'public/rentit/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js',
    'public/rentit/assets/plugins/owl-carousel2/owl.carousel.min.js',
    'public/rentit/assets/plugins/jquery.sticky.min.js',
    'public/rentit/assets/plugins/jquery.easing.min.js',
    'public/rentit/assets/plugins/jquery.smoothscroll.min.js',

    'public/rentit/assets/js/theme.js',
    'public/rentit/assets/js/theme-ajax-mail.js',
    'public/rentit/assets//js/map_init.js',
    //'public/rentit//assets/js/main.js',*/



    'public/rentit/assets/plugins/jquery-ui.min.js',
    'public/rentit/assets/plugins/bootstrap/js/bootstrap.min.js',
    'public/rentit/assets/plugins/bootstrap-select/js/bootstrap-select.min.js',
    'public/rentit/assets/plugins/superfish/js/superfish.min.js',
    'public/rentit/assets/plugins/prettyphoto/js/jquery.prettyPhoto.js',
    'public/rentit/assets/plugins/owl-carousel2/owl.carousel.min.js',
    'public/rentit/assets/plugins/jquery.sticky.min.js',
    'public/rentit/assets/plugins/jquery.easing.min.js',
    'public/rentit/assets/plugins/jquery.smoothscroll.min.js',
    'public/rentit/assets/plugins/swiper/js/swiper.jquery.min.js',
    'public/rentit/assets/plugins/datetimepicker/js/moment-with-locales.min.js',
    'public/rentit/assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js',
    'public/rentit/assets/js/theme-ajax-mail.js',
   // 'public/rentit/assets//js/map_init.js',

], 'public/rentit/assets/js/all-js.min.js').options({

});


