<?php

namespace hiqdev\yii2\cart;

use yii\base\Exception;

/**
 * Interface PositionPurchasabilityValidatorInterface is thrown when cart
 * invariant validation restricts further purchase.
 */
abstract class NotPurchasableException extends Exception
{
    /** @var CartPositionInterface|null */
    protected $position;

    /**
     * @var ShoppingCart
     */
    protected $cart;

    public static function forPosition(CartPositionInterface $position, ShoppingCart $cart, string $message = '')
    {
        $exception = new static($message);

        $exception->position = $position;
        $exception->cart = $cart;

        return $exception;
    }

    public static function forCart(ShoppingCart $cart, string $message = '')
    {
        $exception = new static($message);

        $exception->cart = $cart;

        return $exception;
    }

    public function getName()
    {
        return 'Position is not purchasable';
    }

    /**
     * Method SHOULD BE called when exception is caught.
     * Child classes may override this method and add problem auto-resolving.
     *
     * @return bool whether exception was automatically resolved
     */
    public function resolve(): bool
    {
        return false;
    }
}
