<?php

return [
    'components' => [
        'themeManager' => [
            'widgetPaths' => [
                'cart' => '@hiqdev/yii2/cart/widgets/views',
            ],
        ],
    ],
    'modules' => [
        'cart' => [
            'class' => \hiqdev\yii2\cart\Module::class,
        ],
    ],
];
