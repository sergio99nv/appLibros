const  mix  = require('laravel-mix')


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
 
mix.webpackConfig({
  resolve: {
      extensions: ['.js', '.vue', '.json'],
      alias: {
          "@pathRoot": path.resolve(
              __dirname,
              "resources/js"
          )
      }
  }
});

mix.js('resources/js/admins/bookCategories/app.js', 'public/js/admins/bookCategories')
   //.sass('resources/sass/app.scss', 'public/css');

//mix.js('resources/js/crud/app.js', 'public/js/crud')
   //.sass('resources/sass/app.scss', 'public/css');
