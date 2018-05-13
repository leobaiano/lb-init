module.exports = function (gulp, plugins, config) {
	plugins.browserSync = require('browser-sync').create();
	const reload = plugins.browserSync.reload;

	gulp.task('js-compile', function() {
		return gulp.src(config.jsSrcFolder + '/**/*.js')
			.pipe(plugins.sourcemaps.init())
			.pipe(plugins.uglify()) //minifica
			.pipe(plugins.sourcemaps.write()) //escreve o sourcemaps
			.pipe(gulp.dest(config.jsDestFolder)) //envia para _public/js
			.pipe(plugins.browserSync.reload({stream: true}));
	});
};
