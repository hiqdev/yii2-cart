<?php

namespace hiqdev\yii2\cart;

use \yii\base\Widget;

interface RelatedPositionInterface
{
    /**
     * @param $type
     * @param array $params
     * @see \Yii::createObject()
     */
    public function setWidget($type, array $params = []): RelatedPositionInterface;

    public function createRelatedPosition(): CartPositionInterface;

    public function render(): string;
}
