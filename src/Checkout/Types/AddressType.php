<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * AddressType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class AddressType extends BaseType{

    /**
     * @var string
     */
    var $address_line_1;

    /**
     * @var string
     */
    var $admin_area_1;

    /**
     * @var string
     */
    var $admin_area_2;

    /**
     * @var string
     */
    var $postal_code;

    /**
     * @var string
     */
    var $country_code;


}
