<?php

session_start();

require($_SERVER['DOCUMENT_ROOT'] . '/source/classes.php');
require($_SERVER['DOCUMENT_ROOT'] . '/source/db.php');

$input = json_decode(file_get_contents('php://input'));

$out = array(
    'status' => 400,
    'message' => 'Ошибка. Непредвиденная ошибка!',
    'list' => ''
);

if (empty($input)) {
    echo json_encode($out);
    die();
}

$sort = htmlspecialchars($input->sort);

$userID = $_SESSION['user_id'];
$list = Task::getList($userID, $sort);


$out['status'] = 200;
$out['message'] = 'Удача!';
$out['list'] = "";
$out['count'] = 0;

if (!empty($list)) {
    $out['count'] = count($list);
}

foreach ($list as $item) {

    $title = $item->getTitle();
    $id = $item->getId();
    $enddate = $item->getEndDate();
    $status = '';
    if ($item->getStatus() == 1) {
        $status = '_successful';
    } else if ($item->getStatus() == 2) {
        $status = '_failed';
    }

    $checked = $item->getStatus() ? 'checked' : '';

    $checkBtn = "<button class='backlog__success backlog__btn' data-type='taskSuccess'>
                    <img class='backlog__delete_img' src='/assets/img/check-task-green.svg' alt=''>
                </button>";

    $checkBtn = !$item->getStatus() ? $checkBtn : '';

    $out['list'] .= "<div class='backlog__item $status'
                    data-id='$id'>
                    <div class='backlog__desc-block'>
                        <p class='backlog__description'>$title</p>
                    </div>
                    <div class='backlog__date-box date-box'>
                        <p class='date-box__date'>$enddate</p>
                    </div>
                    <div class='backlog__right backlog__btns'>
                        $checkBtn 
                        <button class='backlog__delete backlog__btn' type='button' data-type='deleteTask'>
                            <img class='backlog__delete_img' src='/assets/img/trash-task-red.svg' alt=''>
                        </button>
                    </div>
                </div>";
}

$_SESSION['last_sort'] = $sort;
echo json_encode($out);
