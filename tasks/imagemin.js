module.exports = function (gulp, plugins, config) {
	plugins.browserSync = require('browser-sync').create();

	gulp.task('imagemin', function() {
		return gulp.src(config.imgSrcFolder + "/**/*.{jpg,png,gif}")
			.pipe(plugins.plumber())
    		.pipe(plugins.imagemin({ optimizationLevel: 5, progressive: true, interlaced: true }))
    		.pipe(gulp.dest(config.imgDestFolder))
            .pipe(plugins.browserSync.reload({stream: true}));
    });
};
