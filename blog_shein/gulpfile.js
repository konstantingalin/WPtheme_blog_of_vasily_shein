var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    browserSync  = require('browser-sync'),
    concat       = require('gulp-concat'),
    uglify       = require('gulp-uglifyjs'),
    cssnano      = require('gulp-cssnano'),
    rename       = require('gulp-rename'),
    del          = require('del'),
    imagemin     = require('gulp-imagemin'),
    pngquant     = require('imagemin-pngquant'),
    cache        = require('gulp-cache'),
    autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function(){
    return gulp.src('app/sass/**/*.sass')
    .pipe(sass())
    .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], {cascade:true}))
    .pipe(gulp.dest('.'))
});

gulp.task('scripts', function(){
    return gulp.src([
        'app/libs/jquery/dist/jquery.js',
        'app/libs/magnific-popup/dist/jquery.magnific-popup.js',
        'app/libs/jQuery.mmenu/dist/jquery.mmenu.all.js',
				"app/libs/owl.carousel/dist/owl.carousel.min.js",
				"app/libs/fotorama/fotorama.js",
				"app/libs/selectize/dist/js/standalone/selectize.min.js"
    ])
    .pipe(concat('libs.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('assets/js'));
});

gulp.task('css-libs', gulp.parallel('sass', function(){
    return gulp.src('app/css/libs.css')
    .pipe(concat('libs.css'))
    .pipe(cssnano())
    .pipe(rename({suffix:'.min'}))
    .pipe(gulp.dest('assets/css'));
}));

gulp.task('browser-sync', function(){
    browserSync({
        server: {
            baseDir: 'app'
        },
        notify: false
    })
});

gulp.task('clean', function(start){
    del.sync('dist');
    start();
});

gulp.task('clear', function(start){
    cache.clearAll();
    start();
});

gulp.task('img', function(){
    return gulp.src('app/images/**/*')
    .pipe(cache(imagemin({
        interlaced: true,
        progressive: true,
        svgoPlugins: [{removeViewBox: false}],
        use: [pngquant()]
    })))
    .pipe(gulp.dest('assets/images'));
});

gulp.task('watch', gulp.parallel('css-libs', 'scripts', 'img', function(){
    gulp.watch('app/sass/**/*.sass', gulp.series('sass'));
}));

gulp.task('build', gulp.parallel('clean', 'img', 'sass', 'scripts', function(start){
    var builCss = gulp.src([
        'app/css/main.css',
        'app/css/libs.min.css',
    ])
    .pipe(gulp.dest('dist/css'));

    var builFonts = gulp.src('app/fonts/**/*')
    .pipe(gulp.dest('dist/fonts'));

    var builJs = gulp.src('app/js/**/*')
    .pipe(gulp.dest('dist/js'));

    var builHtml = gulp.src('app/*.html')
    .pipe(gulp.dest('dist'));
    
    start();
}));