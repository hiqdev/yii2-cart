<?php

/*
 * Cart Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-cart
 * @package   hipanel-module-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use hiqdev\yii2\cart\Module;

/**
 * Cart controller.
 */
class CartController extends \yii\web\Controller
{
    public function getCart()
    {
        return Module::getInstance()->getCart();
    }

    public function actionIndex()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->getCart()->getPositions(),
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);
        return $this->render('index', [
            'cart'         => $this->getCart(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRemove($id)
    {
        $this->getCart()->removeById($id);

        if (Yii::$app->request->isAjax)
            Yii::$app->end();

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
                $this->redirect('index');
            }
        }

        throw new NotFoundHttpException();
    }

    public function actionClear()
    {
        $this->getCart()->removeAll();

        if (Yii::$app->request->isAjax)
            Yii::$app->end();

        return $this->redirect(['index']);
    }
}
