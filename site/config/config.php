<?php

/*
 *  Configuration: Live
 */

return [

    'env' => '',

    'languages' => true,
    'date.handler'  => 'strftime', // Because date() ignores locale

    'debug'  => false,

    'cache' => [
        'pages' => [
            'active' => true
        ]
    ],

    'assets' => [
        'base' => 'dist',
        'css' => [
            'main.min.css',
        ],
        'js' => [
            'vendor.min.js',
            'script.min.js'
        ]
    ]

];