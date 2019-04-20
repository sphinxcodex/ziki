'use strict';

// fetch command line arguments
const arg = (argList => {
  let arg = {},
    a,
    opt,
    thisOpt,
    curOpt;
  for (a = 0; a < argList.length; a++) {
    thisOpt = argList[a].trim();
    opt = thisOpt.replace(/^\-+/, '');

    if (opt === thisOpt) {
      // argument value
      if (curOpt) arg[curOpt] = opt;
      curOpt = null;
    } else {
      // argument name
      curOpt = opt;
      arg[curOpt] = true;
    }
  }

  return arg;
})(process.argv);

// Gulp Config
const devBuild =
    (process.env.NODE_ENV || 'development').trim().toLowerCase() ===
    'development',
  dir = {
    templates: 'resources/themes/ghost/templates/**/*.html',
    src: {
      ghost: 'resources/themes/ghost/assets/'
      // other themes' paths get added here
    }
  },
  // Node Modules
  gulp = require('gulp'),
  noop = require('gulp-noop'),
  newer = require('gulp-newer'),
  imagemin = require('gulp-imagemin'),
  cache = require('gulp-cache'),
  cleancss = require('gulp-clean-css'),
  concat = require('gulp-concat-css'),
  autoprefixer = require('autoprefixer'),
  postcss = require('gulp-postcss'),
  assets = require('postcss-assets'),
  mqpacker = require('css-mqpacker'),
  cssnano = require('cssnano'),
  php = require('gulp-connect-php'),
  sourcemaps = devBuild ? require('gulp-sourcemaps') : null,
  browsersync = devBuild ? require('browser-sync').create() : null;

// Optimize Images
const imgConfig = {
  // original images reside in "img/" subfolder
  src: dir.src[arg.theme] + 'img/**/*',
  // processed images do not
  build: dir.src[arg.theme]
};
const optimizeImages = () => {
  return gulp
    .src(imgConfig.src)
    .pipe(newer(imgConfig.build))
    .pipe(cache(imagemin({ optimizationLevel: 5 })))
    .pipe(gulp.dest(imgConfig.build));
};

// Watch html not working on phpserver
const overwatch = () => {
  return gulp.src(dir.templates).pipe(browsersync.stream());
};
// Combine css files into one main css file
const cssConfig = {
  // each page's stylesheet resides in "css/" subfolder
  src: dir.src[arg.theme] + 'css/**/*',
  // main.css does not
  build: dir.src[arg.theme]
};
const processCSS = () => {
  var postCssOpts = [
    assets({ loadPaths: [dir.src + 'images/'] }),
    autoprefixer({ browsers: ['last 2 versions', '> 2%'] }),
    mqpacker
  ];

  if (!devBuild) {
    postCssOpts.push(cssnano);
  }

  return gulp
    .src(cssConfig.src)
    .pipe(sourcemaps ? sourcemaps.init() : noop())
    .pipe(cleancss())
    .pipe(postcss(postCssOpts))
    .pipe(concat('main.css'))
    .pipe(sourcemaps ? sourcemaps.write() : noop())
    .pipe(gulp.dest(cssConfig.build))
    .pipe(browsersync.stream());
};

// BrowserSync Config
const syncConfig = {
  server: {
    proxy: 'localhost:8000',
    port: 9000,
    baseDir: './',
    open: true,
    notify: false
  }
};

function reload(done) {
  browsersync.reload();
  done();
}

// Tasks
const phpserver = () => {
  return php.server({ port: 8000, keepalive: true });
};

const build = gulp.series(optimizeImages, processCSS);

// const servephp = () => gulp.parallel(phpserver, serve);

gulp.task('server', phpserver);

// Watch for changes
const watchFiles = () => {
  return (
    gulp.watch(dir.templates, gulp.series(overwatch, reload)),
    gulp.watch(imgConfig.src, gulp.series(optimizeImages, reload)),
    gulp.watch(cssConfig.src, gulp.series(processCSS, reload))
  );
};
const serve = () => browsersync.init(syncConfig);
// Run tasks manually
gulp.task('devstart', build);

// Run and let it watch for changes
gulp.task('default', gulp.parallel(watchFiles, gulp.series(phpserver, serve)));
