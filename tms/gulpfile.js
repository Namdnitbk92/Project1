var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});

elixir(function(mix) {
    mix.scripts([
        "app.js"
    ]);

  	mix.scripts([
        "jquery.js"
    ],'public/js/jquery.js');

	mix.scripts([
        "semantic.min.js"
    ],'public/js/semantic.js');

    mix.scripts([
        "bootstrap.min.js"
    ],'public/js/bootstrap.js');

    mix.scripts([
        "underscore.js"
    ],'public/js/underscore.js');

});
