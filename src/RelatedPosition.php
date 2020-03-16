<?php

namespace hiqdev\yii2\cart;

use yii\base\Widget;
use hiqdev\yii2\cart\ShoppingCart;
use Yii;

class RelatedPosition implements RelatedPositionInterface
{
    /** @var Widget */
    public $widget;

    /** @inheritDoc */
    public function setWidget($type, array $params = []): RelatedPositionInterface
    {
        $this->widget = Yii::createObject($type, $params);

        return $this;
    }

    /** @inheritDoc */
    public function render(): string
    {
        return $this->widget->run();
    }
}
