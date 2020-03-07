<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType;

/**
 * PurchaseUnitsType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class PurchaseUnitsType {

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType
     */
    var $units = [];

    public function __construct(\Phalcon\Config $unit) {

        foreach ($unit as $value) {

            $this->units[] = new PurchaseUnitType($value);
        }
    }

    /**
     * @return int Number of units
     */
    public function count() {
        return count($this->units);
    }

    /**
     * Gets the first purchased unit
     * 
     * @return \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\PurchaseUnitType
     * @return bool false
     */
    public function getFirst() {
        return !empty($this->units[0]) ? $this->units[0] : false;
    }

}
