const gulp = require('gulp');
const babel = require('gulp-babel');
const cleanCss = require('gulp-clean-css');
const uglify = require('gulp-uglify');

gulp.task('minifyCss', ()=> {
    return gulp.src('./src/css/*.css')
               .pipe(cleanCss({debug: true}, (details) => {
                console.log(`${details.name}: ${details.stats.originalSize}`);
                console.log(`${details.name}: ${details.stats.minifiedSize}`);
              }))
              .pipe(gulp.dest('./assets/css'));
});
// transmin => transpile and minify javascript
gulp.task('transmin', ()=>{
    return gulp.src('./src/js/*.js')
               .pipe(babel({
                presets: ['env']
                }))
               .pipe(uglify())
               .pipe(gulp.dest('./assets/js'))
});

gulp.task('watch', ()=>{
    gulp.watch('./src/css/*.css', ['minifyCss']);
    gulp.watch('./src/js/*.js', ['transmin']);
});

