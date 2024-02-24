<?php 
require("db.php");

$id = 1;
$status = 0;
$name = $_POST['name'];
$enddate = $_POST['enddate'];

$sql_add_todo = "INSERT INTO `todo` (`id`, `name`, `enddate`, `status`) VALUES (?, ?, ?, ?)"; // строка с запросом

$stmt = $connection->prepare($sql_add_todo); //Подготавливаем  запрос
$stmt ->bind_param("issi", $id, $name, $enddate, $status); //Привязываем переменные к подготовленному запросу
$stmt->execute(); //Выполняем запрос

echo json_encode($stmt);
?>