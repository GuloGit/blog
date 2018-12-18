var gulp = require('gulp'),
    less = require('gulp-less'),
    ap = require('gulp-autoprefixer'),
    csso = require('gulp-clean-css');

gulp.task('css-dev', function () {
    return gulp.src('./resources/less/main.less')
        .pipe(less())
        .pipe(gulp.dest('./public/css/'));
});
gulp.task('css-prod', function () {
    return gulp.src('./resources/less/main.less')
        .pipe(less())
        .pipe(ap({
            browsers: ['last 7 versions']
        }))
        .pipe(csso({
            level:2
        }))
        .pipe(gulp.dest('./public/css/'));
});

gulp.task('watch', function () {
    gulp.watch('./resources/less/**/*.less', gulp.series('css-dev'));
});

gulp.task('default', gulp.series('css-dev', 'watch'));