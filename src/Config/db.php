<?php

/** @var \Silex\Application $app */

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_sqlite',
        'path' => __DIR__ . '/../../var/data.sqlite',
    ]
]);
