<?php
  class Task {

    private $description;
    private $id;

    function __construct($description, $id = null) {
      $this->description = $description;
      $this->id = $id;
    }

    function setDescription($new_description) {
      $this->description = (string) $new_description;
    }

    function getDescription() {
      return $this->description;
    }

    function save() {
      $GLOBALS['DB']->exec("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
        $tasks = array();
        foreach($returned_tasks as $task) {
            $description = $task['description'];
            $id = $task['id'];
            $new_task = new Task($description, $id);
            array_push($tasks, $new_task);
        }
        return $tasks;
    }

    function getId()
    {
        return $this->id;
    }

    static function deleteAll() {
      $GLOBALS['DB']->exec("DELETE FROM tasks;");
    }

    static function find($search_id)
    {
      $found_task = null;
      $tasks = Task::getAll();
      foreach($tasks as $task) {
        $task_id = $task->getId();
        if ($task_id == $search_id) {
          $found_task = $task;
        }
      }
      return $found_task;
    }
  }
?>
