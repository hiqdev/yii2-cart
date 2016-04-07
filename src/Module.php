<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
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
 *         'class'  => 'hiqdev\yii2\cart\Module',
 *     ],
 * ],
 * ```
 */
class Module extends \yii\base\Module
{
    /**
     * @var array array of the options that will be passed to [[set]]
     */
    public $shoppingCartOptions = [];

    /**
     * Cart component ID.
     */
    const CART_COMPONENT_ID = 'cart';

    /**
     * {@inheritdoc}
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (!$this->has(static::CART_COMPONENT_ID)) {
            $this->set(static::CART_COMPONENT_ID, array_merge([
                'class' => 'hiqdev\yii2\cart\ShoppingCart',
            ], $this->shoppingCartOptions));
        }
        $this->get(static::CART_COMPONENT_ID)->module = $this;
        $this->registerTranslations();
    }

    /**
     * Registers translations.
     * @void
     */
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

    /**
     * @var string the module name
     */
    public static $name = 'cart';

    /**
     * Finds cart module.
     * TODO think of how to find NOT by name.
     */
    public static function getInstance()
    {
        return Yii::$app->getModule(static::$name);
    }

    /**
     * @throws \yii\base\InvalidConfigException
     * @return null|\yz\shoppingcart\ShoppingCart|ShoppingCart
     */
    public function getCart()
    {
        return $this->get(static::CART_COMPONENT_ID);
    }

    public function createUrl($route = null)
    {
        $params = is_array($route) ? $route : [$route];
        $params[0] = '/' . $this->id . '/' . (strpos($params[0], '/') !== false ? $params[0] : 'cart/' . ($params[0] ?: 'index'));
        return Url::toRoute($params);
    }

    /**
     * @var string|array route to the terms of use page, suitable for Url::to().
     */
    public $termsPage;

    /**
     * @var string|array route to the order page, suitable for Url::to().
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
