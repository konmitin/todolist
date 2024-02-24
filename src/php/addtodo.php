<?php 
require("db.php");

function getId($connection) {
    $id_out = rand(0, 5000);

    $id_req = "SELECT id FROM todo";
    $id_in_db = (int)$connection->query($id_req);

    if($id_out == $id_in_db) {
        return getId();
    } else {
        return $id_out;
    }
}

$id = getId($connection);
$status = 0;
$name = $_POST['name'];
$enddate = $_POST['enddate'];

$sql_add_todo = "INSERT INTO `todo` (`id`, `name`, `enddate`, `status`) VALUES (?, ?, ?, ?)"; // строка с запросом

$stmt = $connection->prepare($sql_add_todo); //Подготавливаем  запрос
$stmt ->bind_param("issi", $id, $name, $enddate, $status); //Привязываем переменные к подготовленному запросу
$stmt->execute(); //Выполняем запрос

echo json_encode($stmt);
?>