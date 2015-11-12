<?php

namespace hiqdev\yii2\cart\widgets;

use Yii;

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
