const { src, dest } = require("gulp");
const changed = require("gulp-changed");

const bs = require("browser-sync");

module.exports = function svg() {
  return src("src/assets/img/**/*.svg")
    .pipe(changed("build/assets/img"))
    .pipe(dest("build/assets/img"))
    .pipe(bs.stream());
};
