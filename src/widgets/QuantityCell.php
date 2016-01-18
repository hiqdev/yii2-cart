<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
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
            'view'   => $this->getView(),
            'model'  => $this->model,
            'widget' => $this,
        ]);
    }

    /**
     * Select is default mode.
     */
    public function isSelectMode()
    {
        return $this->type !== self::MODE_NUMBER && method_exists($this->model, 'getQuantityOptions');
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
