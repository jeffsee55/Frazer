'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
// Include Our Plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

gulp.task('sass', function () {
  return gulp.src('./assets/sass/main.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('sass:watch', function () {
  gulp.watch('./assets/sass/**/*.scss', ['sass']);
  gulp.watch('./assets/sass/**/*.sass', ['sass']);
  gulp.watch('./assets/sass/*.scss', ['sass']);
  gulp.watch('./assets/sass/*.sass', ['sass']);
});

gulp.task('scripts', function() {
    return gulp.src('./assets/js/*.js')
        .pipe(concat('all.js'))
        .pipe(gulp.dest('./dist/js'))
        .pipe(rename('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('.dist/js'));
});
