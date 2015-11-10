<?php

use hipanel\modules\cart\widgets\QuantityCell;
use yii\helpers\Html;

?>

<?= Html::beginForm('update-quantity', 'post', ['id' => $model->id]) ?>

<?= Html::hiddenInput('id', $model->id) ?>

<?php if ($type == QuantityCell::MODE_SELECT) : ?>
    <?= Html::dropDownList('quantity', $model->quantity, $model->getQuantityOptions(), ['class' => 'form-control quantity-field']) ?>
<?php else : ?>
    <?= Html::input('number', 'quantity', $model->quantity, ['class' => 'form-control quantity-field', 'min' => 1, 'max' => 99, 'step' => 1]) ?>
<?php endif; ?>

<?= Html::endForm() ?>
