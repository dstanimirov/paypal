<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * AmountType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class AmountType extends BaseType {

    /**
     * @var string
     */
    var $currency_code;

    /**
     * @var float
     */
    var $value;

}
