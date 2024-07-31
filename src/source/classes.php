<?php

session_start();

class Todo {
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

    public static function add($db, string $title, string $enddate) : void
    {
        $status = 0;
        $q = "INSERT INTO tasks (title, enddate, status) VALUES (?, ?, ?)";
        $stmt = $db->prepare($q);
        $stmt->bind_param('ssi', $title, $enddate, $status);
        $stmt->execute();

        echo json_encode('200');
    }
    public static function get($db) : array
    {
        $list_todo = array();
        $q = "select * from tasks order by status";
        $stmt = $db->query($q);
        $list = $stmt->fetch_all(MYSQLI_ASSOC);
        
        foreach($list as $todo) {
            $list_todo[] = new Todo($todo['id'], $todo['title'], $todo['enddate'], $todo['status']);
        }

        // $list_todo['length'] = count($list);
        return $list_todo;
    }
    public static function succesful($db, int $id) : void
    {
        $q = "UPDATE tasks SET status = 1 WHERE id = ?";
        $stmt = $db->prepare($q);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        echo json_encode('ok');
    }
    public static function delete($db, int $id) : void
    {
        $q = "delete from tasks where id = ?";
        $stmt = $db->prepare($q);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        echo json_encode('ok');
    }
}


