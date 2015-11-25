<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart;

use Yii;

/**
 * CartPositionTrait trait.
 */
trait CartPositionTrait
{
    use \yz\shoppingcart\CartPositionTrait;

    /**
     * @var Model
     */
    protected $_model;

    protected $_id;

    public function rules()
    {
        return [
            [['model_id'], 'integer', 'min' => 1],
            [['name', 'description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'model_id'    => Yii::t('cart', 'ID'),
            'name'        => Yii::t('cart', 'Name'),
            'price'       => Yii::t('cart', 'Price'),
            'quantity'    => Yii::t('cart', 'Quantity'),
            'description' => Yii::t('cart', 'Description'),
        ];
    }

    public function attributes()
    {
        return [
            'model_id',
            'name',
            'quantity',
            'description',
        ];
    }

    public function getIcon()
    {
        return '<i class="fa fa-check"></i>';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
