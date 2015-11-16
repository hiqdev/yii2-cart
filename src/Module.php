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
    const CART = 'cart';

    public function init()
    {
        parent::init();
        if (!$this->has(static::CART)) {
            $this->set(static::CART, [
                'class' => 'hiqdev\yii2\cart\ShoppingCart',
            ]);
        }
        $this->get(static::CART)->module = $this;
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['cart'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath'       => '@hiqdev/yii2/cart/messages',
            'fileMap'        => [
                'merchant' => 'cart.php',
            ],
        ];
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
        return $this->get(static::CART);
    }

    public function buildUrl($route = null)
    {
        return '/' . $this->id . '/' . ($route ?: 'cart/index');
    }

    /**
     * Link to the terms of use page.
     */
    public $termsPage;
}
