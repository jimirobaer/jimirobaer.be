/**
 * Paths to project folders
 */

var paths = {
	input: 'src/',
	output: 'dist/',
	scripts: {
		input: 'src/js/*',
		polyfills: '.polyfill.js',
		output: 'dist/js/'
	},
	styles: {
		input: 'src/css/**/*.{scss,sass,css}',
		output: 'dist/css/'
	},
	svgs: {
		input: 'src/svg/*.svg',
		output: 'dist/svg/'
	},
	copy: {
		input: 'src/assets/**/*',
		output: 'dist/'
	},
	watch: './dist/'
};

/**
 * Template for banner to add to file headers
 */

var banner = {
	main:
		'/*!' +
		' <%= package.name %> v<%= package.version %>' +
		' | (c) ' + new Date().getFullYear() + ' <%= package.author.name %>' +
		' */\n'
};


/**
 * Gulp Packages
 */

// Gulp

var {gulp, src, dest, watch, series, parallel} = require('gulp');
var package = require('./package.json');

// Plugins

var $ = {

	del: require('del'),
	flatmap: require('gulp-flatmap'),
	lazypipe: require('lazypipe'),
	rename: require('gulp-rename'),
	header: require('gulp-header'),
	util: require('gulp-util'),
	clipEmptyFiles: require('gulp-clip-empty-files'),

	// JS
	jsHint: require('gulp-jsHint'),
	stylish: require('jsHint-stylish'),
	concat: require('gulp-concat'),
	uglify: require('gulp-terser'),
	//optimizejs: require('gulp-optimize-js'),

	// CSS
	sass: require('gulp-sass'),
	postcss: require('gulp-postcss'),
	prefix: require('autoprefixer'),
	minify: require('cssnano'),
	// combinemq: require('gulp-combine-mq'),
	groupmq: require('gulp-group-css-media-queries'),
	sassglob: require('gulp-sass-glob'),
	sourcemaps: require('gulp-sourcemaps'),
	babel: require('gulp-babel'),

	// Others
	svgmin: require('gulp-svgmin'),
	browserSync: require('browser-sync')

}

/**
 * Settings
 * Turn on/off build features
 */

var config = {
	clean: true,
	scripts: true,
	polyfills: false,
	styles: true,
	svgs: true,
	copy: true,
	reload: true,
	url: 'client.local'
};

/**
 * Gulp Tasks
 */

// Remove pre-existing content from output folders
var cleanDist = function (done) {

	// Make sure this feature is activated before running
	if (!config.clean) return done();

	// Clean the dist folder
	$.del.sync([
		paths.output
	]);

	// Signal completion
	return done();

};

// Repeated JavaScript tasks
var jsTasks = $.lazypipe()

	// Generate *.js
	.pipe($.header, banner.main, {package: package})
	// .pipe($.babel, {presets: ['@babel/env']})
	//.pipe($.optimizejs)
	.pipe(dest, paths.scripts.output);

var jsMinTasks = $.lazypipe()

	// Generate *.min.js (Production)
	.pipe($.rename, {suffix: '.min'})
	.pipe($.babel, {presets: ['@babel/env']})
	.pipe($.uglify)
	//.pipe($.optimizejs)
	.pipe($.header, banner.main, {package: package})
	.pipe(dest, paths.scripts.output);

// Lint, minify, and concatenate scripts
var buildScripts = function (done) {

	// Make sure this feature is activated before running
	if (!config.scripts) return done();

	// Run tasks on script files
	return src(paths.scripts.input)
		.pipe($.flatmap(function(stream, file) {

			// If the file is a directory
			if (file.isDirectory()) {

				// Setup a suffix variable
				var suffix = '';

				// If separate polyfill files enabled
				if (config.polyfills) {

					// Update the suffix
					suffix = '.polyfills';

					// Grab files that aren't polyfills, concatenate them, and process them
					src([file.path + '/*.js', '!' + file.path + '/*' + paths.scripts.polyfills])
						.pipe($.concat(file.relative + '.js'))
						.pipe(!$.util.env.production ? jsTasks() : jsMinTasks())

				}

				// Grab all files and concatenate them
				// If separate polyfills enabled, this will have .polyfills in the filename
				src(file.path + '/*.js')
					.pipe($.concat(file.relative + suffix + '.js'))
					.pipe(!$.util.env.production ? jsTasks() : jsMinTasks())

				return stream;

			}

			// Otherwise, process the file
			//return stream.pipe(jsTasks());
			return stream.pipe(!$.util.env.production ? jsTasks() : jsMinTasks())

		}));

};

// Lint scripts
var lintScripts = function (done) {

	// Make sure this feature is activated before running
	if (!config.scripts) return done();

	// Lint scripts
	return src(paths.scripts.input)
		.pipe($.jsHint())
		.pipe($.jsHint.reporter('jsHint-stylish'));

};

// Process, lint, and minify Sass files
var buildStyles = function (done) {

	// Make sure this feature is activated before running
	if (!config.styles) return done();

	// Run tasks on all Sass files
	return src(paths.styles.input)

		// Generate main.css
		.pipe($.clipEmptyFiles())
		.pipe(!$.util.env.production ? $.sourcemaps.init() : $.util.noop())
		.pipe($.sassglob())
		.pipe(!$.util.env.production ? $.sass.sync({outputStyle: 'expanded', sourceComments: true}).on('error', $.sass.logError) : $.util.noop())
		.pipe($.util.env.production ? $.sass.sync() : $.util.noop())
		.pipe($.postcss([
			$.prefix({
				cascade: true,
				remove: true
			})
		]))
		.pipe(!$.util.env.production ? $.sourcemaps.write() : $.util.noop())
		.pipe($.util.env.production ? $.groupmq() : $.util.noop())
		.pipe($.util.env.production ? $.header(banner.main, {package: package}) : $.util.noop())
		.pipe(dest(paths.styles.output))
		
		// Generate main.min.css (Production)
		.pipe($.util.env.production ? $.rename({suffix: '.min'}) : $.util.noop())
		.pipe($.util.env.production ? $.postcss([
			$.minify({
				discardComments: {
					removeAll: true
				}
			})]) : $.util.noop())
		.pipe($.util.env.production ? dest(paths.styles.output) : $.util.noop())

};

// Optimize SVG files
var buildSVGs = function (done) {

	// Make sure this feature is activated before running
	if (!config.svgs) return done();

	// Optimize SVG files
	return src(paths.svgs.input)
		.pipe($.svgmin())
		.pipe(dest(paths.svgs.output));

};

// Copy static files into output folder
var copyFiles = function (done) {

	// Make sure this feature is activated before running
	if (!config.copy) return done();

	// Copy static files
	return src(paths.copy.input)
		.pipe(dest(paths.copy.output));

};

// Watch for changes to the src directory
var startServer = function (done) {

	// Make sure this feature is activated before running
	if (!config.reload) return done();

	// Initialize BrowserSync
	$.browserSync.init({
		proxy: {
			target: config.url,
		},
		ghostMode: {
			scroll: false
		},
		files: paths.watch,
		notify: false,
		open: false
	});

	// Signal completion
	done();

};

// Reload the browser when files change
var reloadBrowser = function (done) {
	// if (!config.reload) return done();
	// $.browserSync.reload();
	done();
};

// Watch for changes
var watchSource = function (done) {
	watch(paths.input, series(exports.default, reloadBrowser));
	done();
};


/**
 * Export Tasks
 */

// Default task
// gulp
exports.default = series(
	cleanDist,
	parallel(
		buildScripts,
		lintScripts,
		buildStyles,
		buildSVGs,
		copyFiles
	)
);

// Watch and reload
// gulp watch
exports.watch = series(
	exports.default,
	// startServer,
	watchSource
);
