<?php

namespace hiqdev\yii2\cart\tests\unit;

use hiqdev\yii2\cart\CartPositionTrait;
use hiqdev\yii2\cart\CartPositionInterface;

class FakeCartPosition extends \yii\base\Object implements CartPositionInterface
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
        return $this->price*$this->quantity - ($withDiscount ? $this->discount*$this->quantity : 0);
    }
}
