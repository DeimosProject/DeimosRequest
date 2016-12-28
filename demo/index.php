<?php

include_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Deimos\Builder\Builder();
$helper  = new \Deimos\Helper\Helper($builder);
$request = new \Deimos\Request\Request($helper);

$router = new \Deimos\Router\Router();

$config = require __DIR__ . '/config.php';

$router->setRoutes($config);

$request->setRouter($router);

var_dump($request->attributes());