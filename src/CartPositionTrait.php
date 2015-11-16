<?php

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
            'quantity'    => Yii::t('cart', 'Name'),
            'description' => Yii::t('cart', 'Description'),
        ];
    }

    public function attributes()
    {
        return [
            'model_id',
            'name',
            'quantity',
            'description'
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
