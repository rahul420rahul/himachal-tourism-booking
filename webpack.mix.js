const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/react-booking.jsx', 'public/js')
   .react()
   .sass('resources/sass/app.scss', 'public/css')
   .options({
       processCssUrls: false
   });

if (mix.inProduction()) {
    mix.version();
}
mix.js('resources/js/react-booking.jsx', 'public/js').react();
