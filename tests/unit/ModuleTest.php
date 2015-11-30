<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\tests\unit;

use hiqdev\yii2\cart\Module;
use hiqdev\yii2\cart\ShoppingCart;
use Yii;
use yii\helpers\Url;
use yii\web\Application;

/**
 * Module test suite.
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Module
     */
    protected $object;

    protected function setUp()
    {
        $application = new Application([
            'id'       => 'mock',
            'basePath' => dirname(dirname(__DIR__)),
            'modules'  => [
                'cart' => [
                    'class' => Module::className(),
                ],
            ],
        ]);
        $this->object = Yii::$app->getModule('cart');
    }

    protected function tearDown()
    {
    }

    public function testGetInstance()
    {
        $module = Module::getInstance();
        $this->assertInstanceOf(Module::className(), $module);
        $this->assertSame($this->object, $module);
    }

    public function testGetCart()
    {
        $this->assertInstanceOf(ShoppingCart::className(), $this->object->getCart());
        $this->assertSame(Yii::$app->getModule('cart')->get('cart'), $this->object->cart);
    }
    public function testCreateUrl()
    {
        $this->assertSame(Url::to('/cart/cart/index'),             $this->object->createUrl());
        $this->assertSame(Url::to('/cart/cart/something'),         $this->object->createUrl('something'));
        $this->assertSame(Url::to(['/cart/cart/order', 'a' => 2]), $this->object->createUrl(['order', 'a' => 2]));
        $this->assertSame(Url::to(['/cart/test/order', 'a' => 2]), $this->object->createUrl(['test/order', 'a' => 2]));
    }

    protected $methods = 'a and b';

    public function testPaymentMethods()
    {
        $this->object->setPaymentMethods($this->methods);
        $this->assertSame($this->methods, $this->object->getPaymentMethods());
        $this->object->setPaymentMethods(function () { return $this->methods; });
        $this->assertSame($this->methods, $this->object->getPaymentMethods());
    }
}
