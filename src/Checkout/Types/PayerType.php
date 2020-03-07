<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * PayerType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class PayerType extends BaseType {

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\NameType
     */
    var $name;

    /**
     * @var string
     */
    var $email_address;

    /**
     * @var string
     */
    var $payer_id;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AddressType
     */
    var $address;

}
