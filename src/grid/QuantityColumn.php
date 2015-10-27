<?php

namespace hipanel\modules\cart\grid;

use hipanel\helpers\ArrayHelper;
use hiqdev\xeditable\grid\XEditableColumn;
use hiqdev\xeditable\widgets\XEditable;
use Yii;
use yii\helpers\Url;

class QuantityColumn extends XEditableColumn
{
    public $xEditableType;

    public $sourceData;

    public function init()
    {
        $this->pluginOptions['mode'] = 'inline';

        if ($this->xEditableType === null) {
            $this->pluginOptions['type'] = 'number';
        } else {
            $this->pluginOptions['type'] = $this->xEditableType;
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $quantityOptions = $model->getQuantityOptions();
        $xEditableVariant = ['select', 'checklist', 'typeahead', 'select2'];
        if (in_array($this->xEditableType, $xEditableVariant) || !empty($quantityOptions)) {
            $this->pluginOptions = ArrayHelper::merge(['source' => $quantityOptions], $this->pluginOptions);
        }
        $this->pluginOptions['url'] = ['update-quantity', 'id' => $model->id, 'quantity' => $model->quantity];

        return Yii::createObject(ArrayHelper::merge([
            'class' => XEditable::className(),
            'model' => $model,
            'attribute' => $this->attribute,
            'pluginOptions' => $this->pluginOptions
        ], $this->widgetOptions))->run();
    }
}