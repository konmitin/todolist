<?php 
require($_SERVER['DOCUMENT_ROOT'] . "/source/classes.php");
require($_SERVER['DOCUMENT_ROOT'] . "/source/db.php");

$title = $_POST['name'];
$enddate = $_POST['enddate'];

$todo = new Task($title, $enddate, 0);
$todo->add();


$out['status'] = "200";
$out['message'] = "Задача успешно добавлена!";
echo json_encode($out);