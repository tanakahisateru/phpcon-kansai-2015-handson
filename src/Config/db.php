<?php
use PhpKansai\TodoManager\Model\TodoRepository;

/** @var \Silex\Application $app */

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_sqlite',
        'path' => __DIR__ . '/../../var/data.sqlite',
    ]
]);

$app['todo.repository'] = $app->share(function() use ($app) {
    $repo = new TodoRepository();
    $repo->setConnection($app['db']);
    return $repo;
});
