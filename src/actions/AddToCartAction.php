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
     * Returns the cart module.
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

        if (!$this->bulkLoad) {
            $data = [$request->post() ?: $request->get()];
            $collection->load($data);
        } else {
            $collection->load();
        }

        foreach ($collection->models as $position) {
            /** @var CartPositionInterface $position */
            if (!$position->validate()) {
                $error = $collection->getFirstError();
                if (empty($error)) {
                    $error = Yii::t('cart', 'Failed to add item to the cart');
                }
                Yii::$app->session->addFlash('warning', $error);
                Yii::warning('Failed to add item to cart', 'cart');

                continue;
            }

            if (!$cart->hasPosition($position->getId())) {
                $cart->put($position);
                Yii::$app->session->addFlash('success', Yii::t('cart', 'Item has been added to cart'));
            } else {
                Yii::$app->session->addFlash('warning', Yii::t('cart', 'Item is already in the cart'));
            }
        }

        if ($request->isAjax) {
            Yii::$app->end();
        }

        return $this->controller->redirect($request->referrer ?: $this->controller->goHome());
    }
}
