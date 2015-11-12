<?php

/*
 * Cart Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-cart
 * @package   hipanel-module-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hiqdev\yii2\cart;

use Yii;

/**
 * Cart Module.
 *
 * Example application configuration:
 *
 * ```php
 * 'modules' => [
 *     'cart' => [
 *         'class'  => 'hiqdev\cart\Module',
 *     ],
 * ],
 * ```
 */
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        if (!$this->has('cart')) {
            $this->set('cart', [
                'class' => 'yz\shoppingcart\ShoppingCart',
            ]);
        }
    }

    public static $name = 'cart';

    /**
     * Finds cart module.
     * TODO think of how to find NOT by name
     */
    public static function getInstance()
    {
        return Yii::$app->getModule(static::$name);
    }

    public function getCart()
    {
        return $this->get('cart');
    }

    public function buildUrl($route = null)
    {
        return '/' . $this->id . '/' . ($route ?: 'cart/index');
    }

}
