<?php
  class Task {

    private $description;

    function __construct($description) {
      $this->description = $description;
    }

    function setDescription($new_description) {
      $this->description = (string) $new_description;
    }

    function getDescription() {
      return $this->description;
    }

    function save() {
      $GLOBALS['DB']->exec("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}');");
    }

    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
        $tasks = array();
        foreach($returned_tasks as $task) {
            $description = $task['description'];
            $new_task = new Task($description);
            array_push($tasks, $new_task);
        }
        return $tasks;
    }

    static function deleteAll() {
      $GLOBALS['DB']->exec("DELETE FROM tasks;");
    }

  }
?>
