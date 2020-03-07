<?php

require_once('vendor/autoload.php');

use Phalcon\Config\Adapter\Json;
use Phalcon\Config;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Order;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\OrderUnitType;

/* @var $credentials \Phalcon\Config\Adapter\Json  Application credentials */
$credentials = new Json('config.json');


/**
 * Create Order
 */
$order = new Order($credentials);


/**
 * URL to redirect user after payment process. If you set, it overwrite defined into config file
 */
$order->setReturnUrl('https://paypal-checkout.test/example-accept-order.php');

/**
 * URL to redirect user if cancel the payment, If you set, it overwrite defined into config file
 */
$order->setCancelUrl('https://paypal-checkout.test/example-cancel-order.php');

/**
 * Custom brand name in payment process.
 * If is not set, your PayPal business name will be used
 * You can also set default Brand name in configuration file [brand_name]
 */
$order->setBrandName('My custom Brand name');

$order->setUserAction('PAY_NOW');


//Start Adding units to order

/* @var $unit \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\OrderUnitType */
$unit = new OrderUnitType();

$unit->amount = '8.80';

$unit->currency_code = 'GBP';

//reference ID is not required if there is only one purchase unit, otherwise you need to generate reference id for each unit
$unit->reference_id = 'AA243DRF343';

$unit->description = 'My unit 1';

$order->addOrderUnit($unit);

//Adding one more unit. Example using array
$objUnit = new Config([
    'amount' => '10.82',
    'currency_code' => 'GBP',
    'reference_id' => 'B2223DRF343',
    'description' => 'My unit 2'
        ]);

/* @var $unit2 \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\OrderUnitType */
$unit2 = new OrderUnitType($objUnit);

$order->addOrderUnit($unit2);


//Send the request to PayPal ( Creates order )
$order->create();


//Check for errors
if (!empty($order->getErrors())) {
    die($order->getFirstError());
}


/* @var $result \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CreateOrderResponseType */
$result = $order->getOrderCreateResult();

//Get order ID , format 8V127094EB6341009
$order_id = $result->id;


/**
 * Before to redirect user to PayPal approve URL, save order ID into session storage or database, depends from your project logic.
 * 
 * Order ID is used later to send back to PayPal the OrdersCaptureRequest
 * 
 * Get the approve URL and redirect user to accept the payment , URL format https://www.sandbox.paypal.com/checkoutnow?token=8V127094EB6341009 
 */
$redirect_url = $result->links->getApproveUrl();


/**
 * Once the payment is made, the user will be redirected to return URL you provide ( see example-accept-order-request.php )
 * 
 * If user cancel the payment, will be redirected to cancel URL you provide
 * 
 */