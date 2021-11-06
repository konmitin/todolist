const project_folder = "dist"; //название папки готового проекта
const source_folder = "src"; //название папки с исходниками проекта

const path = {
    build: {
        html:   project_folder + "/",
        css:    project_folder + "/css/",
        js:     project_folder + "/js/",
        img:    project_folder + "/img/",
        fonts:  project_folder + "/fonts/",
        pug:    project_folder + '/',
        php:    project_folder + '/',
    }, //здесь хранятся пути вывода файлов
    src: {
        html:  [source_folder + "/*.html", "!" + source_folder + "/_*.html"],
        scss:   source_folder + "/scss/style.scss",
        js:     source_folder + "/js/index.js",
        img:    source_folder + "/img/**/*.{jpg,png,svg,ico,webp,gif}",
        fonts:  source_folder + "/fonts/**/*.{ttf, woff, woff2, otf}",
        pug:    source_folder + '/index.pug',
        php:    source_folder + '/*.php',
    }, //здесь хранятся пути исходников
    watch: {
        html:   source_folder + "/**/*.html",
        scss:   source_folder + "/scss/**/*.scss",
        js:     source_folder + "/js/**/*.js",
        img:    source_folder + "/img/**/*.{jpg,png,svg,ico,webp,gif}",
        fonts:  source_folder + '/fonts/**/*.{ttf, woff, woff2, otf}',
        pug:    source_folder + '/**/*.pug',
        php:    source_folder + '/**/*.php',
    }, //здесь хранятся пути исходников, которые надо слушать
    clean: "./" + project_folder + "/**/*"
}

const { src, dest, parallel, series, watch } = require('gulp'),
    browsersync = require('browser-sync').create(), //---------Cинхронизация с браузером
    fileinclude = require('gulp-file-include'), //-------------Подключение файлов внутри других
    groupmedia  = require('gulp-group-css-media-queries'), //--Группировка media-запросов
    del         = require('del'), //---------------------------Удаление фалов
    rename      = require('gulp-rename'), //-------------------Переименовывание файлов
    uglify      = require('gulp-uglify-es').default, //--------Оптимизация JavaScript файлов
    sass        = require('gulp-sass')(require('sass')), //----Компилятор css
    cleanCss    = require('gulp-clean-css'), //----------------Очистка css
    prefixer    = require('gulp-autoprefixer'), //-------------Автопрефиксер
    pugGulp     = require('gulp-pug'), //----------------------Компилирует .pug в .html
    ttf2woff    = require('gulp-ttf2woff'), //-------------------Конвертируем .ttf в .woff
    ttf2woff2   = require('gulp-ttf2woff2'); //-------------------Конвертируем .ttf в .woff2
    imagemin = require('gulp-imagemin'); //-----------------------Минимизация картинок

function browserSync() {
    browsersync.init({
        server: {
            baseDir: "./" + project_folder + "/"
        },
        port: 3000,
        notify: false
    });
} // функция - обновляет браузер

// function pug() {
//     return src(path.src.pug)
//         .pipe( pugGulp({ doctype: 'html', pretty: true})) // компилирует .pug в .html
//         .pipe( dest(path.build.pug)) // копируем .html в папку проекта
//         .pipe(browsersync.stream())  // обновляет браузер
// }

function php() {
  return src(path.src.php)
    .pipe(dest(path.build.php))  // копирует файлы php в папку проекта
    .pipe(browsersync.stream())  // обновляет браузер
}

function html() {
    return src(path.src.html)
        .pipe(fileinclude())         // подключает файлы html внутри index.html
        .pipe(dest(path.build.html)) // копирует файлы html в папку проекта
        .pipe(browsersync.stream())  // обновляет браузер
}

function fontsToDist() {
    return src(path.src.fonts)
      .pipe(dest(path.build.fonts))
  }

function fonts() {
  src(path.src.fonts)
    .pipe(ttf2woff())
    .pipe(dest(path.build.fonts))
  return src(path.src.fonts)
    .pipe(ttf2woff2())
    .pipe(dest(path.build.fonts))
}

function scss() {
    return src(path.src.scss)
        .pipe(sass())               // Компилирует scss в css
        .pipe(prefixer())           // Расставляет префиксы
        .pipe(cleanCss())           // сжимает файл css
        .pipe(groupmedia())         // группирует медиа запросы
        .pipe(rename({
            extname: ".min.css"     // переименовывает сжатый файл style.css в style.min.css
        }))
        .pipe(dest(path.build.css)) // копирует файлы css в папку проекта
        .pipe(browsersync.stream()) // обновляет браузер
}

function js() {
    return src(path.src.js)
        .pipe(fileinclude()) // копирует файлы js в папку проекта
        .pipe(uglify())             // сжимает файл js
        .pipe(rename({
            extname: ".min.js"      // переименовывает сжатый файл script.js в script.min.js
        }))
        .pipe(dest(path.build.js))  //копирует файлы min.js в папку проекта
        .pipe(browsersync.stream()) //обновляет браузер
}


function images() {
    return src(path.src.img)
        .pipe(dest(path.build.img)) //копирует файлы img в папку проекта
        .pipe(imagemin()) //минимизирует картинки
        .pipe(browsersync.stream()) //обновляет браузер
}
function files() {
  return src(source_folder + '/files/**/*.*')
    .pipe(dest(project_folder + '/files'))
}
function watchFiles() {
    watch([path.watch.img], images); // слушает файлы images
    watch([path.watch.js], js);      // слушает файлы js
    watch([path.watch.scss], scss);  // слушает файлы css
    watch([path.watch.html], html);  // слушает файлы html
    watch([path.watch.php], php);  // слушает файлы html
    // watch([path.watch.pug], pug);  // слушает файлы pug
}



function clean() {
    return del(path.clean); // удаляет ненужные файлы
}

const build = series(clean, parallel(html, php, scss, js, files, fonts, images, fontsToDist, watchFiles, browserSync)); //


// exports.pug = pug;
exports.html = html;
exports.php = php;
exports.files = files;
exports.watchFiles = watchFiles;
exports.fontsToDist = fontsToDist;
exports.scss = scss;
exports.fonts = fonts;
exports.js = js;
exports.images = images;
exports.clean = clean;
exports.build = build;
exports.default = build;
