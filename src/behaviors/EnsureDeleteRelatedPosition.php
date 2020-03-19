<?php

namespace hiqdev\yii2\cart\behaviors;

use hiqdev\yii2\cart\CartPositionInterface;
use hiqdev\yii2\cart\ShoppingCart;
use yii\base\Behavior;
use yz\shoppingcart\CartActionEvent;

class EnsureDeleteRelatedPosition extends Behavior
{
    public function events()
    {
        return [
            ShoppingCart::EVENT_BEFORE_POSITION_REMOVE => 'removeRelated',
        ];
    }

    public function removeRelated(CartActionEvent $event): void
    {
        /** @var ShoppingCart $cart */
        $cart = $event->sender;
        /** @var CartPositionInterface $position */
        $position = $event->position;
        if ($related = $cart->findRelatedFor($position)) {
            $cart->remove($related);
        }
    }
}
