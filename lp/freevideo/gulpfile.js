var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var concatCss = require('gulp-concat-css');
var cleanCSS = require('gulp-clean-css');
var rename = require("gulp-rename");
var uglify = require('gulp-uglify');

gulp.task('serve', ['sass'], function() {
    browserSync.init({
        server: ""
    })
    gulp.watch("sass/*.scss", ['sass']).on('change', browserSync.reload);
    gulp.watch("views/*.jade").on('change', browserSync.reload);
});
gulp.task('sass', function() {
    return gulp.src("sass/*.scss")
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(concatCss("style.css"))
        .pipe(gulp.dest("css"))
        .pipe(browserSync.stream());
});
gulp.task('mincss', function() {
    return gulp.src("css/*.css")
        .pipe(rename({ suffix: ".min" }))
        .pipe(cleanCSS())
        .pipe(gulp.dest("css"));
})

gulp.task('minjs', function() {
    return gulp.src("js/*.js")
        .pipe(rename({ suffix: ".min" }))
        .pipe(uglify())
        .pipe(gulp.dest("js"));
})

gulp.task('min', ['mincss', 'minjs']);
gulp.task('default', ['serve']);