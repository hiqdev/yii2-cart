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
use Yii;

class CartTeaser extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('CartTeaser', [
            'widget' => $this,
            'view'   => $this->getView(),
            'cart'   => $this->getModule()->getCart(),
        ]);
    }

    public function getModule()
    {
        return Module::getInstance();
    }

    public function registerCartClearJs(): void
    {
        $errorMessage = Yii::t('cart', 'Sorry, but now it is impossible to remove this position from cart now.');

        $this->getView()->registerJs(<<<JS
$('.cart-remove, .cart-clear, .cart-remove > .fa').on('click', function(event) {
    var url = event.target.dataset.action || $(this).parent().data('action');
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        error: function() {
            hipanel.notify.error('$errorMessage');
        }
    });
    hipanel.updateCart(function() {
        $('.dropdown.notifications-cart a.dropdown-toggle').attr('aria-expanded', true);
        $("li.dropdown.notifications-menu.notifications-cart").addClass('open');
    });
});
JS
        );
    }
}
