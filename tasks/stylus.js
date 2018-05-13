module.exports = function (gulp, plugins, config) {
	const jeet = require('jeet'),
		koutoSwiss = require('kouto-swiss'),
        rupture = require('rupture'),
        nib = require('nib'),
		prefixer = require('autoprefixer-stylus');

        plugins.browserSync = require('browser-sync').create();

        gulp.task('stylus', function(){
            gulp.src(config.stylusSrcFolder + '/main.styl')
                .pipe(plugins.plumber())
                .pipe(plugins.stylus({
                    use: [prefixer(), jeet(), koutoSwiss(), nib(), rupture()],
                    compress: true
                }))
                .pipe(gulp.dest(config.stylusSrcFolder))
                .pipe(plugins.rename('styles.css'))
                .pipe(gulp.dest(config.stylusDestFolder))
                .pipe(plugins.browserSync.reload({stream: true}));
        });
};
