<?php
$config = [
    //Change this to your project name
    'name' => 'GBKSoft Yii2 template',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=gbksoft.net;dbname=auxyn',
            'username' => 'auxyn',
            'password' => 'mRWwAZS7',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            'fileTransportPath' => '@app/web/mail',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
        'apns' => [
            'class' => 'bryglen\apnsgcm\Apns',
            'environment' => \bryglen\apnsgcm\Apns::ENVIRONMENT_SANDBOX,
            'pemFile' => dirname(__FILE__).'/apnssert/apns-dev.pem',
            // 'retryTimes' => 3,
            'options' => [
                'sendRetryTimes' => 5
            ]
        ],
        'gcm' => [
            'class' => 'bryglen\apnsgcm\Gcm',
            'apiKey' => 'your_api_key',
        ],
        // using both gcm and apns, make sure you have 'gcm' and 'apns' in your component
        'apnsGcm' => [
            'class' => 'bryglen\apnsgcm\ApnsGcm',
            // custom name for the component, by default we will use 'gcm' and 'apns'
            //'gcm' => 'gcm',
            //'apns' => 'apns',
        ],
    ],
    'on afterRequest' => function ($event) {
        $app = $event->sender;
        if ($app->request->isConsoleRequest) {
            return;
        }

        // Add header to prevent load site in iframe (Clickjacking)
        $headers = $app->response->headers;
        $headers->add('X-Frame-Options', 'SAMEORIGIN'); //DENY
    },
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['212.8.40.254', '134.249.134.212', '178.214.192.180', '93.73.33.101']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['212.8.40.254', '134.249.134.212', '178.214.192.180', '93.73.33.101'],
        'generators' => [
            'module'   => [
                'template' => 'GBKSoft',
                'class'     => 'common\overrides\gii\generators\module\Generator',
                'templates' => ['GBKSoft' => '@common/overrides/gii/generators/module/default']
            ],
        ],
    ];
}

return $config;
