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
    var foundationJsFolder = '../../../node_modules/foundation-sites/js/';

    mix.scripts([
       jQuery,
       foundationJsFolder + 'foundation.core.js',
       foundationJsFolder + 'foundation.reveal.js',
       foundationJsFolder + 'foundation.toggler.js',
       foundationJsFolder + 'foundation.util.mediaQuery.js',
       foundationJsFolder + 'foundation.util.triggers.js',
       foundationJsFolder + 'foundation.tabs.js',
       foundationJsFolder + 'foundation.util.box.js',
       foundationJsFolder + 'foundation.util.timerAndImageLoader.js',
       foundationJsFolder + 'foundation.util.motion.js',
       foundationJsFolder + 'foundation.tabs.js',
       foundationJsFolder + 'foundation.responsiveMenu.js',
       foundationJsFolder + 'foundation.responsiveToggle.js',

    ]);

    mix.version(['public/css/app.css','public/js/all.js']);

});
