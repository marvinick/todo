<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/task.php";

  session_start();
  if (empty($_SESSION['list_of_tasks'])) {
    $_SESSION['list_of_tasks'] = array();
  }

  $app = new Silex\Application();
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
