<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * PaymentsType 
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class PaymentsType extends BaseType {

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CapturesType
     */
    var $captures;

}
