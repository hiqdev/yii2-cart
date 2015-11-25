<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\grid;

use yii\grid\DataColumn;

class QuantityColumn extends DataColumn
{
    public function getDataCellValue($model, $key, $index)
    {
        return $key;
    }
}
