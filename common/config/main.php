<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'modules\user\module',
        ],
        'track' => [
            'class' => 'modules\track\module',
        ],
        'collaboration' => [
            'class' => 'modules\collaboration\module',
        ],
        'radio' => [
            'class' => 'modules\radio\module',
        ],
        'popular' => [
            'class' => 'modules\popular\module',
        ],
        'payment' => [
            'class' => 'modules\payment\module',
        ],
        'message' => [
            'class' => 'modules\message\module',
        ],
        'event' => [
            'class' => 'modules\event\module',
        ],
        'social' => [
            'class' => 'modules\social\module',
        ],
        'photo' => [
            'class' => 'modules\photo\module',
        ],
        'vocabulary' => [
            'class' => 'modules\vocabulary\module',
        ],
    ],    
    // set source language to be English
    'sourceLanguage' => 'en-US',
];
