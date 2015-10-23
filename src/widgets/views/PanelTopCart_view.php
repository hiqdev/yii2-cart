<?php

use \Yii;
use yii\helpers\Html;

?>
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
    <a  class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-shopping-cart  fa-lg"></i>
        <span class="label label-warning"><?= Yii::$app->cart->getCount(); ?></span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">
            <div class="row">
                <div class="col-md-6 text-bold"><?= Yii::t('app', 'Total:') ?></div>
                <!-- /.col-md-6 -->
                <div class="col-md-6 text-right"><?= Yii::$app->cart->getCost(); ?></div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <?php if (Yii::$app->cart->getCount() > 0) : ?>
                    <?php foreach (Yii::$app->cart->getPositions() as $position) : ?>
                        <li>
                            <a>
                                <?= $position->icon ?> <?= $position->name; ?> | <?= $position->description ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </li>
        <li class="footer"><?= Html::a(Yii::t('app', 'View Cart'), '/cart/cart/index'); ?></li>
    </ul>
</li>