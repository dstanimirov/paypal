<?php

/**
 * Advanced example 
 * Create order with one purchased unit with many items inside
 */

require_once('../vendor/autoload.php');

use Phalcon\Config\Adapter\Json;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Order;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AmountType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ItemType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BreakdownType;

/* @var $credentials \Phalcon\Config\Adapter\Json  Application credentials */
$credentials = new Json('../config.json');


$order = new Order($credentials);


// Create the purchase units
$punit = new PurchaseUnitType();

$punit->setDescription('Sporting Goods');

$punit->setReferenceId('PUHF');

$punit->setCustomId('CUST-HighFashions');

$punit->setSoftDescriptor('HighFashions');


//Add items
$itemOne = new ItemType();

$itemOne->setName('T-Shirt');

$itemOne->setDescription('Green XL');

$itemOne->setSku('sku01');

$itemOne->setUnitAmount('90.00','USD');

//If you set item tax, you must add it after that to breakdown
$itemOne->setTax('10.00','USD');

$itemOne->setQuantity(1);

$itemOne->setCategory('PHYSICAL_GOODS');

$punit->addItem($itemOne);


//Add one more item to purchased unit
$itemTwo = new ItemType();

$itemTwo->setName('Shoes');

$itemTwo->setDescription('Running, Size 10.5');

$itemTwo->setSku('sku02');

$itemTwo->setUnitAmount('45.00','USD');

$itemTwo->setTax('5.00','USD');

$itemTwo->setQuantity(2);

$itemTwo->setCategory('PHYSICAL_GOODS');

$punit->addItem($itemTwo);


//If your shop support it, you can breakdown the amount as provide separately shipping cost, taxes and/or shipping discounts
$breakdown = new BreakdownType();

//Unit Items total amount without taxes
$itemsTotalAmount = $punit->getItemsTotalAmount();

$itemsTotalAmountTaxes = $punit->getItemsTotalTax();

$breakdown->setItemTotal($itemsTotalAmount,'USD');

//Set your shipping costs
$breakdown->setShipping('20.00','USD');

//Set Handling if you have
$breakdown->setHandling('10.00','USD');

//Unit Items total amount for taxes only. Set to breakdown only if your items contain taxes values
$breakdown->setTaxTotal($itemsTotalAmountTaxes,'USD');

//you can appply some doscount
$breakdown->setShippingDiscount('10.00','USD');

//Gets total amount and set to Order
$totalAmount = $breakdown->calculateTotalAmount();



//Add total unit amount as creating Amount type 
$amount = new AmountType();

//Add the breakdown to amount
$amount->setBreakdown($breakdown);

$amount->setCurrencyCode('USD');

$amount->setValue($totalAmount);

//apply to unit
$punit->setAmount($amount);




//Add first unit to order
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