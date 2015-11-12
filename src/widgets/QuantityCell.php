<?php

/*
 * Cart module for yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\widgets;

class QuantityCell extends \yii\base\Widget
{
    const MODE_SELECT = 'select';

    const MODE_NUMBER = 'number';

    public $model;

    public $type;

    public function init()
    {
        parent::init();
        $this->registerClientScript();
    }

    public function run()
    {
        return $this->render('QuantityCell_view', [
            'view'  => $this->getView(),
            'model' => $this->model,
            'type'  => $this->type ?: self::MODE_SELECT,
        ]);
    }

    public function registerClientScript()
    {
        $this->getView()->registerJs(<<<JS
            jQuery(document).on('change', '.quantity-field', function(evnet) {
                var form = jQuery(this).parents('form').get(0);
                $(form).submit();
            });
JS
        );
    }
}
