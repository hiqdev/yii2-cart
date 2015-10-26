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
use hipanel\modules\domain\models\Domain;
use hipanel\modules\domain\models\DomainProduct;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use yz\shoppingcart\ShoppingCart;

/**
 * Cart controller.
 */
class CartController extends \hipanel\base\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => Yii::$app->cart->getPositions(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRemove($id)
    {
        Yii::$app->cart->removeById($id);

        if (Yii::$app->request->isAjax)
            Yii::$app->end();

        return $this->redirect(['index']);
    }

    public function actionAdd()
    {
        $cart = Yii::$app->cart;
        $cart->removeAll();

        $model = new DomainProduct([
            'model' => Domain::find()->where(['login' => 'rubbertire'])->one()
        ]);
        if ($model) {
            $cart->put($model, 1);
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException();
    }

    public function actionClear()
    {
        Yii::$app->cart->removeAll();

        if (Yii::$app->request->isAjax)
            Yii::$app->end();

        return $this->redirect(['index']);
    }
}
