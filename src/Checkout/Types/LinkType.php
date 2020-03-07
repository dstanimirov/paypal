<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * LinkType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class LinkType extends BaseType {

    /**
     * @var string
     */
    var $href;

    /**
     * @var string
     */
    var $rel;

    /**
     * @var string
     */
    var $method;

}
