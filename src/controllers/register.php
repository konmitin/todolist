<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/source/classes/user.php");

$input = json_decode(file_get_contents('php://input'));

if(empty($input)) {
    json_encode("Пустой запрос");
    die();
}

if(!empty($input->name) && !empty($input->login) && !empty($input->password)) {
    $name = trim(htmlspecialchars($input->name));
    $login = trim(htmlspecialchars($input->login));
    $password = trim(htmlspecialchars($input->password));
}

$res = User::register($name, $login, $password);

echo json_encode($res);
