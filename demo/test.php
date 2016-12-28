<?php

include_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Deimos\Builder\Builder();
$helper  = new \Deimos\Helper\Helper($builder);
$request = new \Deimos\Request\Request($helper);

var_dump($request->query('id'));