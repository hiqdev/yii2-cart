<?php

/*
 * Cart Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-cart
 * @package   hipanel-module-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hipanel\modules\cart;

class Plugin extends \hiqdev\pluginmanager\Plugin
{
    protected $_items = [
        'modules' => [
            'cart' => [
                'class' => 'hipanel\modules\cart\Module',
            ],
        ],
    ];
}
