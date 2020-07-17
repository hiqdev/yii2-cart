<?php


namespace hiqdev\yii2\cart;


interface PaymentMethodsProviderInterface
{
    /**
     * @return mixed
     */
    public function getPaymentMethods();
}
