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

/**
 * CartPositionInterface interface.
 *
 * @property string $icon
 * @property string $name
 * @property string $description
 */
interface CartPositionInterface extends \yz\shoppingcart\CartPositionInterface
{
    public function getIcon();

    public function getName();

    public function getDescription();
}
