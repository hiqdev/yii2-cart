<?php

namespace hiqdev\yii2\cart;

use \yii\base\Widget;
use Yii;

interface RelatedPositionInterface
{
    public function getWidget(): Widget;

    public function createRelatedPosition(): CartPositionInterface;

    public function render(): string;
}
