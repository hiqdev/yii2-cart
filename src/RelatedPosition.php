<?php

namespace hiqdev\yii2\cart;

use hipanel\modules\finance\logic\Calculator;
use yii\base\Widget;
use hiqdev\yii2\cart\ShoppingCart;
use hiqdev\yii2\cart\CartPositionInterface;
use Yii;

abstract class RelatedPosition implements RelatedPositionInterface
{
    /** @var Widget */
    public $widget;

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
    public function setWidget($className, array $params = []): RelatedPositionInterface
    {
        $this->widget = Yii::createObject(array_merge($params, [
            'class' => $className,
            'relatedPosition' => $this->createRelatedPosition(),
            'mainPosition' => $this->mainPosition,
            'cart' => $this->cart,
        ]));

        return $this;
    }

    /** @inheritDoc */
    public function render(): string
    {
        return $this->widget->run();
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
