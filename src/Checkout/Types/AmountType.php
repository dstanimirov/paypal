<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BaseType;
use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BreakdownType;

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

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BreakdownType
     */
    var $breakdown = [];

    /**
     * @param string $currency_code
     */
    public function setCurrencyCode($currency_code) {
        $this->currency_code = $currency_code;
    }

    /**
     * @param float $value
     * 
     * If parameter is not set, the amount will be calculated from breakdown
     */
    public function setValue(float $value = null) {
        $this->value = $value;
    }

    /**
     * @param \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\BreakdownType $breakdown
     */
    public function setBreakdown(BreakdownType $breakdown) {
        
        $this->breakdown = $breakdown;
        
    }
    


}
