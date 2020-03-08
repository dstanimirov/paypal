<?php

/**
 * Basic example 
 * Create simple order with one purchased unit and total amount
 */

require_once('../vendor/autoload.php');

use Phalcon\Config\Adapter\Json;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Order;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AmountType;

/* @var $credentials \Phalcon\Config\Adapter\Json  Application credentials */
$credentials = new Json('../config.json');


/**
 * Create simple Order, one Purchased unit final price only
 */
$order = new Order($credentials);


$punit = new PurchaseUnitType();

$punit->setDescription('Sporting Goods');

$punit->setReferenceId('PUHF');

$punit->setCustomId('CUST-HighFashions');

$punit->setSoftDescriptor('HighFashions');

//create amount type as set the currency and total amount 
$amount = new AmountType();

$amount->setCurrencyCode('USD');

$amount->setValue('150.25');

//add amount to unit
$punit->setAmount($amount);

//add the unit to order
$order->addOrderUnit($punit);


//Send the request to PayPal ( Creates order )
$order->create();

//Check for errors
if (!empty($order->getErrors())) {

    $error = $order->getFirstError();

    echo '<pre>';
    print_r(json_decode($error, true));
    echo '</pre>';

    die();
}


/* @var $result \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CreateOrderResponseType */
$result = $order->getOrderCreateResult();

//save order id
$order_id = $result->id;

//example url https://www.sandbox.paypal.com/checkoutnow?token=6CR25422ST358271J
$url = $result->links->getApproveUrl();

//redirect user to PayPal approval link

echo '<pre>';
print_r($result);
echo '</pre>';