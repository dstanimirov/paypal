<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * PayeeType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class PayeeType extends BaseType{

    /**
     * @var string
     */
    var $email_address;

    /**
     * @var string
     */
    var $merchant_id;

}
