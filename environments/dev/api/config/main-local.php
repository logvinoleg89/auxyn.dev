<?php
/**
 * Local config for developer of environment.
 *
 * @author Evgeniy Tkachenko <et.coder@gmail.com>
 */

return [
    'components' => [
        'request' => [
            'baseUrl' => '/api',
        ],
        'response' => [
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => 'common\overrides\web\JsonResponseFormatter',
            ],
        ],
        'log' => [
            'traceLevel' => 3,
        ],
    ],
];
