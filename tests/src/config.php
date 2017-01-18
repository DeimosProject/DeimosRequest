<?php

return [

    'deimos' => [
        'type' => 'pattern',
        'path' => '/demo/deimos',

        'defaults' => [
            'controller' => 'deimos',
            'action'     => 'request',
        ]
    ],

    'demo' => [
        'type' => 'prefix',
        'path' => '/demo',

        'resolver' => [
            'admin' => [
                'type' => 'pattern',
                'path' => '(/<controller>(/<action>(/<id:\d+>)))',

                'defaults' => [
                    'controller' => 'cms',
                    'action'     => 'default',
                ]
            ],

            'admin2' => [
                'type' => 'pattern',
                'path' => [
                    '(/<controller>(/<action>(/<id>)))',
                    [
                        'id' => '\w+'
                    ]
                ],

                'defaults' => [
                    'controller' => 'cms',
                    'action'     => 'default',
                ]
            ],
        ]
    ],

    'default' => [
        'type' => 'pattern',
        'path' => '/(<controller>(/<action>(/<value>)))',

        'defaults' => [
            'controller' => 'deimos',
            'action'     => 'index',
        ]
    ],

];