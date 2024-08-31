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

unset($_SESSION['user_id']);
unset($_SESSION['login']);
unset($_SESSION['last_login']);

echo json_encode($res);
