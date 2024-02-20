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

use hiqdev\yii2\cart\NotPurchasableException;
use hiqdev\yii2\cart\ShoppingCart;
use hiqdev\yii2\cart\widgets\CartTeaser;
use Yii;
use yii\base\ViewContextInterface;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

/**
 * Cart controller.
 *
 * @property ShoppingCart $cart The shopping cart instance
 */
class CartController extends Controller implements ViewContextInterface
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

        $user = Yii::$app->user;
        if (!$user->isGuest && !$user->can('deposit')) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        $cart = $this->getCart();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $cart->getRootPositions(),
            'pagination' => false
        ]);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('index', [
                'cart' => $cart,
                'module' => $this->module,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('index', [
            'cart' => $cart,
            'module' => $this->module,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTopcart()
    {
        return $this->renderPartial('topcart', ['widgetClass' => CartTeaser::class]);
    }

    public function actionRemove($id)
    {
        try {
            $this->getCart()->removeById($id);
        } catch (NotPurchasableException $exception) {
            Yii::$app->getSession()->setFlash('error', $exception->getMessage());
            $exception->resolve();
        }

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
                try {
                    $this->getCart()->update($position, $quantity);
                } catch (NotPurchasableException $exception) {
                    Yii::$app->getSession()->setFlash('error', $exception->getMessage());
                    $exception->resolve();
                }

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
