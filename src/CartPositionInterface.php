<?php

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
