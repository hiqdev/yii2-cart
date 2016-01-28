<?php

use yii\helpers\Html;

?>
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
    <a class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-shopping-cart fa-lg"></i>
        <span class="label label-<?= $cart->count ? 'warning' : 'default' ?>"><?= count($cart->positions) ?></span>
    </a>
    <ul class="dropdown-menu">
        <?php if ($cart->count) : ?>
            <li class="header">
                <div class="row">
                    <div class="col-md-4"><?= Html::a(Yii::t('cart', 'Cart'), $widget->module->createUrl()) ?>:</div>
                    <div class="col-md-8 text-bold text-right"><?= Yii::t('cart', 'Total') ?>: <?= $cart->formatCurrency($cart->total) ?></div>
                </div>
            </li>
            <li>
                <ul class="menu">
                    <?php foreach ($cart->positions as $position) : ?>
                        <li>
                            <a href="<?= $widget->module->createUrl() ?>">
                                <?= $position->icon ?> <?= $position->name ?> <?= Html::tag('span', $position->description, ['class' => 'text-muted']) ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>
            <li class="footer"><?= Html::a(Yii::t('cart', 'View cart'), $widget->module->createUrl()) ?></li>
        <?php else : ?>
            <li class="header">
                <div class="row">
                    <div class="col-md-6"><?= Yii::t('cart', 'Your cart is empty') ?></div>
                </div>
            </li>
        <?php endif ?>
    </ul>
</li>
