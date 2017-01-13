<?php

return [

    'deimos' => ['/demo/deimos/', [
        'controller' => 'deimos',
        'action'     => 'request',
    ]],

    'admin' => ['/demo/(<controller>/(<action>/(<id:\d+>)))', [
        'controller' => 'cms',
        'action'     => 'default',
    ]],

];