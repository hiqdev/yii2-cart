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
 * It is intended to be used in classes implementing [[CartPositionInterface]].
 * Holds:
 * - object (model) and ID.
 * - name and description
 * Provides:
 * - icon with getIcon() to be redefined in childs
 */
trait CartPositionTrait
{
    use \yz\shoppingcart\CartPositionTrait;

    /**
     * @var Model object being put in cart
     */
    protected $_model;

    /**
     * @var string|int ID of object being put in cart
     */
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
     * This closure will be called in [[GridView::rowOptions]].
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

    public function renderBuyMoreLink(): string
    {
        return '';
    }

    public function getModel()
    {
        return $this->_model;
    }
}
