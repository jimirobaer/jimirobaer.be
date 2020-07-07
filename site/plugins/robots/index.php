<?php

/*
 * Generate Robots.txt
 */

Kirby::plugin('lonelyalien/robots', [
    'routes' => [
        [
            'pattern' => 'robots.txt',
            'action'  => function() {

                $site = site();
                $kirby = kirby();

                // Basic Robots
                if(isIndexed($site) == false) {
                    $value = 'User-agent: *'.PHP_EOL.'Disallow: /';
                } else {
                    $value = 'User-agent: *'.PHP_EOL.'Allow: /';
                }

                // Return Robots status
                $kirby->response()->type('text');
                return $value;

            }
        ]
    ]
]);