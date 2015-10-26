<?php

namespace hipanel\modules\cart\grid;

use hipanel\helpers\ArrayHelper;
use hiqdev\xeditable\grid\XEditableColumn;
use hiqdev\xeditable\widgets\XEditable;
use Yii;

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
        if ($this->xEditableType == 'select') {
            $this->pluginOptions = ArrayHelper::merge(['source' => $model->getQuantityOptions()], $this->pluginOptions);
        }

        return Yii::createObject(ArrayHelper::merge([
            'class' => XEditable::className(),
            'model' => $model,
            'attribute' => $this->attribute,
            'pluginOptions' => $this->pluginOptions
        ], $this->widgetOptions))->run();
    }
}