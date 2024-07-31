<?php

session_start();

interface ITodo {
    public static function get($db);
    public static function add($db, string $name, string $enddate);
    public static function succesful($db, int $id);
    public static function delete($db, int $id);
}

class Todo implements ITodo{
    protected $id;
    protected $name;
    protected $enddate;
    protected $status;

    public function __construct($id, $name, $enddate, $status = 0) {
        $this->id = $id;
        $this->name = $name;
        $this->enddate = $enddate;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getEnddate() {
        return $this->enddate;
    }
    public function getStatus() {
        return $this->status;
    }

    public static function add($db, string $name, string $enddate) : void
    {
        $status = 0;
        $q = "INSERT INTO todo (name, enddate, status) VALUES (?, ?, ?)";
        $stmt = $db->prepare($q);
        $stmt->bind_param('ssi', $name, $enddate, $status);
        $stmt->execute();

        echo json_encode('200');
    }
    public static function get($db) : array
    {
        $list_todo = array();
        $q = "select * from todo order by status";
        $stmt = $db->query($q);
        $list = $stmt->fetch_all(MYSQLI_ASSOC);
        
        foreach($list as $todo) {
            $list_todo[] = new Todo($todo['id'], $todo['name'], $todo['enddate'], $todo['status']);
        }

        // $list_todo['length'] = count($list);
        return $list_todo;
    }
    public static function succesful($db, int $id) : void
    {
        $q = "UPDATE todo SET status = 1 WHERE id = ?";
        $stmt = $db->prepare($q);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        echo json_encode('ok');
    }
    public static function delete($db, int $id) : void
    {
        $q = "delete from todo where id = ?";
        $stmt = $db->prepare($q);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        echo json_encode('ok');
    }
}



class TodoSession implements ITodo  {
    public static function get($db)
    {
        return $_SESSION['todolist'];
    }
    public static function add($db, string $name, string $enddate) {
        $id = count($_SESSION['todolist']);
        $_SESSION['todolist'][] = new Todo($id, $name, $enddate);
    }
    public static function succesful($db, int $id) {
        
    }
    public static function delete($db, int $id) {

    }


}

if(!empty($_POST)) {

    if(empty($type = $_POST['type'])) {
        $type = 'add';
    } else {
        $type = $_POST['type'];
    }
    switch($type) {
        case 'add':
            $name = $_POST['name'];
            $enddate = $_POST['enddate'];
            Todo::add($DB, $name, $enddate);
            break;
        case 'succesful':
            $id = $_POST['id'];
            Todo::succesful($DB, $id);
            break;
        case 'delete':
            $id = $_POST['id'];
            Todo::delete($DB, $id);
            break;
        default: 
            echo "Неизвестный тип";
    }
}


