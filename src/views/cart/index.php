<?php

use hipanel\modules\cart\grid\QuantityColumn;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Cart');
$this->params['breadcrumbs'][] = $this->title;

?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <?= Yii::t('app', 'Your cart') ?>
                <small class="pull-right">Date: 2/10/2014</small>
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
//                    'id',
                    [
                        'attribute' => 'name',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->icon . ' ' . $model->name . ' ' . Html::tag('span', $model->description, ['class' => 'text-muted']);
                        }
                    ],
                    [
                        'class' => QuantityColumn::className(),
//                        'class' => 'hiqdev\xeditable\grid\XEditableColumn',
                        'xEditableType' => 'select',
                        'attribute' => 'quantity',
                        'pluginOptions' => [
                            'url' => 'set-description',
                        ],
                    ],
                    'price',
                    'actions' => [
                        'class' => ActionColumn::className(),
                        'template' => '{remove}',
                        'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                        'buttons' => [
                            'remove' => function ($url, $model, $key) {
                                return Html::a('<span aria-hidden="true" style="font-size: 2rem;">&times;</span>', ['remove', 'id' => $model['id']]);
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
                        <th style="width:50%"><?= Yii::t('app', 'Subtotal') ?>:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th><?= Yii::t('app', 'Discount') ?>:</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th><?= Yii::t('app', 'Total') ?>:</th>
                        <td><?= Yii::$app->cart->getCost(true); ?></td>
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
            <?= Html::a('<i class="fa fa-refresh"></i> ' . Yii::t('app', 'Clear cart'), ['clear'], ['class' => 'btn btn-default']); ?>
            <?= Html::a('<i class="fa fa-credit-card"></i> ' . Yii::t('app', 'Make oreder'), ['clear'], ['class' => 'btn btn-success pull-right']); ?>
        </div>
    </div>
</section>