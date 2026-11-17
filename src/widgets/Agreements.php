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

use hiqdev\yii2\cart\Module;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Checkboxes of the agreements the cart needs (see [[Module::agreements]]).
 *
 * The checkboxes and [[orderButton()]] belong to one form that posts to `cart/accept-agreements`.
 * The button stays inactive until every checkbox is checked.
 *
 * ```php
 * <?php if (Agreements::isNeeded($module)) : ?>
 *     <?= Agreements::widget(['module' => $module]) ?>
 *     <?= Agreements::orderButton('Make order', ['class' => 'btn btn-success']) ?>
 * <?php endif ?>
 * ```
 */
class Agreements extends Widget
{
    const FORM_ID = 'cart-agreements-form';

    /**
     * @var Module
     */
    public $module;

    /**
     * @var array HTML options of the tag of each agreement
     */
    public $itemOptions = ['class' => 'checkbox'];

    public static function isNeeded(Module $module): bool
    {
        return !empty($module->getActiveAgreements());
    }

    /**
     * Renders the button that submits the agreements.
     * Its class gets `btn-success` when every agreement is checked and `btn-default` otherwise.
     *
     * @param string $label HTML label, not encoded
     * @param array $options HTML options; `btn-success` in `class` is managed by the widget
     */
    public static function orderButton(string $label, array $options = []): string
    {
        $class = trim(preg_replace('/\bbtn-success\b/', '', $options['class'] ?? 'btn'));

        return Html::submitButton($label, array_merge([
            'id' => 'make-order-button',
        ], $options, [
            'class' => $class . ' btn-default',
            'form' => self::FORM_ID,
            'disabled' => true,
        ]));
    }

    public function run()
    {
        $agreements = $this->module->getActiveAgreements();
        if (empty($agreements)) {
            return '';
        }
        $this->registerClientScript();

        $items = [];
        foreach ($agreements as $name => $label) {
            // The name goes in the value: as a part of the field name PHP would mangle names like `a[b]`
            $checkbox = Html::checkbox('agreements[]', false, [
                'value' => (string) $name,
                'class' => 'cart-agreement',
                'autocomplete' => 'off',
                'form' => self::FORM_ID,
            ]);
            $items[] = Html::tag('div', Html::tag('label', $checkbox . ' ' . $label), $this->itemOptions);
        }

        return Html::beginForm($this->module->createUrl('accept-agreements'), 'post', ['id' => self::FORM_ID])
            . Html::endForm()
            . Html::tag('div', implode("\n", $items), ['class' => 'cart-agreements']);
    }

    private function registerClientScript(): void
    {
        // The server checks the agreements again: the order page does not open without them
        $this->getView()->registerJs(<<<'JS'
(function () {
    var $agreements = $('.cart-agreement');
    var $button = $('#make-order-button');
    var sync = function () {
        var accepted = $agreements.filter(':checked').length === $agreements.length;
        $button.prop('disabled', !accepted)
            .toggleClass('btn-success', accepted)
            .toggleClass('btn-default', !accepted);
    };
    $agreements.on('change', sync);
    sync();
})();
JS
        );
    }
}
