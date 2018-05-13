module.exports = function (gulp, plugins, config) {
	// Watch Task
	gulp.task('watch', function () {
		//Builds CSS
		plugins.watch(config.stylusSrcFolder + '/**/*.styl', function () {
			gulp.start('stylus');
		});

		//Build JS
		plugins.watch(config.jsSrcFolder + '/**/*.js', function () {
			gulp.start('js-compile');
		});

		//Build IMG
		plugins.watch(config.imgSrcFolder + '/**/*.{jpg,png,gif}', function () {
			gulp.start('imagemin');
		});
	});
};
