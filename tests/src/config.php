<?php

return [

    'deimos' => ['/demo/deimos', [
        'controller' => 'deimos',
        'action'     => 'request',
    ]],

    'admin' => ['/demo(/<controller>(/<action>(/<id:\d+>)))', [
        'controller' => 'cms',
        'action'     => 'default',
    ]],

    'admin2' => [['/demo(/<controller>(/<action>(/<id>)))', [
        'id' => '\w+'
    ]], [
        'controller' => 'cms',
        'action'     => 'default',
    ]],

    'default' => ['/(<controller>(/<action>(/<value>)))', [
        'controller' => 'deimos',
        'action'     => 'index',
    ]],

];