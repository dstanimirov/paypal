<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * NameType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class NameType extends BaseType {

    /**
     * @var string
     */
    var $full_name;

    /**
     * @var string (evaluated only in accept order response)
     */
    var $given_name;

    /**
     * @var string (evaluated only in accept order response)
     */
    var $surname;

}
