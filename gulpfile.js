var gulp = require('gulp'),
  settings = require('./settings'),
  webpack = require('webpack'),
  browserSync = require('browser-sync').create(),
  postcss = require('gulp-postcss'),
  rename = require('gulp-rename'),
  rgba = require('postcss-hexrgba'),
  cssnano = require('cssnano'),
  autoprefixer = require('gulp-autoprefixer'),
  sass = require('gulp-sass'),
  cssImport = require('postcss-import'),
  colorFunctions = require('postcss-color-function');

var stylePostCss = [cssImport, rgba, colorFunctions];
if (settings.developmentMode === 'production') {
  stylePostCss.push(cssnano);
}

gulp.task('styles', function () {
  return gulp.src('css/main.scss')
    .pipe(sass({ includePaths: ['node_modules'] }))
    .pipe(postcss(stylePostCss))
    .pipe(autoprefixer({
      cascade: false
    }))
    .pipe(rename('style.css'))
    .pipe(gulp.dest('./'))

    .on('error', (error) => console.log(error.toString()));
});

gulp.task('scripts', function (callback) {

  webpack(require('./webpack.config.js'), function (err, stats) {

    if (err) {
      console.log(err.toString());
    }
    console.log(stats.toString());
    callback();
  });
});

gulp.task('watch', function () {
  browserSync.init({
    notify: false,
    proxy: settings.urlToPreview,
    ghostMode: false
  });

  gulp.watch(['./**/*.php', './*.php' ], function () {

    browserSync.reload();
  });
  gulp.watch('css/*.scss', gulp.parallel('waitForStyles'));
  gulp.watch(['js/*.js', 'js/index.js'], gulp.parallel('waitForScripts'));
});

gulp.task('waitForStyles', gulp.series('styles', function () {
  return gulp.src('style.css')
    .pipe(browserSync.stream());
}))

gulp.task('waitForScripts', gulp.series('scripts', function (cb) {
  browserSync.reload();
  cb()
}))