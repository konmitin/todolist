<?php 

session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/source/classes.php");
require($_SERVER['DOCUMENT_ROOT'] . "/source/db.php");


$input = json_decode(file_get_contents('php://input'));


$title = htmlspecialchars($input->title);
$desc = htmlspecialchars($input->desc);
$enddate = htmlspecialchars($input->enddate);
$userLogin = trim($_SESSION['login']);

$userID = $DB->query("SELECT id FROM users WHERE login = '$userLogin'")->fetch_assoc()['id'];

$todo = new Task($title, $desc, $enddate, $userID);
$response = $todo->add();

if($response) {
    $out['status'] = "200";
    $out['message'] = "Задача успешно добавлена!";
} else {
    $out['status'] = "400";
    $out['message'] = "Ошибка при добавлении задачи!";
}


echo json_encode($out);