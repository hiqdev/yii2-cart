<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \hiqdev\yii2\cart\ShoppingCart $cart
 * @var \hiqdev\yii2\cart\widgets\CartTeaser $widget
 * @var \yii\web\View $this
 */

$this->registerCss(<<<CSS
.navbar-nav > .notifications-menu > .dropdown-menu > li .menu > li > a {
    border-bottom: none;
}
.cart-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    border-bottom: 1px solid #f4f4f4;
}
.cart-item {
    width: 245px;
}
.cart-remove > i {
    width: 12px !important;
    color: grey;
}
CSS
);

$widget->registerCartClearJs();

?>
<a class="dropdown-toggle" data-toggle="dropdown" href="#">
    <i class="fa fa-shopping-cart fa-lg"></i>
    <span class="label label-<?= $cart->count ? 'warning' : 'default' ?>"><?= count($cart->positions) ?></span>
</a>
<ul class="dropdown-menu">
    <?php if ($cart->count) : ?>
        <li class="header">
            <div class="row">
                <div class="col-md-4"><?= Html::a(Yii::t('cart', 'Cart'), $widget->module->createUrl()) ?>:</div>
                <div class="col-md-8 text-bold text-right">
                    <?= Yii::t('cart', 'Total') ?> : <?= $cart->formatCurrency($cart->total) ?>
                </div>
            </div>
        </li>
        <li>
            <ul class="menu">
                <?php foreach ($cart->positions as $positionKey => $position) : ?>
                    <?php /** @var \hiqdev\yii2\cart\CartPositionTrait $position */ ?>
                    <li class="cart-row">
                        <?= Html::a($position->renderDescription(), [$widget->module->createUrl(), 'id' => $positionKey], ['class' => 'cart-item']) ?>
                        <?= Html::a('<i class="fa fa-times"></i>', '#', ['class' => 'cart-remove', 'data-action' => Url::to(['@cart/remove', 'id' => $positionKey])]) ?>
                    </li>
                <?php endforeach ?>
            </ul>
        </li>
        <li class="footer"><?= Html::a(Yii::t('cart', 'Clear cart'), '#', ['class' => 'cart-clear', 'data-action' => Url::to('@cart/clear')]) ?></li>
        <li class="footer"><?= Html::a(Yii::t('cart', 'View cart'), $widget->module->createUrl()) ?></li>
    <?php else : ?>
        <li class="header">
            <div class="row">
                <div class="col-md-6"><?= Yii::t('cart', 'Your cart is empty') ?></div>
            </div>
        </li>
    <?php endif ?>
</ul>
