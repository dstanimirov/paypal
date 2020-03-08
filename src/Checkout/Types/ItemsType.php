<?php

namespace Openapi\Phalcon\Plugins\PayPal\Checkout\Types;

use Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ItemType;

/**
 * ItemsType
 *
 * @author Dimitar Stanimirov <stanimirov.dimitar@gmail.com>
 */
class ItemsType {

    /**
     * @var \Openapi\Phalcon\Plugins\PayPal\Checkout\Types\ItemType
     */
    var $item = [];

    public function __construct(\Phalcon\Config $unit) {

        foreach ($unit as $value) {

            $this->item[] = new ItemType($value);
        }
    }

    /**
     * @return int Number of links
     */
    public function count() {
        return count($this->item);
    }

}
