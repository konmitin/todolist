<?php 

class Task {
    protected $id;
    protected $title;
    protected $endDate;
    protected $status = 0;
    public function __construct($title, $endDate, $status = 0, $id = 0) {
        global $DB;

        if($id == 0) {
            $q = "SELECT `ID` FROM tasks ORDER BY `ID` DESC LIMIT 1";
            $stmt = $DB->query($q);
            $task = $stmt->fetch_assoc();

            $this->id = $task['ID'] + 1;
        } else {
            $this->id = $id;
        }
        
        $this->title = $title;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getEndDate() {
        return $this->endDate;
    }
    public function getStatus() {
        return $this->status;
    }

    public function add() : bool
    {
        global $DB; 

        if(empty($this->title) || empty($this->endDate) || empty($this->status)) {
            return false;
        }

        $q = "INSERT INTO tasks (id, title, decription, end_date, status) VALUES (?, ?, ?, ?)";
        $stmt = $DB->prepare($q);
        $stmt->bind_param('issi', $this->id ,$this->title, $this->endDate, $this->status);
        $stmt->execute();

        return true;
    }
    public static function getList() : array
    {
        global $DB;

        $list_todo = array();
        $q = "select * from tasks order by status";
        $stmt = $DB->query($q);
        $list = $stmt->fetch_all(MYSQLI_ASSOC);
        
        foreach($list as $todo) {
            $list_todo[] = new Task($todo['title'], $todo['end_date'], $todo['status'] , $todo['id']);
        }

        // $list_todo['length'] = count($list);
        return $list_todo;
    }
    public static function succesful(int $id) : bool
    {
        global $DB; 

        $q = "UPDATE tasks SET status = 1 WHERE id = ?";
        $stmt = $DB->prepare($q);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return true;
    }
    public static function delete(int $id) : bool
    {
        global $DB; 

        $q = "delete from tasks where id = ?";
        $stmt = $DB->prepare($q);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        return true;
    }
}