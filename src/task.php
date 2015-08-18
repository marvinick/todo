<?php
    class Task
    {
        private $description;
        private $category_id;
        private $id;

        function __construct($description, $id = null, $category_id)
        {
            $this->description = $description;
            $id->id = $id;
            $this->category_id = $category_id;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getId()
        {
            return $this->id;
        }

        function getCategoryId()
        {
            return $this->category_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->exec("INSERT INTO tasks (description, category_id) VALUES ('{$this->getDescription()}', {$this->category_id()})");
        $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
            $tasks = array();
            foreach($returned_tasks as $task) {
                $description = $task['description'];
                $id = $task['id'];
                $category_id = $task['category_id'];
                $new_task = new Task($description, $id, $category_id);
                array_push($tasks, $new_task);
            }
            return $tasks;
        }

        static function deleteAll()
        {
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