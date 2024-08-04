<?php

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/source/classes/user.php");

$input = json_decode(file_get_contents('php://input'));

if(empty($input)) {
    json_encode("Пустой запрос");
    die();
}

if(!empty($input->status)) {
    $status = trim(htmlspecialchars($input->status));
}

unset($_SESSION['login']);

echo json_encode($res);
