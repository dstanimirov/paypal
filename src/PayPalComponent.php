<?php

namespace Openapi\Phalcon\Plugins\PayPal;

use Phalcon\Config;
use Openapi\Phalcon\Plugins\PayPal\Constants\PayPalConstants;

/**
 * PayPalComponents
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class PayPalComponent {

    /**
     * @var \Phalcon\Config
     */
    private $config;

    /**
     * @var \Phalcon\Config
     */
    private $env;

    /**
     * @var string
     */
    private $client_id;

    /**
     * @var string
     */
    private $client_secret;

    /**
     * @var string
     */
    private $return_url;

    /**
     * @var string
     */
    private $cancel_url;

    /**
     * @var string The label that overrides the business name in the PayPal account on the PayPal site.
     */
    private $brand_name;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $user_action;

    /**
     * @var string
     */
    private $landing_page;

    /**
     * @var bool
     */
    private $sandbox;

    /**
     * @var array  Error messages
     */
    private $errors = [];

    public function __construct($config) {

        $this->config = \is_array($config) ? new Config($config) : $config;

        foreach ($this->config as $property => $value) {

            if (!property_exists(get_class(), $property)) {
                continue;
            }

            $this->{$property} = $value;
        }

        $this->env = $this->sandbox ?
                $config->path('development') :
                $config->path('production');
    }

    /**
     * @return bool TRUE if sandbox mode
     */
    public function isSandBox() {
        return $this->sandbox;
    }

    /**
     * @return string sandbox/live
     */
    public function getMode() {
        return $this->isSandBox() ? PayPalConstants::MODE_SANDBOX : PayPalConstants::MODE_LIVE;
    }

    /**
     * @return string sandbox/production
     */
    public function getEnvironment() {
        return $this->isSandBox() ? PayPalConstants::ENVIRONMENT_SANDBOX : PayPalConstants::ENVIRONMENT_LIVE;
    }

    /**
     * @return string PayPal Client ID
     */
    public function getClientId() {
        return !empty($this->client_id) ? $this->client_id : $this->env->path('credentials.client_id');
    }

    /**
     * @return string PayPal Client secret
     */
    public function getClientSecret() {
        return !empty($this->client_secret) ? $this->client_secret : $this->env->path('credentials.client_secret');
    }

    /**
     * @param string $return_url
     */
    public function setReturnUrl($return_url) {
        return $this->return_url = $return_url;
    }

    /**
     * @return string Return URL
     */
    public function getReturnUrl() {
        return !empty($this->return_url) ? $this->return_url : $this->env->path('return_url');
    }

    /**
     * @param string $cancel_url
     */
    public function setCancelUrl($cancel_url) {
        return $this->cancel_url = $cancel_url;
    }

    /**
     * @return string Cancel URL
     */
    public function getCancelUrl() {
        return !empty($this->cancel_url) ? $this->cancel_url : $this->env->path('cancel_url');
    }

    /**
     * Sets The label that overrides the business name in the PayPal account on the PayPal site.
     * @param string $brand_name
     */
    public function setBrandName($brand_name) {
        return $this->brand_name = $brand_name;
    }

    /**
     * @return string Business name in the PayPal account
     */
    public function getBrandName() {
        return $this->brand_name;
    }

    /**
     * BCP 47-formatted locale of pages that the PayPal payment experience shows
     * @param string $locale
     */
    public function setLocale($locale) {
        return $this->locale = $locale;
    }

    /**
     * @return string BCP 47-formatted locale
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * The type of landing page to show on the PayPal site for customer checkout. 
     * The possible values are: LOGIN, BILLING, NO_PREFERENCE
     * 
     * @param string $landing_page
     */
    public function setLandingPage($landing_page) {
        return $this->landing_page = $landing_page;
    }

    /**
     * @return string Business name in the PayPal account
     */
    public function getLandingPage() {
        return $this->landing_page;
    }

    /**
     * Configures a Continue or Pay Now checkout flow. The possible values are: CONTINUE|PAY_NOW
     * @param string $user_action
     */
    public function setUserAction($user_action) {
        return $this->user_action = $user_action;
    }

    /**
     * @return string CONTINUE|PAY_NOW
     */
    public function getUserAction() {
        return $this->user_action;
    }

    /**
     * @return string
     */
    public function getFirstError() {
        return !empty($this->errors[0]) ? $this->errors[0] : false;
    }

    /**
     * @return array List with error messages
     */
    public function getErrors() {
        return !empty($this->errors) ? $this->errors : false;
    }

    /**
     * @param string $message Error message
     */
    protected function setError($message = false) {

        if (empty($message)) {

            return false;
        }

        $this->errors[] = $message;
    }

}
