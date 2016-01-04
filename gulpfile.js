var elixir = require('laravel-elixir');

elixir(function(mix) {

    // Sass
    var options = {
        includePaths: [
            'node_modules/foundation-sites/scss',
            'node_modules/motion-ui/src'
        ]
    };

    mix.sass(['app.scss','custom.scss'], null, options);


    var jQuery = '../../../node_modules/jquery/dist/jquery.js';
    var foundationJsFolder = '../../../node_modules/foundation-sites/js/';

    mix.scripts([
       jQuery,
       foundationJsFolder + 'foundation.core.js',
       foundationJsFolder + 'foundation.reveal.js',
       foundationJsFolder + 'foundation.util.mediaQuery.js',
       foundationJsFolder + 'foundation.util.keyboard.js',
       foundationJsFolder + 'foundation.util.triggers.js',
       foundationJsFolder + 'foundation.util.box.js',
       foundationJsFolder + 'foundation.util.timerAndImageLoader.js',
       foundationJsFolder + 'foundation.util.motion.js',
       foundationJsFolder + 'foundation.tabs.js',

    ]);
    mix.version('public/css/app.css');

});
