const gulp = require('gulp');
const less = require('gulp-less');

const watch = require('gulp-watch');

const config = require('./Config');

function buildLess(cb) {
  gulp.src('./less/*.less')
    .pipe(less())
    .pipe(gulp.dest(config.pathExportCss))
  ;
  cb() ;
};

function watchLess() {
  const watcher = gulp.watch(['./less/*.less'], buildLess);

  watcher.on('change', function(path, stats) {
    console.log(`File ${path} was changed`);
  });

  watcher.on('add', function(path, stats) {
    console.log(`File ${path} was added`);
  });

  watcher.on('unlink', function(path, stats) {
    console.log(`File ${path} was removed`);
  });
}
exports.default = gulp.series(buildLess, watchLess);