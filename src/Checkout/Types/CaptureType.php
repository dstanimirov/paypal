<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;

/**
 * CaptureType 
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class CaptureType extends BaseType {

    /**
     * @var string
     */
    var $id;

    /**
     * @var string
     */
    var $status;

    /**
     * @var \Phalcon\Config [reason]
     */
    var $status_details;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\AmountType
     */
    var $amount;

    /**
     * @var int
     */
    var $final_capture;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\SellerProtectionType
     */
    var $seller_protection;

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\LinksType
     */
    var $links;

    /**
     * @var string
     */
    var $create_time;

    /**
     * @var string
     */
    var $update_time;

}
