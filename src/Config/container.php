<?php
use PhpKansai\TodoManager\Model\TodoRepository;
use Symfony\Component\HttpFoundation\Request;

/** @var \Silex\Application $app */

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => [
        __DIR__ . '/../View',
    ],
]);

Request::enableHttpMethodParameterOverride();

$app['todo.repository'] = $app->share(function() use ($app) {
    $repo = new TodoRepository();
    $repo->setConnection($app['db']);
    return $repo;
});
