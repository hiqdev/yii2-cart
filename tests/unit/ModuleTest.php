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
}
