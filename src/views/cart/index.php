<?php

use hiqdev\yii2\cart\widgets\QuantityCell;
use hiqdev\yii2\cart\CartPositionInterface;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('cart', 'Cart');
$this->params['breadcrumbs'][] = $this->title;

/** @var \yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \hiqdev\yii2\cart\ShoppingCart $cart */
/** @var \hiqdev\yii2\cart\Module $module */
?>

<section class="box box-widget">

    <div class="invoice-overlay overlay" style="display: none">
        <i class="fa fa-refresh fa-spin"></i>
    </div>

    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-shopping-cart"></i> &nbsp;
            <?= Yii::t('cart', 'Your order') ?>:
            &nbsp; <?= Yii::t('cart', '{0, plural, one{# position} other{# positions}}', $cart->count) ?>
        </h3>
        <div class="box-tools pull-right">
            <small><?= Yii::t('cart', 'Date') ?> : <?= Yii::$app->formatter->asDate(new DateTime()) ?></small>
        </div>
    </div>

    <div class="box-body">
    <div class="row">
        <div class="col-md-12">
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '{items}',
                'options' => ['class' => 'grid-view table-responsive'],
                'rowOptions' => function (CartPositionInterface $position, $key, $index, $grid) {
                    return $position->getRowOptions($key, $index, $grid);
                },
                'columns' => [
                    [
                        'attribute' => 'no',
                        'label' => '#',
                        'value' => function ($model) {
                            static $no;

                            return ++$no;
                        },
                        'headerOptions' => ['width' => '4%', 'style' => 'text-align: center'],
                        'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                    ],
                    [
                        'attribute' => 'name',
                        'format' => 'raw',
                        'label' => Yii::t('cart', 'Description'),
                        'contentOptions' => ['style' => 'vertical-align: middle;', 'width' => '60%'],
                        'value' => static function (CartPositionInterface $cartPosition): string {
                            return $cartPosition->renderDescription();
                        },
                    ],
                    [
                        'attribute' => 'quantity',
                        'label' => Yii::t('cart', 'Quantity'),
                        'contentOptions' => ['style' => 'vertical-align: middle'],
                        'value' => function ($model, $key, $index, $column) {
                            return QuantityCell::widget(['model' => $model]); //, 'type' => 'number'
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'price',
                        'format' => 'raw',
                        'label' => Yii::t('cart', 'Price'),
                        'contentOptions' => ['style' => 'vertical-align: middle;white-space: nowrap;'],
                        'value' => static function (CartPositionInterface $position) use ($cart): string {
                            $price = $cart->formatCurrency($position->cost, $position->currency);
                            if ($relatedPosition = $cart->findRelatedFor($position)) {
                                $relatedPosition->setQuantity($position->getQuantity());
                                $price .= sprintf(
                                    '&nbsp;<span class="text-success text-bold">+ %s</span>',
                                    $cart->formatCurrency($relatedPosition->getCost(false), $relatedPosition->currency)
                                );
                            }

                            return $price;
                        },
                    ],
                    'actions' => [
                        'class' => ActionColumn::class,
                        'template' => '{remove}',
                        'headerOptions' => ['width' => '4%'],
                        'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                        'buttons' => [
                            'remove' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-times text-danger"></i>', ['remove', 'id' => $model->id]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($module->cart->additionalLinks)) : ?>
            <div class="col-md-12" style="margin-bottom: 1em;">
                <?= Html::tag('p', Yii::t('cart', 'Additional Links'), ['class' => 'lead']) ?>
                <?php foreach ($module->cart->additionalLinks as $url => $label) : ?>
                    <?= Html::a($label, $url, ['class' => 'btn bg-olive btn-flat']) ?>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <!-- accepted payments column -->
        <div class="col-md-8">
            <?= $module->paymentMethods ?>
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <p class="lead"><?= Yii::t('cart', 'Amount due') ?>:</p>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:30%"><?= Yii::t('cart', 'Subtotal') ?>:</th>
                        <td style="width:30%" align="right"><?= $cart->formatCurrency($cart->subtotal) ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th><?= Yii::t('cart', 'Discount') ?>:</th>
                        <td align="right"><?= $cart->formatCurrency($cart->discount) ?></td>
                        <td></td>
                    </tr>
                    <tr style="font-size:130%;font-weight:bold">
                        <th><?= Yii::t('cart', 'Total') ?>:</th>
                        <td align="right"><?= $cart->formatCurrency($cart->total) ?></td>
                        <td></td>
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
        <div class="col-md-4 col-xs-12">
            <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('cart', 'Clear cart'), ['clear'], [
                'class' => 'btn btn-default',
                'data-ga-clear' => true,
            ]); ?>
        </div>
        <?php if (!empty($cart->positions)) : ?>
            <div class="col-md-8 col-xs-12">
                <span class="pull-right">
                    <?php if ($module->orderButton) : ?>
                        <?= $module->orderButton ?>
                    <?php else : ?>
                        <?= Html::a('<i class="fa fa-credit-card"></i> ' . Yii::t('cart', 'Make order'), $module->orderPage, [
                            'id' => 'make-order-button',
                            'class' => 'btn btn-success',
                            'data-ga-confirm' => true,
                        ]); ?>
                    <?php endif ?>
                </span>
            </div>
        <?php endif; ?>
    </div>
    </div>
</section>

<?php
    $this->registerJS(<<<JS
    hipanel.googleAnalytics($('[data-ga-confirm]'), {
        'category': 'cart',
        'action': 'confirm'
    });
    hipanel.googleAnalytics($('[data-ga-clear]'), {
        'category': 'cart',
        'action': 'clear'
    });
JS
);
