<?php

namespace hiqdev\yii2\cart\grid;

use hiqdev\yii2\cart\ShoppingCart;
use hiqdev\yii2\cart\CartPositionInterface;
use yii\grid\DataColumn;

class PriceColumn extends DataColumn
{
    /**
     * @var ShoppingCart
     */
    public $cart;

    public $format = 'html';

    public $contentOptions = ['style' => 'vertical-align: middle; white-space: nowrap;'];

    /**
     * @param CartPositionInterface $position
     * @param mixed $key
     * @param int $index
     * @return string
     */
    public function getDataCellValue($position, $key, $index): string
    {
        $price = $this->cart->formatCurrency($position->cost, $position->currency);
        if ($relatedPosition = $this->cart->findRelatedFor($position)) {
            $price .= sprintf(
                '&nbsp;+&nbsp;<span class="text-success text-bold">%s</span>',
                $this->cart->formatCurrency($relatedPosition->getCost(), $relatedPosition->currency)
            );
        }

        return $price;
    }
}
