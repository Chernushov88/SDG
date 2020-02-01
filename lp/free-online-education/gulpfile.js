var gulp = require('gulp'),
    jshint = require('gulp-jshint'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    babel = require('gulp-babel'),
    minifyCSS = require('gulp-minify-css'),
    sass = require('gulp-sass'),
    htmlmin = require('gulp-htmlmin'),
    livereload = require('gulp-livereload'),
    clean = require('gulp-clean'),
    autoprefixer = require('gulp-autoprefixer');




// Проверка ошибок в скриптах
gulp.task('lint', function() {
    return gulp.src(['js/*.js', '!js/*.min.js', '!js/*jquery*', '!js/*bootstrap*'])
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});


// Конкатенация и минификация стилей
// При указании исходников в gulp.src учитывается порядок в котором они указаны,
// то есть первыми в итоговом файле будут стили бустрапа, потому что мы должны
// вначале объявить их, чтобы потому переопределить на свои стили 
// То же самое касается скриптов - мы вначале объявляем зависимости и уже потом 
// подключаем наши скрипты (например первым будет всегда jquery, если он используется
// в проекте, а уже следом все остальные скрипты)
gulp.task('compile-sass', function() {
    return gulp.src([
            './scss/*.scss'
        ])
        .pipe(sass())
        .pipe(gulp.dest('./css/'))
})

gulp.task('minify-css', function() {
    return gulp.src([
            './css/*.css'
        ])
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(concat('style.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('./css'))
        .pipe(livereload())
})


gulp.task('minifyhtml', function() {
    return gulp.src(['./*.html'])
        .pipe(htmlmin({ collapseWhitespace: true }))
        .pipe(gulp.dest('./'));
});
// Конкатенация и минификация скриптов
// Тут выделяются два контекста - jquery-плагины / наши скрипты и зависимости (то без чего 
// не будет работать хотя бы один наш скрипт, например jquery)
// Так как это просто пример, то лучшим вариантом было бы разделение на основные и 
// вспомогательные скрипты (например основные - jquery/bootstrap и вспомогательные - lightbox/fotorama) 
// gulp.task('minify-main-js', function() {
//     return gulp.src(["./assets/js/common.js"])
//         .pipe(babel({
//             presets: ['env']
//         }))
//         .pipe(uglify())
//         .pipe(concat('common.min.js'))
//         .pipe(gulp.dest('./assets/js/'));
// });

// gulp.task('scripts', function(cd) {
//     var jsDeps = gulp.src(["./assets/js/jquery.min.js", "./assets/js/bootstrap.min.js", "./assets/js/common.min.js", "./assets/js/jquery.mask.min.js", "./assets/js/imagesloaded.pkgd.min.js", "./assets/js/libs.min.js"])
//         .pipe(concat('main.js'))
//         .pipe(gulp.dest('./build/js'));
//     cd();
// });

// Сжатие изображений (кэшируем, чтобы сжимать только изменившиеся изображения)
// optimizationLevel - это количество проходов, диапазон параметра 0-7 и начиная с 1 включается компрессия
// gulp.task('images', function() {
//     return gulp.src(['images/*', '!images/*.db'])
//         .pipe(cache(imagemin({
//             optimizationLevel: 5,
//             progressive: true,
//             interlaced: true
//         })))
//         .pipe(size({
//             title: 'size of images'
//         }))
//         .pipe(gulp.dest('production/images'));
// });

// Чистим директорию назначения и делаем ребилд, чтобы удаленные из проекта файлы не остались
gulp.task('clean', function() {
    return gulp.src(['./css/style.css'], { read: false, allowEmpty: true })
        .pipe(clean());
});
gulp.task('clean-old', function() {
    return gulp.src(['./css/style.min.css'], { read: false, allowEmpty: true })
        .pipe(clean());
});

// Наблюдение за изменениями и автосборка
// После первого запуска (команда gulp в консоли) выполняем gulp watch,
// чтобы следитть за изменениями и автоматически пересобирать исходники с учетом 
// последних изменений
function watchFiles() {
    // gulp.watch('./js/*.js', gulp.series(['lint', 'scripts']));
    gulp.watch('./scss/*.scss', gulp.series(['clean-old', 'compile-sass', 'minify-css', 'clean']));
    // gulp.watch('images/*', ['images']);
};

// Выполняем по-умолчанию (вначале очистка и ребилд директории назначения, а потом выполнение остальных задач)
// const build = gulp.series('compile-less', 'minify-css', 'minifyhtml', 'minify-main-js', 'scripts');
const build = gulp.series('compile-sass', 'minify-css', 'minifyhtml');
const watch = gulp.parallel(watchFiles, );


exports.build = build;
exports.watch = watch;