var elixir = require('laravel-elixir');

elixir(function(mix) {

    var options = {
        includePaths: [
            'node_modules/foundation-sites/scss',
            'node_modules/motion-ui/src'
        ]
    };
    var bower_path = 'bower_components/Buttons/scss/';

    mix.sass(['app.scss','custom.scss',bower_path+'buttons.scss'], null, options);


    var jQuery = '../../../node_modules/jquery/dist/jquery.js';
    var foundationJsFolder = '../../../node_modules/foundation-sites/dist/';

    mix.scripts([
       jQuery,
       foundationJsFolder + 'foundation.min.js',
    ]);

    mix.version(['public/css/app.css','public/js/all.js']);

});
