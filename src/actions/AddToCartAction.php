<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\actions;

use hiqdev\hiart\Collection;
use hiqdev\yii2\cart\CartPositionInterface;
use hiqdev\yii2\cart\Module as CartModule;
use Yii;

class AddToCartAction extends \yii\base\Action
{
    /**
     * @var CartPositionInterface The class for new product
     */
    public $productClass;

    /**
     * @var boolean whether the action expects bulk models load using `selection`
     */
    public $bulkLoad = false;

    /**
     * Returns the cart module
     * @return CartModule
     */
    public function getCartModule()
    {
        return CartModule::getInstance();
    }

    public function run()
    {
        $data = null;
        $cart = $this->getCartModule()->getCart();
        $request = Yii::$app->request;
        /** @var CartPositionInterface $model */
        $model = Yii::createObject($this->productClass);
        $collection = new Collection(); // TODO: drop dependency
        $collection->setModel($model);

        if ($this->bulkLoad) {
            $data = [];
            $selection = $request->post('selection');
            foreach ($selection as $id) {
                $data[$id] = [reset($model->primaryKey()) => $id];
            }
        } else {
            $data = [$request->post() ?: $request->get()];
        }

        if ($collection->load($data) && $collection->validate()) {
            foreach ($collection->models as $position) {
                /** @var CartPositionInterface $position */
                if (!$cart->hasPosition($position->getId())) {
                    $cart->put($position);
                    Yii::$app->session->addFlash('success', Yii::t('cart', 'Item has been added to cart'));
                } else {
                    Yii::$app->session->addFlash('warning', Yii::t('cart', 'Item is in the cart already'));
                }
            }
        } else {
            Yii::$app->session->addFlash('warning', Yii::t('cart', 'Failed to add item to the cart'));
            Yii::warning('Failed to add item to the cart', 'cart');
        }

        if ($request->isAjax) {
            Yii::$app->end();
        }

        return $this->controller->redirect($request->referrer ?: $this->controller->goHome());
    }
}
