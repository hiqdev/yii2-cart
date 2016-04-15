<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart;

use Yii;
use yii\base\Model;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * CartPositionTrait trait
 * It is intended to use this trait in classes, that extends [[Model]]
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

    /**
     * This closure will be called in [[GridView::rowOptions]]
     *
     * @param integer $key the key value associated with the current data model
     * @param integer $index the zero-based index of the data model in the model array returned by [[dataProvider]]
     * @param GridView $grid the GridView object
     * @return array
     */
    public function getRowOptions($key, $index, $grid)
    {
        return [];
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

    public function renderDescription()
    {
        return $this->getIcon() . ' ' . $this->getName() . ' ' . Html::tag('span', $this->getDescription(), ['class' => 'text-muted']);
    }

    public function getModel()
    {
        return $this->_model;
    }
}
