<?php

/*
 *  Configuration: client.local
 */

return [

    'env' => 'dev',

    'debug'  => true,

    'cache' => [
        'pages' => [
            'active' => false
        ]
    ],

    'assets' => [
        'css' => [
            'main.css',
        ],
        'js' => [
            'vendor.js',
            'script.js'
        ]
    ]

];