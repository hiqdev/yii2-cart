<?php

namespace hiqdev\yii2\cart\grid;

use hiqdev\xeditable\grid\XEditableColumn;
use hiqdev\xeditable\widgets\XEditable;
use Yii;
use yii\grid\DataColumn;

class QuantityColumn extends DataColumn
{
    public function getDataCellValue($model, $key, $index)
    {
        return $key;
    }
}
