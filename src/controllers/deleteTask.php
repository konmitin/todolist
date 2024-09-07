<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'] . "/source/classes.php");
require($_SERVER['DOCUMENT_ROOT'] . "/source/db.php");

$input = json_decode(file_get_contents('php://input'));

$index = (int)htmlspecialchars($input->index);

$out = array(
    'status' => 400,
    'message' => "Ошибка удаления. Непредвиденная ошибка!"
);

if($index >= 0) {

    $id = $_SESSION['tasks_list'][$index];

    if(!empty($id)) {
        $response = Task::delete($id);

        if($response) {
            $out['status'] = 200;
            $out['message'] = "Задача удалена!";
        }
    } else {
        $out['status'] = 200;
        $out['message'] = "Задача не найдена!";
    }
    
}

echo json_encode($out);
