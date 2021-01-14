<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart;

use hiqdev\yii2\cart\behaviors\EnsureDeleteRelatedPosition;
use Yii;
use yii\base\Event;
use yz\shoppingcart\CartActionEvent;

/**
 * Class ShoppingCart.
 * @property CartPositionInterface[] $positions
 */
class ShoppingCart extends \yz\shoppingcart\ShoppingCart
{
    /**
     * @var CartPositionInterface[]
     * TODO make local AbstractCartPosition
     */
    protected $_positions = [];

    /**
     * The cart module.
     */
    public $module;

    public function behaviors()
    {
        return [
            [
                'class' => EnsureDeleteRelatedPosition::class,
            ]
        ];
    }

    /**
     * @return integer
     */
    public function getCount(): int
    {
        $count = 0;
        foreach ($this->_positions as $position) {
            if (!$position->hasParent()) {
                $count += 1;
            }
        }

        return $count;
    }

    public function findRelatedFor(CartPositionInterface $parent): ?CartPositionInterface
    {
        foreach ($this->_positions as $position) {
            if ($position->hasParent() && $position->parent_id === $parent->getId()) {
                return $position;
            }
        }

        return null;
    }

    /**
     * @return CartPositionInterface[]
     */
    public function getRootPositions(): array
    {
        return array_filter($this->getPositions(), static function (CartPositionInterface $position): bool {
            return !$position->hasParent();
        });
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
        return $sum !== null ? Yii::$app->formatter->format($sum, ['currency', $currency ?? $this->getCurrency()]) : '--';
    }

    /**
     * Sets cart from serialized string
     * @param string $serialized
     */
    public function setSerialized($serialized)
    {
        try {
            parent::setSerialized($serialized);
        } catch (\Exception $e) {
            Yii::error('Failed to unserlialize cart: ' . $e->getMessage(), __METHOD__);
            $this->_positions = [];
            $this->saveToSession();
        }
    }

    /**
     * Checks whether any of cart positions has error in `id` attribute.
     * @return boolean
     */
    public function hasErrors()
    {
        foreach ($this->_positions as $position) {
            if ($position->hasErrors('id')) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param CartPositionInterface[] $positions
     */
    public function putPositions($positions)
    {
        foreach ($positions as $position) {
            if (isset($this->_positions[$position->getId()])) {
                if ($position instanceof DontIncrementQuantityWhenAlreadyInCart) {
                    continue;
                }
                $existingPosition = $this->_positions[$position->getId()];
                $existingPosition->setQuantity($existingPosition->getQuantity() + 1);
            } else {
                if ($position->getQuantity() <= 0) {
                    $position->setQuantity(1);
                }
                $this->_positions[$position->getId()] = $position;
                $this->trigger(self::EVENT_POSITION_PUT, new CartActionEvent([
                    'action' => CartActionEvent::ACTION_POSITION_PUT,
                    'position' => $position,
                ]));
            }
        }

        $this->trigger(self::EVENT_CART_CHANGE, new CartActionEvent([
            'action' => CartActionEvent::ACTION_POSITION_PUT,
        ]));
        if ($this->storeInSession)
            $this->saveToSession();
    }

    public function getCurrency(): ?string
    {
        $defaultCurrency = Yii::$app->params['currency'];
        if (!empty($this->_positions)) {
            return reset($this->_positions)->currency ?? $defaultCurrency;
        }

        return $defaultCurrency;
    }

    /**
     * @return array
     */
    public function getAdditionalLinks(): array
    {
        $links = [];
        $positions = $this->_positions;
        if (empty($positions)) {
            return $links;
        }

        foreach ($positions as $position) {
            $additionalLinks = $position->getAdditionalLinks();
            if (!empty($additionalLinks)) {
                foreach ($additionalLinks as $link) {
                    [$url, $label] = $link;
                    if ($url && $label && !isset($links[$url])) {
                        $links[$url] = $label;
                    }
                }
            }
        }

        return $links;
    }

    /**
     * @var CartActionEvent[]|null
     */
    private $_accumulatedEvents;
    public function trigger($name, Event $event = null)
    {
        if (is_array($this->_accumulatedEvents)) {
            \Yii::info("Shopping cart accumulates event $name");
            $this->_accumulatedEvents[] = [$name, $event];
        } else {
            parent::trigger($name, $event);
        }
    }

    /**
     * Runs $closure and accumulates all events occurred during $closure run.
     * Events get released immediately after a success $closure run.
     *
     * The method can be used to prevent useless calculations that happen after
     * bunch of similar updates on a cart.
     *
     * @param \Closure $closure
     */
    public function accumulateEvents(\Closure $closure): void
    {
        $this->_accumulatedEvents = [];
        try {
            $closure();
            $events = $this->_accumulatedEvents;
            $this->_accumulatedEvents = null;
            foreach ($events as [$name, $event]) {
                \Yii::info("Releases event $name");
                $this->trigger($name, $event);
            }
        } finally {
            $this->_accumulatedEvents = null;
        }
    }
}
