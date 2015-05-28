<?php
require __DIR__ . '/../src/bootstrap.php';

$app = require __DIR__ . '/../src/app.php';
$app['debug'] = true;
$app->run();
