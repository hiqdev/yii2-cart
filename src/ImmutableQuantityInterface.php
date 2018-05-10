<?php

namespace hiqdev\yii2\cart;

/**
 * Interface ImmutableQuantityInterface should be used to prevent position quantity modification.
 * In difference to DontIncrementQuantityWhenAlreadyInCart, this interface also prohibits manual
 * quantity modification.
 * 
 * @package hiqdev\yii2\cart
 */
interface ImmutableQuantityInterface extends DontIncrementQuantityWhenAlreadyInCart
{
}
