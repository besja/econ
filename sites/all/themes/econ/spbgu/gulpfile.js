var gulp = require('gulp'),
    browserSync = require('browser-sync').create(),
    stylus = require('gulp-stylus'),
    sourcemaps = require('gulp-sourcemaps'),
    prefix = require('gulp-autoprefixer'),
    _plumber = require('gulp-plumber'),
    fileinclude = require('gulp-file-include'),
    cssmin = require('gulp-cssmin'),
    filter = require('gulp-filter'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    svgmin = require('gulp-svgmin'),
    gutil = require('gulp-util'),
    rupture = require('rupture'),
    del = require('del');
function plumber() {
  return _plumber({
    errorHandler: function (err) {
      gutil.beep();
      console.log(err);
    }
  });
}


// Static server

gulp.task('watch', ['css'], function() {
    browserSync.init({
      server: {
          baseDir: "./app/"
        }
      });
    gulp.watch("static-src/css/**/*.styl", ['css']);
    gulp.watch("static-src/svg/**/*.svg", ['svg']);
    gulp.watch("static-src/html/**/*.html", ['html']);
    gulp.watch("app/js/**/*.js", ['html']);
});


gulp.task('clean', function (cb) {
  del(['./app/css'], cb);
});

gulp.task('html', function() {
  gulp.src(['./static-src/html/*.html'])
    .pipe(fileinclude({
      prefix: '@@',
      basepath: './'
    }))
    .pipe(gulp.dest('./app/'))
    browserSync.reload("*.html")
});

gulp.task('css', function() {
  var filterStylus = filter('**/*.styl');
  return gulp.src([
      './static-src/vendor/**/*.css',
      './static-src/css/main.styl'
    ])
    .pipe(plumber())
    .pipe(filterStylus)
    .pipe(stylus({
      use: rupture(),
      sourcemap: {
        inline: true,
        sourceRoot: '.',
        basePath: './static-src/css'
      }
    }))
    .pipe(sourcemaps.init({
      loadMaps: true
    }))
    .pipe(prefix('last 2 version'))
    .pipe(concat('main.css'))
    .pipe(sourcemaps.write('./', {sourceRoot: '.' }))
    .pipe(filterStylus.restore())
    .pipe(gulp.dest('./app/css'))
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('./app/css'))
    .pipe(browserSync.stream());
});   


gulp.task('svg', function() {
  return gulp.src('static-src/svg/**/*.svg')
    .pipe(svgmin({plugins: [{cleanpIDs: false}, {moveGroupAttrsToElems: false}]}))
    .pipe(gulp.dest('./app/img'))
    gulp.run("html");
});


gulp.task('default', function () {
  gulp.run("svg");
  gulp.run("html");
  gulp.run("css");
});

