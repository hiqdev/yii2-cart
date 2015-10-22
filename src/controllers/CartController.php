<?php

/*
 * Cart Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-cart
 * @package   hipanel-module-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hipanel\modules\cart\controllers;

/**
 * Cart controller.
 */
class CartController extends \hipanel\base\Controller
{
    public function actionIndex()
    {
        return $this->render('index', []);
    }
}
