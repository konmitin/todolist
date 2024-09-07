const { src } = require("gulp");
const clean = require("gulp-clean");

module.exports = function cleanAll() {
    return src("build/", {read: true})
    .pipe(clean());
}
