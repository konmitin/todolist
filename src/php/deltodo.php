<?php

require("db.php");

$id = (int)$_POST["id"];

$delete_todo_req = "DELETE FROM todo WHERE id = ? LIMIT 1";

$stmt = $connection->prepare($delete_todo_req); //Подготавливаем  запрос
$stmt ->bind_param("i", $id); //Привязываем переменные к подготовленному запросу
$stmt->execute(); //Выполняем запрос

echo json_encode($stmt);

?>