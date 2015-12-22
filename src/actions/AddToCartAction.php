<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\actions;

use hipanel\modules\domain\models\Domain;
use hiqdev\hiart\Collection;
use hiqdev\yii2\cart\Module;
use Yii;

class AddToCartAction extends \yii\base\Action
{
    public $productClass;

    public $bulkLoad = false;

    public function getModule()
    {
        return Module::getInstance();
    }

    public function run()
    {
        $data = null;
        $cart = $this->getModule()->getCart();
        $request = Yii::$app->request;
        $model = new $this->productClass();
        $collection = new Collection();
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
                if (!$cart->hasPosition($position->getId())) {
                    $cart->put($position);
                    Yii::$app->session->addFlash('success', Yii::t('cart', 'Item has been added to cart'));
                } else {
                    Yii::$app->session->addFlash('warning', Yii::t('cart', 'Item is in the cart already'));
                }
            }
        } else {
            Yii::$app->session->addFlash('warning', Yii::t('cart', 'Item does not exists'));
        }

        if ($request->isAjax) {
            Yii::$app->end();
        } else {
            return $this->controller->redirect($request->referrer);
        }
    }
}
