<?php

use yii\helpers\Html;

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
                    <li>
                        <div class="row">
                            <div class="col-lg-10">
                                <a href="<?= $widget->module->createUrl() ?>">
                                    <?= $position->renderDescription() ?>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <?= Html::a('<i class="fa fa-times text-danger"></i>', ['remove', 'id' => $positionKey]) ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </li>
        <li class="footer"><?= Html::a(Yii::t('cart', 'Clear cart'), ['clear']) ?></li>
        <li class="footer"><?= Html::a(Yii::t('cart', 'View cart'), $widget->module->createUrl()) ?></li>
    <?php else : ?>
        <li class="header">
            <div class="row">
                <div class="col-md-6"><?= Yii::t('cart', 'Your cart is empty') ?></div>
            </div>
        </li>
    <?php endif ?>
</ul>
