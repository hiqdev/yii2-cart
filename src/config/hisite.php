<?php

return [
    'components' => [
        'themeManager' => [
            'pathMap' => [
                '@hiqdev/yii2/cart/widgets/views' => '$themedWidgetPaths',
            ],
        ],
    ],
    'modules' => [
        'cart' => [
            'class' => \hiqdev\yii2\cart\Module::class,
        ],
    ],
];
