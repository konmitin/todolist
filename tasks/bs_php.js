const bs = require("browser-sync");

module.exports = function bs_php() {
  bs.init({
    browser: ["chrome"],
    watch: true,
    proxy: "todolist/",
    logLevel: "info",
    logPrefix: "BS-PHP:",
    logConnections: true,
    logFileChanges: true,
  });
};
