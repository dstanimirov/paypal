<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * SellerProtectionType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class SellerProtectionType extends BaseType{

    /**
     * @var string
     */
    var $status;

    /**
     * @var \Phalcon\Config
     */
    var $dispute_categories;


}
