<?php 
require("../source/classes.php");
require("../source/db.php");

$name = $_POST['name'];
$enddate = $_POST['enddate'];

Todo::add($DB, $name, $enddate);


$message = "200";
echo json_encode($message);