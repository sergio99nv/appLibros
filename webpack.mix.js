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

mix.js('resources/js/admins/bookCategories/app.js', 
        'public/js/admins/bookCategories/');
   //.sass('resources/sass/app.scss', 'public/css');

 //login admins
 mix.js('resources/js/admins/users/app.js', 
 'public/js/admins/users/app.js');



   //login admins
   mix.js('resources/js/admins/login/app.js', 
   'public/js/admins/login/app.js');

   //login students
   mix.js('resources/js/students/login/app.js', 
   'public/js/students/login/app.js');

   //register students
   mix.js('resources/js/students/register/app.js', 
   'public/js/students/register/app.js');

  //menu
  mix.js('resources/js/app.js', 
  'public/js/app.js');



 mix.styles('resources/css/app_main.css', 'public/css/app_main.css')


 mix.styles('resources/css/admin/login.css', 'public/css/admin/login.css')
   //.sass('resources/sass/app.scss', 'public/css');
