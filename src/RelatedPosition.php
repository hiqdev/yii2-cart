<?php

namespace hiqdev\yii2\cart;

use hipanel\modules\finance\logic\Calculator;

abstract class RelatedPosition implements RelatedPositionInterface
{
    /** @var CartPositionInterface */
    public $mainPosition;

    /** @var ShoppingCart */
    public $cart;

    public function __construct(CartPositionInterface $mainPosition)
    {
        $this->cart = Module::getInstance()->getCart();
        $this->mainPosition = $mainPosition;
    }

    /** @inheritDoc */
    public function render(): string
    {
        return $this->getWidget()->run();
    }

    public function calculate(CartPositionInterface $position): CartPositionInterface
    {
        $calculator = new Calculator([$position]);
        $calculationId = $position->getCalculationModel()->calculation_id;
        $calculation = $calculator->getCalculation($calculationId);
        $value = $calculation->forCurrency($this->cart->getCurrency());
        $position->setPrice($value->price);
        $position->setValue($value->value);
        $position->setCurrency($value->currency);

        return $position;
    }

}
