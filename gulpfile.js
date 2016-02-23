

/*==========  Require Modules  ==========*/


	var gulp 			= require('gulp'),
		less 			= require('gulp-less'),
		sync 			= require('browser-sync').create(),
		path 			= require('path'),
		concat 			= require('gulp-concat'),	
		minify			= require('gulp-minify-css'),
		uglify 			= require('gulp-uglify'),
		autoprefixer	= require('gulp-autoprefixer'),
		svgmin			= require('gulp-svgmin');


/*==========  Compile all LESS files  ==========*/


	gulp.task('less', function() {
		return gulp.src('style.less')
			.pipe(less())
			.pipe(concat('style.css'))
			.pipe(minify())
			.pipe(autoprefixer({
				browsers: ['last 2 versions'],
				cascade: false
			}))
			.pipe(gulp.dest('css'))
			.pipe(sync.reload({stream:true}));
	});


/*==========  Prettify SVG's  ==========*/


	gulp.task('svgmin', function() {
		return gulp.src('images/svg/*')
			.pipe(svgmin({
				plugins: [{
					cleanupIDs: false
				}],
				js2svg: {
					pretty: true
				}
			}))
			.pipe(gulp.dest('images/svg'))
	});


/*==========  Concatenate and Minify all JS  ==========*/


	gulp.task('scripts', function() {
		return gulp.src('js/*.js')
			.pipe(uglify())
			.pipe(concat('site.js'))
			.pipe(gulp.dest('js/min'))
	});


/*==========  Browser Sync  ==========*/


	gulp.task('browser', function() {
		var files = [
			'**/*.php',
			'js/*.js',
			'images/*'
		];
		sync.init(files, {
			proxy: "localhost/tinypress"
		});
	});


/*==========  Watch for changes to compiled CSS file  ==========*/


	gulp.task('watch', function () {
		gulp.watch('css/**/*.less', ['less']);
		gulp.watch('style.less', ['less']);
		gulp.watch('js/*.js', ['scripts']);
		gulp.watch('images/svg/*.svg', ['svgmin']);
	});


/*==========  Default Task  ==========*/


	gulp.task('default', ['less', 'watch', 'browser']);