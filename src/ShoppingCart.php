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

use hipanel\modules\finance\cart\AbstractCartPosition;
use Yii;
use yz\shoppingcart\CartActionEvent;

/**
 * Class ShoppingCart.
 * @property AbstractCartPosition[] $positions
 */
class ShoppingCart extends \yz\shoppingcart\ShoppingCart
{
    /**
     * @var AbstractCartPosition[]
     * TODO make local AbstractCartPosition
     */
    protected $_positions = [];

    /**
     * The cart module.
     */
    public $module;

    /**
     * @return integer
     */
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
        if (!empty($this->_positions)) {
            return reset($this->_positions)->currency;
        }

        return Yii::$app->params['currency'];
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
}
