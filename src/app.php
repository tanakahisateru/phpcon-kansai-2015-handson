<?php
$app = new Silex\Application();

require __DIR__ . '/Config/container.php';
require __DIR__ . '/Config/db.php';
require __DIR__ . '/Config/routes.php';

return $app;
