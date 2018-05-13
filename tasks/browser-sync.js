module.exports = function (gulp, plugins, config) {
    plugins.browserSync = require('browser-sync').create();

    gulp.task('browser-sync', function() {
        plugins.browserSync.init({
            proxy: "http://localhost/netcase/wordpress",
			notify: false
        });

        gulp.watch(config.stylusSrcFolder + "/**/*.styl", ['stylus']);
        gulp.watch(["./_public/**/*.php","./_public/*.php"]).on("change", plugins.browserSync.reload);
    });
};
