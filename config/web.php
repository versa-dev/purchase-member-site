<?php
Yii::setAlias('@themes', dirname(__DIR__) . '/web/themes');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'webpicid.com',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '_6WfXcp3SKzK0vV4RdvyhKOef8DEcVYq',
        ],

        /*'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
            ],
        ],*/


        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
//            'useFileTransport' => true,
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure a transport
//            // for the mailer to send real emails.
//            'useFileTransport' => false,
//            'transport' => [
//                //'useFileTransport' => false,
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'mail.webpicid.com',
//                'username' => 'shengjie@webpicid.com',
//                'password' => 'IK9bb?yz=S5j',
//                'port' => '',
//                'encryption' => '',
////                'streamOptions' => [
////                    'ssl' => [
////                        'allow_self_signed' => true,
////                        'verify_peer' => false,
////                        'verify_peer_name' => false,
////                    ],
////                ],
//            ],
//        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@themes/vuportal/views',
                    '@app/modules/backend' => '@themes/admin',
                    'baseUrl' => '@web',
                ],

            ],

        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(),
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
    'modules' => [
        'backend' => [
            'class' => 'app\modules\backend\Backend',
        ],
        'admin' => [
            'layout' => 'left-menu',

            'class' => 'mdm\admin\Module',

            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'idField' => 'id', // id field of model User
                ]
            ],

        ]

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            // 'admin/*',
            'site/*',
            'hello/*',
            'agent-identification/*',
            'safe-purchase/*',
            'dashboard/*',
            'message/*',
            'test/*'
            // add or remove allowed actions to this list
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
