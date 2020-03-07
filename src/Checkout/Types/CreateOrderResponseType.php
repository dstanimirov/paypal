<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;


/**
 * CreateOrderResponseType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class CreateOrderResponseType extends BaseType {

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
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\LinksType
     */
    var $links;

    /**
     * @var string
     */
    var $status;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitsType
     */
    var $purchase_units;

}
