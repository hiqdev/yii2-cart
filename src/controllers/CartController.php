<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\controllers;

use hiqdev\yii2\cart\ShoppingCart;
use hiqdev\yii2\cart\widgets\CartTeaser;
use Yii;
use yii\base\ViewContextInterface;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Cart controller.
 *
 * @property ShoppingCart $cart The shopping cart instance
 */
class CartController extends \yii\web\Controller implements ViewContextInterface
{
    /**
     * @return ShoppingCart
     */
    public function getCart()
    {
        return $this->module->getCart();
    }

    public function actionIndex()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->getCart()->getPositions(),
            'pagination' => false
        ]);

        return $this->render('index', [
            'cart' => $this->getCart(),
            'module' => $this->module,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTopcart()
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('topcart', ['widgetClass' => CartTeaser::class]);
        }

        Yii::$app->end();
    }

    public function actionRemove($id)
    {
        $this->getCart()->removeById($id);

        if (Yii::$app->request->isAjax) {
            Yii::$app->end();
        }

        return $this->redirect(['index']);
    }

    public function actionUpdateQuantity()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');
        $quantity = $request->post('quantity');
        if ($id && $quantity) {
            $position = $this->getCart()->getPositionById($id);
            if ($position) {
                $this->getCart()->update($position, $quantity);

                return $this->redirect('index');
            }
        }

        throw new NotFoundHttpException('Either position ID or Quantity is not set');
    }

    public function actionClear()
    {
        $this->getCart()->removeAll();

        if (Yii::$app->request->isAjax) {
            Yii::$app->end();
        }

        return $this->redirect(['index']);
    }

    public function getViewPath()
    {
        if ($this->getCart()->module->viewPath) {
            return Yii::getAlias($this->getCart()->module->viewPath . DIRECTORY_SEPARATOR . 'cart');
        }

        return parent::getViewPath();
    }
}
