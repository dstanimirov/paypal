<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * ShippingType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class ShippingType extends BaseType {

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\NameType
     */
    var $name;

    /**
     * @var Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AddressType
     */
    var $address;

}
