<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * AcceptOrderResponseType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class AcceptOrderResponseType extends BaseType {

    /**
     * @var string
     */
    var $id;

    /**
     * @var string
     */
    var $intent;

    /**
     * @var string
     */
    var $create_time;

    /**
     * @var string
     */
    var $update_time;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\LinksType
     */
    var $links;

    /**
     * @var string
     */
    var $status;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType
     */
    var $purchase_units;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PayerType
     */
    var $payer;

}
