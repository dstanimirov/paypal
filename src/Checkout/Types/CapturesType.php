<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

/**
 * CapturesType 
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class CapturesType {
    

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\CaptureType
     */
    var $capture = [];

    public function __construct(\Phalcon\Config $options) {

        foreach ($options as $value) {

            $this->capture[] = new CaptureType($value);
        }
    }

}
