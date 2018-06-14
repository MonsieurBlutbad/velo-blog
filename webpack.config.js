var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    .enableLessLoader()
    .addStyleEntry('css/app', './assets/css/style.less')
    .addStyleEntry('css/fancybox', './assets/lib/bower_components/fancybox/dist/jquery.fancybox.min.css')

    .addEntry('js/jquery', './assets/lib/bower_components/jquery/dist/jquery.min.js' )
    .addEntry('js/jquery-ui', './assets/lib/bower_components/jquery-ui/jquery-ui.min.js' )
    .addEntry('js/bootstrap', './assets/lib/bower_components/bootstrap/dist/js/bootstrap.min.js' )
    .addEntry('js/fancybox-init', './assets/js/fancybox-init.js' )
    .addEntry('js/gpx-map', './assets/js/gpx-map.js' )

    .addEntry('logo', './assets/img/logo.png')

    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
     .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
