<?php 
require("config.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connection = new mysqli($DB_HOST, $DB_LOGIN, $DB_PASS, $DB_NAME);
$connection->set_charset($DB_CHARSET);
$connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

$GLOBALS["DB"] = $connection;