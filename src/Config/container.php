<?php
use Symfony\Component\HttpFoundation\Request;

/** @var \Silex\Application $app */

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => [
        __DIR__ . '/../View',
    ],
]);

Request::enableHttpMethodParameterOverride();
