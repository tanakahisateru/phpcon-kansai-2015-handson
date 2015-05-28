gulp       = require 'gulp'
coffee     = require 'gulp-coffee'
less       = require 'gulp-less'
sourcemaps = require 'gulp-sourcemaps'

# compile coffeescript files
gulp.task 'compile-coffee', () ->
  gulp.src 'public/js/*.coffee'
  .pipe sourcemaps.init()
  .pipe coffee()
  .pipe sourcemaps.write('.')
  .pipe gulp.dest('public/js')

# compile less file
gulp.task 'compile-less', () ->
  gulp.src 'public/css/*.less'
  .pipe less()
  .pipe gulp.dest('public/css')

gulp.task 'default', ['compile-coffee', 'compile-less']