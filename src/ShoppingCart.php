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

use Yii;

class ShoppingCart extends \yz\shoppingcart\ShoppingCart
{
    /**
     * The cart module.
     */
    public $module;

    public $currency = 'usd';

    public function getCount()
    {
        return count($this->_positions);
    }

    public function getQuantity()
    {
        $count = 0;
        foreach ($this->_positions as $position) {
            $count += $position->getQuantity();
        }

        return $count;
    }

    public function getSubtotal()
    {
        return $this->getCost(false);
    }

    public function getTotal()
    {
        return $this->getCost(true);
    }

    public function getDiscount()
    {
        return $this->getTotal() - $this->getSubtotal();
    }

    public function formatCurrency($sum, $currency = null)
    {
        return Yii::$app->formatter->format($sum, ['currency', $currency ?: $this->currency]);
    }
}
