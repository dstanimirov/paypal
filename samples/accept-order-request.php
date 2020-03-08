<?php

require_once('../vendor/autoload.php');

use Phalcon\Config\Adapter\Json;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Order;

/* @var $credentials \Phalcon\Config\Adapter\Json Application credentials */
$credentials = new Json('../config.json');


/**
 * Accept Order
 */
$order = new Order($credentials);

/**
 * get order id from session storage or database
 */
$order_id = '2T860114R28901150';


/**
 * Send request PayPal (OrdersCaptureRequest)
 */
$order->accept($order_id);


/**
 * Check for errors
 */
if (!empty($order->getErrors())) {

    die($order->getFirstError());
}

/* @var $result \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AcceptOrderResponseType */
$result = $order->getOrderAcceptResult();


/* @var $payer \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PayerType */
$payer = $result->payer;

/* @var $purchase_units \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType */
$purchase_units = $result->purchase_units;



echo '<pre>';
print_r($result);
echo '</pre>';