<?php

return [
    'components' => [
        'themeManager' => [
            'pathMap' => [
                '@hiqdev/yii2/cart/widgets/views' => '$themedWidgetPaths',
                '@hiqdev/yii2/cart/views' => '$themedViewPaths',
            ],
        ],
        'i18n' => [
            'translations' => [
                'cart' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@hiqdev/yii2/cart/messages',
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
