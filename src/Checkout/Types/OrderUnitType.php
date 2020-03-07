<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * OrderUnitType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class OrderUnitType extends BaseType {

    /**
     * @var string
     */
    var $reference_id;

    /**
     * @var float
     */
    var $amount;

    /**
     * @var string
     */
    var $currency_code;

    /**
     * @var string
     */
    var $description;

}
