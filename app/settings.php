<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => (bool)getenv('DISPLAY_ERRORS'),

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // monolog settings
        'logger' => [
            'name' => 'my-crm',
            'level' => (int)getenv('LOG_LEVEL') ?: 400,
            'path' => getenv('BASE_DIR') . '/log/app.log',
        ],
    ],
];
