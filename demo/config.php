<?php

return [

    'deimos' => [
        'type' => 'prefix',
        'path' => '/demo',

        'resolver' => [

            'deimos' => [
                'type' => 'pattern',
                'path' => '/deimos',

                'defaults' => [
                    'controller' => 'deimos',
                    'action'     => 'request',
                ]
            ],

            'default' => [
                'type' => 'pattern',
                'path' => '/(<controller>/(<action>/(<id:\d+>)))',

                'defaults' => [
                    'controller' => 'cms',
                    'action'     => 'default',
                ]
            ],

        ]
    ],

];