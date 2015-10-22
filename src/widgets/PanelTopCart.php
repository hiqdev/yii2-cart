<?php

namespace hipanel\modules\cart\widgets;

use Yii;

class PanelTopCart extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('PanelTopCart_view', [
            'view' => $this->getView(),
        ]);
    }
}
