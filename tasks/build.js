module.exports = function (gulp, plugins, config) {
	gulp.task( 'build', () =>
		gulp.src( ['./*', '!./_source', '!./node_modules', '!tasks', '!config.json', '!gulpfile.js', '!package-lock.json', '!package.json'] )
			.pipe(plugins.zip(config.themmeName + '.zip'))
			.pipe(gulp.dest(config.buildDestFolder))
	);
};
