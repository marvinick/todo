<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

    require_once "src/Task.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Task::deleteAll();
        }

        function test_save()
        {
            //arrange
            $description = "Wash the dog";
            $test_task = new Task($description);

            //act
            $test_task->save();

            //assert
            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_Task = new Task($description);
            $test_Task->save();
            $test_Task2 = new Task($description2);
            $test_Task2->save();

            //Act
            $result = Task::getAll();

            //Assert
            $this->assertEquals([$test_Task, $test_Task2], $result);
        }

        function test_deleteAll()
        {
            //arrange
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_Task = new Task($description);
            $test_Task->save();
            $test_Task2 = new Task($description2);
            $test_Task2->save();

            //act
            Task::deleteAll();


            //assert
            $result = Task::getAll();
            $this->assertEquals([], $result);
        }
    }
  ?>
