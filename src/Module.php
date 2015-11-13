<?php

/*
 * Cart module for yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
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
                'class' => 'hiqdev\yii2\cart\components\ShoppingCart',
            ]);
        }
    }

    public static $name = 'cart';

    /**
     * Finds cart module.
     * TODO think of how to find NOT by name.
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
