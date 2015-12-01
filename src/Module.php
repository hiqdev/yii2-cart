<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart;

use Closure;
use Yii;
use yii\helpers\Url;

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

    public function createUrl($route = null)
    {
        $params = is_array($route) ? $route : [$route];
        $params[0] = '/' . $this->id . '/' . (strpos($params[0], '/') !== false ? $params[0] : 'cart/' . ($params[0] ?: 'index'));
        return Url::toRoute($params);
    }

    /**
     * Route to the terms of use page, suitable for Url::to().
     */
    public $termsPage;

    /**
     * Route to the order page, suitable for Url::to().
     */
    public $orderPage = ['order'];

    protected $_orderButton;

    public function setOrderButton($value)
    {
        $this->_orderButton = $value;
    }

    public function getOrderButton()
    {
        return $this->_orderButton instanceof Closure ? call_user_func($this->_orderButton, $this) : $this->_orderButton;
    }

    protected $_paymentMethods;

    public function setPaymentMethods($value)
    {
        $this->_paymentMethods = $value;
    }

    public function getPaymentMethods()
    {
        return $this->_paymentMethods instanceof Closure ? call_user_func($this->_paymentMethods, $this) : $this->_paymentMethods;
    }
}
