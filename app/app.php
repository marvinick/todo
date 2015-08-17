<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Task.php";

  $app = new Silex\Application();
  $server = 'mysql:host=localhost;dbname=to_do';
  $usernamae = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password); 

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  $app->get("/", function() use ($app) {
    return $app['twig']->render('task.html.twig', array('tasks' => Task::getAll())); //changed tasks.twig
  });

$app->post("/tasks", function() use ($app) {
  $task = new Task($_POST['description']);
  $task->save();
  return $app['twig']->render('create_task.html.twig', array('newtask' => $task));
});

  $app->post("/delete_tasks", function() use ($app) {
    Task::deleteAll();
    return $app['twig']->render('delete_tasks.html.twig');
});

  return $app;
?>
