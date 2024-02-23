const bs = require("browser-sync");

module.exports = function bs_html() {
  bs.init({
    browser: "chrome",
    logPrefix: "BS-HTML:",
    watch: true,
    proxy: "konmitin.ru/",
    logLevel: "info",
    logConnections: true,
    logFileChanges: true,
    open: true,
  });
};
