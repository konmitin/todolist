<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/source/classes.php");
require($_SERVER['DOCUMENT_ROOT'] . "/source/db.php");

$input = json_decode(file_get_contents('php://input'));

$id = (int)htmlspecialchars($input->id);

$out = array(
    'status' => 400,
    'message' => "Ошибка удаления. Непредвиденная ошибка!"
);

if(!empty($id)) {
    $response = Task::delete($id);

    if($response) {
        $out['status'] = 200;
        $out['message'] = "Задача удалена!";
    }
}

echo json_encode($out);
