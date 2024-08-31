<?php

class Task
{
    protected $id;
    protected $title;
    protected $desc;
    protected $endDate;
    protected $status = 0;
    protected $is_primary = 1;
    protected $user_id = 0;

    public function __construct($title, $desc = "", $endDate, $user_id = 0, $is_primary = 1, $status = 0, $id = 0)
    {
        global $DB;

        if ($id == 0) {
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
        $this->desc = $desc;
        $this->user_id = $user_id;
        $this->is_primary = $is_primary;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function add(): bool
    {
        global $DB;

        if (empty($this->title) || empty($this->endDate) || empty($this->user_id)) {
            return false;
        }

        $q = "INSERT INTO tasks (id, title, description, end_date, is_primary, status, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $DB->prepare($q);
        $stmt->bind_param('isssiii', $this->id, $this->title, $this->desc, $this->endDate, $this->is_primary, $this->status, $this->user_id);
        $stmt->execute();

        return true;
    }
    public static function getList($userID): array
    {
        global $DB;

        $list_todo = array();
        $q = "SELECT * FROM tasks WHERE user_id = $userID ORDER BY status";
        $stmt = $DB->query($q);
        $list = $stmt->fetch_all(MYSQLI_ASSOC);

        foreach ($list as $todo) {
            $list_todo[] = new Task($todo['title'], $todo['desc'], $todo['end_date'], $todo['user_id'], $todo['is_primary'], $todo['status'], $todo['id']);
        }

        // $list_todo['length'] = count($list);
        return $list_todo;
    }
    public static function succesful(int $id): bool
    {
        global $DB;

        $q = "UPDATE tasks SET status = 1 WHERE id = ?";
        $stmt = $DB->prepare($q);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return true;
    }
    public static function delete(int $id): bool
    {
        global $DB;

        $q = "delete from tasks where id = ?";
        $stmt = $DB->prepare($q);
        $stmt->bind_param('s', $id);
        $stmt->execute();

        return true;
    }
}
