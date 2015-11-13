<?php

use hiqdev\yii2\cart\widgets\QuantityCell;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('cart', 'Cart');
$this->params['breadcrumbs'][] = $this->title;

?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <?= Yii::t('cart', 'Your cart') ?>
                <small class="pull-right"><?= Yii::t('cart', 'Date') ?>: <?= date('Y-m-d') ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}\n{pager}",
                'columns' => [
                    [
                        'attribute' => 'no',
                        'label' => '#',
                        'value' => function ($model) { static $no;return ++$no; },
                        'headerOptions' => ['width' => '4%', 'style' => 'text-align: center'],
                        'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                    ],
                    [
                        'attribute' => 'name',
                        'format' => 'raw',
                        'label' => ' ' . Yii::t('cart', 'Description'),
                        'contentOptions' => ['style' => 'vertical-align: middle'],
                        'value' => function ($model) {
                            return $model->icon . ' ' . $model->name . ' ' . Html::tag('span', $model->description, ['class' => 'text-muted']);
                        },
                    ],
                    [
                        'attribute' => 'quantity',
                        'value' => function ($model, $key, $index, $column) {
                            return QuantityCell::widget(['model' => $model]); //, 'type' => 'number'
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'price',
                        'contentOptions' => ['style' => 'vertical-align: middle;white-space: nowrap;'],
                        'value' => function ($model) use ($cart) {
                            return $cart->formatCurrency($model->cost);
                        },
                    ],
                    'actions' => [
                        'class' => ActionColumn::className(),
                        'template' => '{remove}',
                        'headerOptions' => ['width' => '4%'],
                        'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                        'buttons' => [
                            'remove' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-times text-danger"></i>', ['remove', 'id' => $model['id']]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">Payment Methods:</p>
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/visa.png" alt="Visa">
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/mastercard.png" alt="Mastercard">
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/american-express.png"
                 alt="American Express">
            <img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
            </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:50%"><?= Yii::t('cart', 'Subtotal') ?>:</th>
                        <td><?= $cart->formatCurrency($cart->subtotal) ?></td>
                    </tr>
                    <tr>
                        <th><?= Yii::t('cart', 'Discount') ?>:</th>
                        <td><?= $cart->formatCurrency($cart->discount) ?></td>
                    </tr>
                    <tr style="font-size:130%">
                        <th><?= Yii::t('cart', 'Total') ?>:</th>
                        <td><b><?= $cart->formatCurrency($cart->total) ?></b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('cart', 'Clear cart'), ['clear'], ['class' => 'btn btn-default']); ?>
            <?= Html::a('<i class="fa fa-credit-card"></i> ' . Yii::t('cart', 'Make order'), ['clear'], ['class' => 'btn btn-success pull-right']); ?>
        </div>
    </div>
</section>
