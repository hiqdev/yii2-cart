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

use Closure;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Url;

/**
 * Cart Module.
 *
 * Example application configuration:
 *
 * ```php
 * 'modules' => [
 *     'cart' => [
 *         'class'  => 'hiqdev\yii2\cart\Module',
 *     ],
 * ],
 * ```
 */
class Module extends \yii\base\Module
{
    /**
     * @var array array of the options that will be passed to [[set]]
     */
    public $shoppingCartOptions = [];

    /**
     * Cart component ID.
     */
    const CART_COMPONENT_ID = 'cart';

    /**
     * {@inheritdoc}
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (!$this->has(static::CART_COMPONENT_ID)) {
            $this->set(static::CART_COMPONENT_ID, array_merge([
                'class' => 'hiqdev\yii2\cart\ShoppingCart',
            ], $this->shoppingCartOptions));
        }
        $this->get(static::CART_COMPONENT_ID)->module = $this;
        $this->registerTranslations();
    }

    /**
     * Registers translations.
     * @void
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['cart'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath'       => __DIR__ . '/messages',
            'fileMap'        => [
                'merchant' => 'cart.php',
            ],
        ];
    }

    /**
     * @var string the module name
     */
    public static $name = 'cart';

    /**
     * Finds cart module.
     * TODO think of how to find NOT by name.
     */
    public static function getInstance()
    {
        return Yii::$app->getModule(static::$name);
    }

    /**
     * @throws \yii\base\InvalidConfigException
     * @return null|\yz\shoppingcart\ShoppingCart|ShoppingCart
     */
    public function getCart()
    {
        return $this->get(static::CART_COMPONENT_ID);
    }

    public function createUrl($route = null)
    {
        $params = is_array($route) ? $route : [$route];
        $params[0] = '/' . $this->id . '/' . (strpos($params[0] ?? '', '/') !== false ? $params[0] : 'cart/' . ($params[0] ?: 'index'));

        return Url::toRoute($params);
    }

    /**
     * @var string|array route to the terms of use page, suitable for Url::to().
     */
    public $termsPage;

    /**
     * @var string|array route to the order page, suitable for Url::to().
     */
    public $orderPage = ['order'];

    /**
     * @var array agreements the client has to accept before making an order, indexed by name.
     * An item is either an HTML label or an array:
     *
     * - `label`: string, HTML shown next to the checkbox, not encoded; `{language}` is replaced
     *   with the language code of the application, e.g. `en` for links to localized pages;
     * - `positions`: string[], optional position classes: the agreement is shown only when
     *   the cart holds an instance of one of them. Without it it is shown for any cart.
     *
     * While the cart needs agreements, the cart page shows them with [[widgets\Agreements]] and its
     * order button instead of [[orderButton]]: it posts the checked agreements to
     * `cart/accept-agreements`, which opens [[orderPage]] only when all of them are checked.
     * The order page has to check [[hasAcceptedAgreements()]] itself.
     *
     * ```php
     * 'agreements' => [
     *     'terms' => 'I have read and agree to the <a href="/rules">Terms</a>.',
     *     'withdrawal' => [
     *         'label' => 'I request that my order be started immediately.',
     *         'positions' => [DomainProduct::class],
     *     ],
     * ],
     * ```
     */
    public $agreements = [];

    /**
     * @return string[] labels of the agreements needed for the current cart, indexed by name
     */
    public function getActiveAgreements(): array
    {
        $positions = $this->getCart()->getPositions();
        if (empty($positions)) {
            return [];
        }

        $language = explode('-', Yii::$app->language)[0];
        $result = [];
        foreach ($this->agreements as $name => $agreement) {
            $agreement = is_array($agreement) ? $agreement : ['label' => $agreement];
            if (empty($agreement['label'])) {
                continue;
            }
            if (!empty($agreement['positions']) && !$this->hasPositionOf($positions, (array) $agreement['positions'])) {
                continue;
            }
            $result[$name] = strtr($agreement['label'], ['{language}' => $language]);
        }

        return $result;
    }

    /**
     * Session key of the accepted agreements: a fingerprint of the cart they were accepted for.
     */
    const ACCEPTED_AGREEMENTS_SESSION_KEY = 'cart-accepted-agreements';

    /**
     * Accepts the agreements for the current cart.
     * They stay accepted while the cart holds the same positions.
     *
     * @param string[] $names names of the checked agreements
     * @return bool whether every agreement needed for the current cart is among them
     */
    public function acceptAgreements(array $names): bool
    {
        $missing = array_diff(array_map('strval', array_keys($this->getActiveAgreements())), array_map('strval', $names));
        if (!empty($missing)) {
            $this->forgetAcceptedAgreements();

            return false;
        }
        Yii::$app->getSession()->set(static::ACCEPTED_AGREEMENTS_SESSION_KEY, $this->getAgreementsFingerprint());

        return true;
    }

    /**
     * @return bool whether the order can be made: the cart needs no agreements,
     * or they were accepted for exactly the positions it holds now
     */
    public function hasAcceptedAgreements(): bool
    {
        if (empty($this->getActiveAgreements())) {
            return true;
        }
        $accepted = Yii::$app->getSession()->get(static::ACCEPTED_AGREEMENTS_SESSION_KEY);

        return is_string($accepted) && hash_equals($accepted, $this->getAgreementsFingerprint());
    }

    /**
     * Makes the client accept the agreements again for the next order.
     */
    public function forgetAcceptedAgreements(): void
    {
        Yii::$app->getSession()->remove(static::ACCEPTED_AGREEMENTS_SESSION_KEY);
    }

    private function getAgreementsFingerprint(): string
    {
        $ids = array_map('strval', array_keys($this->getCart()->getPositions()));
        $names = array_map('strval', array_keys($this->getActiveAgreements()));
        sort($ids);
        sort($names);

        return hash('sha256', json_encode([$ids, $names]));
    }

    private function hasPositionOf(array $positions, array $classes): bool
    {
        foreach ($positions as $position) {
            foreach ($classes as $class) {
                if ($position instanceof $class) {
                    return true;
                }
            }
        }

        return false;
    }

    protected $_orderButton;

    public function setOrderButton($value)
    {
        $this->_orderButton = $value;
    }

    public function getOrderButton()
    {
        return $this->_orderButton instanceof Closure ? call_user_func($this->_orderButton, $this) : $this->_orderButton;
    }

    /**
     * @var PaymentMethodsProviderInterface|null
     */
    public $paymentMethodsProvider;

    public function getPaymentMethods()
    {
        if (empty($this->paymentMethodsProvider)) {
            return new InvalidConfigException('Payment methods provider must be set');
        }
        if (!($this->paymentMethodsProvider instanceof PaymentMethodsProviderInterface)) {
            return new InvalidConfigException('Payment methods provider are bad configured');
        }

        return $this->paymentMethodsProvider->getPaymentMethods();
    }
}
