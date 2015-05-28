<?php
use PhpKansai\TodoManager\Controller\TodoController;

/** @var \Silex\Application $app */

$app['todo.controller'] = $app->share(function() use ($app) {
    return new TodoController($app);
});

$app->get('/', 'todo.controller:indexAction');
$app->post('/todo', 'todo.controller:appendAction');
$app->patch('/todo/{id}/check', 'todo.controller:checkAjaxAction')->assert('id', '\d+');
$app->delete('/todo/{id}', 'todo.controller:removeAction')->assert('id', '\d+');
