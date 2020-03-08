<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout;

use Phalcon\Config;
use Openapi\Phalcon\Plugins\PayPal\PayPalComponent;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PayerType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AcceptOrderResponseType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CreateOrderResponseType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Constants\OrderConstants;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Constants\CurrenciesConstants;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalHttp\HttpException;

/**
 * class CreateOrder
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class Order extends PayPalComponent {

    /**
     * @var array Order units
     */
    private $order_units = [];

    /**
     * @var string intent
     */
    private $intent;

    /**
     * @var string
     */
    private $order_currency;

    /**
     * @var \PayPalCheckoutSdk\Core\PayPalEnvironment
     */
    private $environment;

    /**
     * @var \PayPalCheckoutSdk\Core\PayPalHttpClient
     */
    private $http_client;

    /**
     * @var \PayPalCheckoutSdk\Orders\OrdersCreateRequest
     */
    private $order_create_request;

    /**
     * @var \PayPalCheckoutSdk\Orders\OrdersCaptureRequest
     */
    private $order_accept_request;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CreateOrderResponseType
     */
    private $create_order_response;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AcceptOrderResponseType
     */
    private $order_accept_result;

    /**
     * @param \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType
     */
    public function addOrderUnit(PurchaseUnitType $order_unit) {
        
        $this->order_units[] = $order_unit->classToArray();
    }

    /**
     * @param string
     */
    public function setIntentCapture() {
        $this->intent = OrderConstants::INTENT_CAPTURE;
    }

    /**
     * @param string $order_currency
     */
    public function setOrderCurrency($order_currency) {

        $this->order_currency = $order_currency;
    }

    /**
     * @return string if is not set, default is USD
     */
    public function getOrderCurrency() {

        return !empty($this->order_currency) ? $this->order_currency : CurrenciesConstants::USD;
    }

    /**
     * @param string
     */
    public function setIntentAuthorize() {
        $this->intent = OrderConstants::INTENT_AUTHORIZE;
    }

    /**
     * Send the request to PayPal API to Create order
     * 
     * @return \PayPalHttp\HttpResponse
     */
    public function create() {

        $this->environment = $this->isSandBox() ?
                new SandboxEnvironment($this->getClientId(), $this->getClientSecret()) :
                new ProductionEnvironment($this->getClientId(), $this->getClientSecret());

        $this->http_client = new PayPalHttpClient($this->environment);

        $this->order_create_request = new OrdersCreateRequest();

        $this->order_create_request->prefer('return=representation');

        $this->order_create_request->body = $this->getRequestBody();

        try {

            /* @var $response \PayPalHttp\HttpResponse */
            $response = $this->http_client->execute($this->order_create_request);
            //
        } catch (HttpException $ex) {

            $this->setError($ex->getMessage());

            return false;
        }


        $toArray = json_decode(json_encode((array) $response->result), true);

        $this->create_order_response = new CreateOrderResponseType(new Config($toArray));

        return $this->create_order_response;
    }

    /**
     * Send the request to PayPal API to Accept order
     * 
     * @param string $order_id Order ID frooCreate order request
     * 
     * @return \PayPalHttp\HttpResponse
     */
    public function accept($order_id) {

        $this->environment = $this->isSandBox() ?
                new SandboxEnvironment($this->getClientId(), $this->getClientSecret()) :
                new ProductionEnvironment($this->getClientId(), $this->getClientSecret());

        $this->http_client = new PayPalHttpClient($this->environment);

        $this->order_accept_request = new OrdersCaptureRequest($order_id);

        $this->order_accept_request->prefer('return=representation');

        try {

            /* @var $response \PayPalHttp\HttpResponse */
            $response = $this->http_client->execute($this->order_accept_request);
            //
        } catch (HttpException $ex) {

            $this->setError($ex->getMessage());

            return false;
        }

        $toArray = json_decode(json_encode((array) $response->result), true);

        $this->order_accept_result = new AcceptOrderResponseType(new Config($toArray));

        return $this->order_accept_result;
    }

    /**
     * @return \PayPalCheckoutSdk\Orders\OrdersCreateRequest
     */
    public function getOrderCreateRequest() {
        return $this->order_create_request;
    }

    /**
     * @return \PayPalCheckoutSdk\Orders\OrdersCaptureRequest
     */
    public function getOrderAcceptRequest() {
        return $this->order_accept_request;
    }

    /**
     * PayPal Response result after the order was created
     * 
     * @return \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CreateOrderResponseType
     */
    public function getOrderCreateResult() {
        return $this->create_order_response;
    }

    /**
     * PayPal Response result after the order was accepted
     * 
     * @return \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AcceptOrderResponseType
     */
    public function getOrderAcceptResult() {
        return $this->order_accept_result;
    }

    /**
     * @return \PayPalCheckoutSdk\Core\PayPalHttpClient
     */
    public function getPayPalHttpClient() {
        return $this->http_client;
    }

    /**
     * @return \PayPalCheckoutSdk\Core\PayPalEnvironment
     */
    public function getPayPalEnvironment() {
        return $this->environment;
    }

    /**
     * @return array Order units
     */
    public function getOrderUnits() {

        return $this->order_units;
    }

    /**
     * @return \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PayerType
     */
    public function getPayer() {

        return new PayerType($this->getOrderAcceptResult()->path('payer'));
    }

    /**
     * @return string CAPTURE|AUTHORIZE
     */
    public function getIntent() {
        return $this->intent;
    }

    /**
     * @return array 
     */
    public function getRequestBody() {

        if (empty($this->getOrderUnits())) {
            return false;
        }

        //start build request body with required parameters
        $body = [
            "intent" => !empty($this->getIntent()) ? $this->getIntent() : OrderConstants::INTENT_CAPTURE,
            "purchase_units" => $this->getOrderUnits()
        ];

        $body['application_context'] = [
            "locale" => !empty($this->getLocale()) ? $this->getLocale() : OrderConstants::LOCALE_US,
            "cancel_url" => $this->getCancelUrl(),
            "return_url" => $this->getReturnUrl(),
            "user_action" => !empty($this->getUserAction()) ? $this->getUserAction() : OrderConstants::USER_ACTION_PAY_NOW
        ];

        //add additional optiona if are set
        if (!empty($this->getBrandName())) {
            $body['application_context']['brand_name'] = $this->getBrandName();
        }


        return $body;
    }

}
