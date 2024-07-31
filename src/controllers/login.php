<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/source/classes/user.php");

$input = json_decode(file_get_contents('php://input'));

if(empty($input)) {
    json_encode("Пустой запрос");
    die();
}

if(!empty($input->login) && !empty($input->password)) {
    $login = trim(htmlspecialchars($input->login));
    $password = trim(htmlspecialchars($input->password));
}

$res = User::login($login, $password);

echo json_encode($res);
