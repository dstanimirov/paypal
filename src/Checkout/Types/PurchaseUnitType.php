<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * PurchaseUnitType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class PurchaseUnitType extends BaseType{

    /**
     * @var string
     */
    var $reference_id;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AmountType
     */
    var $amount;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PayeeType
     */
    var $payee;

    /**
     * @var string
     */
    var $description;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ShippingType
     */
    var $shipping;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PaymentsType
     */
    var $payments;


}
