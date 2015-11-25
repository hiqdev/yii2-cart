<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\widgets;

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
