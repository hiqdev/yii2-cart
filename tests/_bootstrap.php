<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

error_reporting(E_ALL & ~E_NOTICE);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
Yii::setAlias('@hiqdev/yii2/cart', dirname(__DIR__));
Yii::setAlias('@hiqdev/yii2/cart/tests', __DIR__);
