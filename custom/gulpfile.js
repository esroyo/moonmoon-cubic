// Include gulp, plugins
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    cssmin = require('gulp-minify-css'),
    jshint = require('gulp-jshint');

//lint
gulp.task('lint', function() {
    return gulp.src('js/cubic.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// js files
gulp.task('scripts', function() {
    return gulp.src([
            'js/foundation/foundation.js',
            'js/foundation/foundation.*.js',
            'js/cubic.src.js'
        ]).pipe(concat('cubic.js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('js'));
});

// css files
gulp.task('cssmin', function() {
    return gulp.src([
            'style/foundation/normalize.css',
            'style/foundation/foundation.css',
            'style/fontello/fontello.css',
            'style/fontello/animation.css',
            'style/cubic.src.css'
        ]).pipe(concat('cubic.css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssmin())
        .pipe(gulp.dest('style'));
});

// Default Task
gulp.task('default', ['lint', 'scripts', 'cssmin']);
