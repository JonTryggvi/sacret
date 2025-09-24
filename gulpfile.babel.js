'use strict';
import yargs from 'yargs';
import { hideBin } from 'yargs/helpers';
import browser from 'browser-sync';
// let browser = bs.create();
import gulp from 'gulp';
import { rimraf } from 'rimraf';
import yaml from 'js-yaml';
import fs from 'fs';
import dateFormat from 'dateformat';
import webpackStream from 'webpack-stream';
import webpack2 from 'webpack';
import named from 'vinyl-named';
import log from 'fancy-log';
import colors from 'ansi-colors';
import merge from 'merge-stream';
import autoprefixer from 'gulp-autoprefixer';
import dartScss from 'gulp-dart-scss';
import sourcemaps from 'gulp-sourcemaps';
import gulpIf from 'gulp-if';
import rev from 'gulp-rev';
import gulpUglify from 'gulp-uglify';
import gulpPhpcs from 'gulp-phpcs';
import gulpPhpcbf from 'gulp-phpcbf';

const argv = yargs(hideBin(process.argv)).argv;

// Check for --production flag
const PRODUCTION = !!(argv.production);

// Check for --development flag unminified with sourcemaps
const DEV = !!(argv.dev);

const WevPackEnv = PRODUCTION ? 'production' : 'development';

// Load settings from settings.yml
const { BROWSERSYNC, COMPATIBILITY, REVISIONING, PATHS } = loadConfig();

const dynamicImport = modulePath => Function('modulePath', 'return import(modulePath);')(modulePath);

// Check if file exists synchronously
function checkFileExists(filepath) {
  let flag = true;
  try {
    fs.accessSync(filepath, fs.F_OK);
  } catch (e) {
    flag = false;
  }
  return flag;
}

// Load default or custom YML config file
function loadConfig() {
  log('Loading config file...');

  if (checkFileExists('config.yml')) {
    // config.yml exists, load it
    log(colors.bold(colors.cyan('config.yml')), 'exists, loading', colors.bold(colors.cyan('config.yml')));
    let ymlFile = fs.readFileSync('config.yml', 'utf8');
    return yaml.load(ymlFile);

  } else if (checkFileExists('config-default.yml')) {
    // config-default.yml exists, load it
    log(colors.bold(colors.cyan('config.yml')), 'does not exist, loading', colors.bold(colors.cyan('config-default.yml')));
    let ymlFile = fs.readFileSync('config-default.yml', 'utf8');
    return yaml.load(ymlFile);

  } else {
    // Exit if config.yml & config-default.yml do not exist
    log('Exiting process, no config file exists.');
    log('Error Code:', err.code);
    process.exit(1);
  }
}

// Delete the "dist" folder
// This happens every time a build starts
function clean() {
  return rimraf(PATHS.dist);
}

// Copy files out of the assets folder
// This task skips over the "images", "js", and "scss" folders, which are parsed separately
function copy() {
  return gulp.src(PATHS.assets)
    .pipe(gulp.dest(PATHS.dist + '/assets'));
}

// Compile Sass into CSS
// In production, the CSS is compressed
function sass() {
  let tasks = PATHS.entries_sass.map(url => {
    return gulp.src(url)
      .pipe(sourcemaps.init())
      .pipe(dartScss({
        includePaths: PATHS.sass
      })
      .on('error', err => console.log(err)))
      .pipe(autoprefixer({
        overrideBrowserslist: COMPATIBILITY
      }))
      // .pipe(gulpIf(PRODUCTION, cleanCss({ compatibility: 'ie9' })))
      .pipe(gulpIf(!PRODUCTION, sourcemaps.write('.')))
      .pipe(gulpIf(REVISIONING && PRODUCTION || REVISIONING && DEV, rev()))
      .pipe(gulp.dest(PATHS.dist + '/css'))
      .pipe(gulpIf(REVISIONING && PRODUCTION || REVISIONING && DEV, rev.manifest()))
      .pipe(gulp.dest(PATHS.dist + '/css'))
      .pipe(browser.stream());
  });
  return merge(tasks);
}

// Combine JavaScript into one file
// In production, the file is minified
const webpack = {
  config: {
    mode: WevPackEnv,
    module: {
      rules: [
        {
          test: /.js$/,
          loader: 'babel-loader',
          exclude: /node_modules/,
        },
      ],
    },
    externals: {
      jquery: 'jQuery',
    },
  },

  changeHandler(err, stats) {
    log('[webpack]', stats.toString({
      colors: true,
    }));

    browser.reload();
  },

  build() {
    return gulp.src(PATHS.entries)
      .pipe(named())
      .pipe(webpackStream(webpack.config, webpack2))
      .pipe(gulpIf(PRODUCTION, gulpUglify()
        .on('error', e => { console.log(e); }),
      ))
      .pipe(gulpIf(REVISIONING && PRODUCTION || REVISIONING && DEV, rev()))
      .pipe(gulp.dest(PATHS.dist + '/js'))
      .pipe(gulpIf(REVISIONING && PRODUCTION || REVISIONING && DEV, rev.manifest()))
      .pipe(gulp.dest(PATHS.dist + '/js'));
  },


  watch() {
    const watchConfig = Object.assign(webpack.config, {
      watch: true,
      devtool: 'source-map',
    });

    return gulp.src(PATHS.entries)
      .pipe(named())
      .pipe(webpackStream(watchConfig, webpack2, webpack.changeHandler)
        .on('error', (err) => {
          log('[webpack:error]', err.toString({
            colors: true,
          }));
        }),
      )
      .pipe(gulp.dest(PATHS.dist + '/js'));
  },
};

gulp.task('webpack:build', webpack.build);
gulp.task('webpack:watch', webpack.watch);

// Copy images to the "dist" folder
// In production, the images are compressed
async function images() {
  const imageSource = 'library/src/images/**/*';
  if (!checkFileExists('library/src/images')) {
    log(colors.yellow('Skipping image optimization, library/src/images not found.'));
    return Promise.resolve();
  }

  const { default: gulpImagemin, gifsicle, mozjpeg, optipng, svgo } = await dynamicImport('gulp-imagemin');
  const imageminPlugins = await Promise.all([
    mozjpeg({ progressive: true }),
    optipng({ optimizationLevel: 5 }),
    gifsicle({ interlaced: true }),
    svgo({
      plugins: [
        { name: 'cleanupAttrs', active: true },
        { name: 'removeComments', active: true },
      ]
    })
  ]);

  return gulp.src(imageSource)
    .pipe(gulpIf(PRODUCTION, gulpImagemin(imageminPlugins)))
    .pipe(gulp.dest(PATHS.dist + '/images'));
}

// Create a .zip archive of the theme
// function archive() {
//   var time = dateFormat(new Date(), "yyyy-mm-dd_HH-MM");
//   var pkg = JSON.parse(fs.readFileSync('./package.json'));
//   var title = pkg.name + '_' + time + '.zip';

//   return gulp.src(PATHS.package)
//     .pipe($.zip(title))
//     .pipe(gulp.dest('packaged'));
// }

// PHP Code Sniffer task
gulp.task('phpcs', function () {
  return gulp.src(PATHS.phpcs)
    .pipe(gulpPhpcs({
      bin: 'wpcs/vendor/bin/phpcs',
      standard: './codesniffer.ruleset.xml',
      showSniffCode: true,
    }))
    .pipe(gulpPhpcs.reporter('log'));
});

// PHP Code Beautifier task
gulp.task('phpcbf', function () {
  return gulp.src(PATHS.phpcs)
    .pipe(gulpPhpcbf({
      bin: 'wpcs/vendor/bin/phpcbf',
      standard: './codesniffer.ruleset.xml',
      warningSeverity: 0
    }))
    .on('error', log)
    .pipe(gulp.dest('.'));
});

// Start BrowserSync to preview the site in
function server(done) {
  let options = {
    proxy: BROWSERSYNC.url,
    ui: {
      port: 8080
    }
  }
  if (BROWSERSYNC.hasOwnProperty('key')) {
    options.https = {
      key: BROWSERSYNC.key,
      cert: BROWSERSYNC.crt
    }
  }
  browser.init(options);
  done();
}

// Reload the browser with BrowserSync
function reload(done) {
  browser.reload();
  done();
}

// Watch for changes to static assets, pages, Sass, and JavaScript
function watch() {
  gulp.watch(PATHS.assets, copy);
  gulp.watch('library/src/scss/**/*.scss', sass)
    .on('change', path => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', path => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'));
  gulp.watch('**/*.php', reload)
    .on('change', path => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', path => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'));
  gulp.watch('library/src/images/**/*', gulp.series(images, reload));


}

// Build the "dist" folder by running all of the below tasks
gulp.task('build',
  gulp.series(clean, gulp.parallel(sass, 'webpack:build', images, copy)));


// Build the site, run the server, and watch for file changes
gulp.task('default',
  gulp.series('build', server, gulp.parallel('webpack:watch', watch)));

// Package task
// gulp.task('package',
//   gulp.series('build', archive));
