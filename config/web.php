<?php

return [
    'components' => [
        'themeManager' => [
            'pathMap' => [
                dirname(__DIR__) . '/src/widgets/views' => '$themedWidgetPaths',
                dirname(__DIR__) . '/src/views' => '$themedViewPaths',
            ],
        ],
        'i18n' => [
            'translations' => [
                'cart' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'sourceLanguage' => 'en-US',
                    'basePath' => dirname(__DIR__) . '/src/messages',
                ],
            ],
        ],
    ],
    'modules' => [
        'cart' => array_filter([
            'class' => \hiqdev\yii2\cart\Module::class,
            'termsPage' => $params['cart.termsPage'],
        ]),
    ],
];
