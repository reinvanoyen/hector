var
	gulp = require('gulp'),
	sass = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	minifycss = require('gulp-minify-css'),
	watch = require('gulp-watch'),
	plumber = require('gulp-plumber'),
	del = require( 'del' ),
	path = require('path'),
	source = require('vinyl-source-stream'),
	uglify = require('gulp-uglify'),
	buffer = require('vinyl-buffer')
;

gulp.task( 'styles', function()
{
	del( [
		'style/*.css'
	] );

	return gulp.src( 'style/sass/**/*.scss' )
		.pipe( plumber() )
		.pipe( sass() )
		.pipe( autoprefixer( 'last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1' ) )
		.pipe( minifycss() )
		.pipe( gulp.dest( 'style' ) )
	;
} );

gulp.task( 'watch', function()
{
	watch( 'style/sass/**/*.scss', function()
	{
		gulp.start( 'styles' );
	} );
} );

gulp.task( 'default', [ 'styles', 'watch' ] );