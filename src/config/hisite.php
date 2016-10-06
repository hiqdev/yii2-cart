<?php

return [
    'components' => [
        'themeManager' => [
            'pathMap' => [
                '@hiqdev/yii2/cart/widgets/views' => '$themedWidgetPaths',
                '@hiqdev/yii2/cart/views' => '$themedViewPaths',
            ],
        ],
    ],
    'modules' => [
        'cart' => [
            'class' => \hiqdev\yii2\cart\Module::class,
        ],
    ],
];
