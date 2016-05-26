<?php

use yii\helpers\Html;

/**
 * @var \hiqdev\yii2\cart\CartPositionInterface $model
 * @var \hiqdev\yii2\cart\widgets\QuantityCell $widget
 */

?>

<?= Html::beginForm('@cart/update-quantity', 'post', ['id' => $model->id]) ?>

<?= Html::hiddenInput('id', $model->id) ?>
<?php $quantityOptions = $model->getQuantityOptions(); ?>
<?php if (is_array($quantityOptions)) : ?>
    <?php if ($widget->isSelectMode()) : ?>
        <?= Html::dropDownList('quantity', $model->getQuantity(), $quantityOptions, ['class' => 'form-control quantity-field']) ?>
    <?php else : ?>
        <?= Html::input('number', 'quantity', $model->getQuantity(),
            ['class' => 'form-control quantity-field', 'min' => 1, 'max' => 99, 'step' => 1]) ?>
    <?php endif ?>
    <?php else : ?>
        <?= $quantityOptions ?>
<?php endif ?>

<?= Html::endForm() ?>
