<?php

namespace hiqdev\yii2\cart\widgets;

use Yii;
use hiqdev\yii2\cart\Module;

class PanelTopCart extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('PanelTopCart_view', [
            'widget' => $this,
            'view'   => $this->getView(),
            'cart'   => $this->getModule()->getCart(),
        ]);
    }

    public function getModule()
    {
        return Module::getInstance();
    }
}
