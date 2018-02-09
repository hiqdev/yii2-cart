<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\tests\unit;

use hiqdev\yii2\cart\CartPositionInterface;
use hiqdev\yii2\cart\CartPositionTrait;

class FakeCartPosition extends \yii\base\BaseObject implements CartPositionInterface
{
    use CartPositionTrait;

    public $id;
    public $price;
    public $discount;

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCost($withDiscount = true)
    {
        return $this->price * $this->quantity - ($withDiscount ? $this->discount * $this->quantity : 0);
    }
}
